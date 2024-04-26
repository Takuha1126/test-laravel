<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class FavoriteController extends Controller
{
    public function getStatus($shopId)
    {
        $userId = Auth::id();
        $isFavorite = Favorite::where('user_id', $userId)
                            ->where('shop_id', $shopId)
                            ->exists();

        return response()->json(['isFavorite' => $isFavorite]);
    }

    public function toggle(Request $request, $shopId)
    {
        $userId = Auth::id();

        try {
            $favorite = DB::transaction(function () use ($userId, $shopId) {
                $existingFavorite = Favorite::where('user_id', $userId)->where('shop_id', $shopId)->first();

                if ($existingFavorite) {
                    $existingFavorite->delete();
                    return null;
                }

                return Favorite::create([
                    'user_id' => $userId,
                    'shop_id' => $shopId,
                ]);
            });

            if ($favorite === null) {
                return response()->json(['status' => 'removed', 'message' => 'お気に入りから削除しました。']);
            }

            return response()->json(['status' => 'added', 'message' => 'お気に入りに追加しました。']);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
