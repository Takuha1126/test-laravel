<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Http\Requests\ShopUpdateRequest;

class ShopController extends Controller
{

    public function index()
    {
        $shops = Shop::with('area', 'genre')->get();
        return view('index', compact('shops'));
    }

    public function detail($shop_id)
    {
        $shop = $this->findShopById($shop_id);

        return view('detail', ['shop' => $shop]);
    }

    private function findShopById($shop_id)
    {
        return Shop::findOrFail($shop_id);
    }

    public function search(Request $request)
    {
        $area = $request->input('area_id');
        $genre = $request->input('genre_id');
        $keyword = $request->input('search');

        $query = Shop::query();

        $this->applyFilters($query, $area, $genre, $keyword);

        $filteredShops = $query->get();

        return view('index', compact('filteredShops'));
    }

    private function applyFilters($query, $area, $genre, $keyword)
    {
        if (!empty($genre)) {
            $query->where('genre_id', $genre);
        }

        if (!empty($area)) {
            $query->where('area_id', $area);
        }

        if ($keyword) {
            $query->where('shop_name', 'like', '%' . $keyword . '%');
        }
    }

    public function showCreateUpdateForm($id)
    {
        $shop = $this->findShopById($id);

        return view('shops.shop', compact('shop'));
    }

    public function update(ShopUpdateRequest $request, $id)
    {
        $shop = $this->findShopById($id);

        $this->updateShop($shop, $request);

        return redirect()->back()->with('success', '店舗情報を変更しました。');

    }

    private function updateShop($shop, $request)
    {
        $shop->update([
            'shop_name' => $request->shop_name,
            'area_id' => $request->area_id,
            'genre_id' => $request->genre_id,
            'description' => $request->description,
            'photo_url' => $request->photo_url,
        ]);
    }
}
