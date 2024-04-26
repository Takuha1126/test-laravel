<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\User;
use App\Models\ShopRepresentative;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ShopRepresentativeRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyAppUser;

class CreateShopRepresentativeController extends Controller
{
    public function showForm()
    {
        $shops = Shop::all();
        return view('admin.index', compact('shops'));
    }

    public function store(ShopRepresentativeRequest $request)
    {

        $representative = new ShopRepresentative;
        $representative->shop_id = $request->shop_id;
        $representative->representative_name = $request->representative_name;
        $representative->email = $request->email;
        $representative->password = Hash::make($request->password);
        $representative->save();

        return redirect()->back()->with('success', '店舗代表者を登録しました。');
    }

    public function create()
    {
        $representatives = ShopRepresentative::all();
        return view('admin.create', compact('representatives'));
    }

    public function destroy($id)
    {
        $representative = ShopRepresentative::findOrFail($id);
        $representative->delete();

        return redirect()->back()->with('success', '店舗代表者を削除しました。');
    }

    public function showSendForm()
    {
        $users = User::all();
        return view('admin.mail.send-notification-form', compact('users'));
    }

    public function sendNotification(Request $request)
    {
        $validated = $request->validate([
        'user_id' => 'required|exists:users,id',
        'message_content' => 'required|string',
        ]);

        $user = User::find($request->user_id);

        if (!$user) {
            return redirect()->back();
        }

        $messageContent = $request->input('message_content');

        Mail::to($user->email)->send(new NotifyAppUser($user, $messageContent));

        return redirect()->back()->with('success', 'お知らせメールを送信しました');
    }

    public function sendAll(Request $request)
    {
        $validated = $request->validate([
        'message_content' => 'required|string',
    ]);
        $users = User::all();
        $messageContent = $request->input('message_content');

        foreach ($users as $user) {
            Mail::to($user->email)->send(new NotifyAppUser($user, $messageContent));
        }

        return redirect()->back()->with('success', '全員にお知らせメールを送信しました');
    }
}
