<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB, Cart;

class WishlistController extends Controller
{
    //
    public function index()
    {
        $lohang = DB::table('lohang')->get();
        return view('pages.wishlist',compact('sanpham'));
    }
    public function switchToWishlist(Request $request, $id)
    {
        $sanpham = DB::select('select * from sanpham where id = ?',[$id]);
        // print_r($sanpham);
        if ($sanpham[0]->sanpham_khuyenmai == 1) {
            $daco = Cart::instance('wishlist')->search(function ($cartItem, $rowId) use ($request) {
                return $cartItem->id == $request->id;
            });
            if (!$daco->isEmpty()) {
                alert()->warning('Sản phẩm đã có trong danh mục yêu thích của bạn.','Thông báo');
                return redirect::back();
            }
            $muasanpham = DB::select('select sp.id,sp.sanpham_ten,sp.sanpham_gia_ban,lh.lohang_ky_hieu, sp.id, km.khuyenmai_phan_tram, min(lh.id) from sanpham as sp, lohang as lh, nhacungcap as ncc, sanphamkhuyenmai as spkm, khuyenmai as km  where km.khuyenmai_tinh_trang = 1 and sp.id = spkm.sanpham_id and spkm.khuyenmai_id = km.id and ncc.id = lh.nhacungcap_id and lh.lohang_so_luong_hien_tai > 0 and lh.sanpham_id = sp.id and sp.id = ?', [$id]);
            $giakm = $muasanpham[0]->sanpham_gia_ban - $muasanpham[0]->sanpham_gia_ban*$muasanpham[0]->khuyenmai_phan_tram*0.01;
            print_r($giakm);
            Cart::instance('wishlist')->add(array( 'id' => $muasanpham[0]->id, 'name' => $muasanpham[0]->sanpham_ten, 'qty' => 1, 'price' => $giakm));
        } else {
            $daco = Cart::instance('wishlist')->search(function ($cartItem, $rowId) use ($request) {
                return $cartItem->id == $request->id;
            });
    
            if (!$daco->isEmpty()) {
                alert()->warning('Sản phẩm đã có trong danh mục yêu thích của bạn.','Thông báo');
                return redirect::back();
            }
            $muasanpham = DB::select('select sp.id,sp.sanpham_ten,sp.sanpham_gia_ban,lh.lohang_ky_hieu, min(lh.id) from sanpham as sp, lohang as lh, nhacungcap as ncc  where ncc.id = lh.nhacungcap_id and lh.sanpham_id = sp.id and lh.lohang_so_luong_hien_tai > 0 and sp.id = ?',[$id]);
            $gia = $muasanpham[0]->sanpham_gia_ban;
            Cart::instance('wishlist')->add(array( 'id' => $muasanpham[0]->id, 'name' => $muasanpham[0]->sanpham_ten, 'qty' => 1, 'price' => $gia));
        }
        alert()->success('Sản phẩm đã được thêm vào yêu thích.','Thông báo')->autoclose(3500);
        return redirect::back();

    }
    public function switchToCart($id)
    {
        $item = Cart::instance('wishlist')->get($id);

        Cart::instance('wishlist')->remove($id);

        $duplicates = Cart::instance('default')->search(function ($cartItem, $rowId) use ($id) {
            return $cartItem->id == $id;
        });

        if (!$duplicates->isEmpty()) {
            alert()->warning('Sản phẩm đã có trong giỏ hàng.');
            return redirect('wishlist');
        }

        Cart::instance('default')->add($item->id, $item->name, 1, $item->price)->associate('App\Sanpham');
        alert()->success('Sản phẩm đã được chuyển tới giỏ hàng.','Thông báo')->autoclose(3500);
        return redirect('wishlist');

    }
    public function emptyWishlist()
    {
        Cart::instance('wishlist')->destroy();
        alert()->success('Danh mục yêu thích đã được xóa toàn bộ.','Thông báo')->autoclose(3500);
        return redirect('wishlist');
    }
    public function destroy($id)
    {
        $item = Cart::instance('wishlist')->get($id);

        Cart::instance('wishlist')->remove($id);
        alert()->success('Sản phẩm đã được xóa khỏi yêu thích.','Thông báo')->autoclose(3500);
        return redirect('wishlist');
    }
    
}
