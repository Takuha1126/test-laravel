<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ReservationRequest;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Database\QueryException;
use App\Http\Requests\ReservationUpdateRequest;

class ReservationController extends Controller
{
    public function completed()
    {
        return view('done');
    }

    public function store(ReservationRequest $request)
    {
        $userId = Auth::id();

        if ($this->checkDuplicateReservation($request, $userId)) {
            return redirect()->back()->with('error', '同じ時間と場所に他の予約が既にあります。')->withInput();
        }

        try {
            $this->createReservation($request, $userId);
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'データベースエラーが発生しました。')->withInput();
        }

        return redirect()->route('done');
    }

    private function checkDuplicateReservation($request, $userId)
    {
        return DB::transaction(function () use ($request, $userId) {
            $existingReservation = Reservation::where('shop_id', $request->shop_id)
                ->where('date', $request->date)
                ->where('reservation_time', date('H:i:s', strtotime($request->reservation_time)))
                ->where('user_id', $userId)
                ->lockForUpdate()
                ->first();

            return $existingReservation !== null;
        });
    }

    private function createReservation($request, $userId)
    {
        $reservationData = $request->only(['shop_id', 'date', 'reservation_time', 'number_of_people', 'status']);
        $reservationData['user_id'] = $userId;
        $reservationData['reservation_time'] = date('H:i:s', strtotime($request->reservation_time));

        Reservation::create($reservationData);
    }

    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        return redirect()->route('mypage');
    }

    public function update(ReservationUpdateRequest $request, $id)
{
    $validatedData = $request->validated();

    $reservation = Reservation::findOrFail($id);

    $newDate = $request->input('new_date');
    $newNumberOfPeople = $request->input('new_number_of_people');
    $newReservationTime = $request->input('new_reservation_time');

    $reservation->update([
        'date' => $newDate,
        'number_of_people' => $newNumberOfPeople,
        'reservation_time' => $newReservationTime,
    ]);

    return redirect()->route('done');
}

    public function show($id)
{
    $reservation = Reservation::find($id);

    if (!$reservation) {
        return redirect()->back();
    }

    $reservationData = json_encode([
        'id' => $reservation->id,
        'user_id' => $reservation->user_id,
        'shop_id' => $reservation->shop_id,
        'date' => $reservation->date,
        'reservation_time' => $reservation->reservation_time,
        'number_of_people' => $reservation->number_of_people,
        'status' => $reservation->status,
    ]);



    $qrCode = QrCode::size(200)->generate($reservationData);

    return view('qr', compact('reservation', 'qrCode', 'reservationData'));

}


    public function showReservationList()
    {
        $shopId = auth('shop')->user()->shop_id;
        $reservations = Reservation::where('shop_id', $shopId)->get();
        return view('shops.reservation', ['reservations' => $reservations, 'shopId' => $shopId]);
    }

    public function showQrVerification()
    {
        return view('shops.verify');
    }

    public function verify(Request $request)
{
    $qrCodeData = $request->input('qr_code_data');



    if (!$qrCodeData || empty($qrCodeData)) {
        return response()->json(['error' => '不正なデータ形式です'], 400);
    }


    $reservationData = json_decode($qrCodeData, true);


    if (json_last_error() !== JSON_ERROR_NONE) {
        return response()->json(['error' => 'JSONの構文が無効です'], 400);
    }



    if (!is_array($reservationData) || !isset($reservationData['id'])) {
        return response()->json(['error' => '不正なデータ形式です'], 400);
    }

    $reservation = Reservation::find($reservationData['id']);

    if (!$reservation) {
        return response()->json(['error' => '予約が見つかりません'], 404);
    }

    $responseData = [
        'name' => $reservation->user->name,
        'date' => $reservation->date,
        'time' => $reservation->reservation_time,
        'number_of_people' => $reservation->number_of_people,
    ];

    return response()->json($responseData);
}


}