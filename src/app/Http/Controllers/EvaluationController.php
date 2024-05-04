<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class EvaluationController extends Controller
{
    public function index()
    {
        return view('evaluations.show');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:255',
        ]);

        try {
            DB::beginTransaction();

            $review = new Review();
            $review->rating = $validatedData['rating'];
            $review->comment = $validatedData['comment'];
            $review->save();

            DB::commit();

            if ($request->ajax()) {
                return response()->json(['success' => true]);
            }

            return redirect('/');

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function visit(Request $request, $reservationId)
    {
        try {
            DB::beginTransaction();

            $reservation = Reservation::find($reservationId);

            if (!$reservation) {
                abort(404);
            }

            $reservation->delete();
            DB::commit();
            return redirect()->route('evaluation.show');

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
