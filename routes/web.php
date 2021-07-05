<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|

*/
// Authentication Routes...
$this->get('login', 'Auth\AuthController@showLoginForm');
$this->post('login', 'Auth\AuthController@login');
$this->get('logout', 'Auth\AuthController@logout');

// Registration Routes...
$this->get('register', 'Auth\AuthController@showRegistrationForm');
$this->post('register', 'Auth\AuthController@register');
// xác thực người dùng
Route::get('user/activation/{token}', 'Auth\RegisterController@activateUser')->name('user.activate');

//quên mật khẩu
// Route::get('quen-mat-khau', 'UserController@forgotPass');
Route::post('mat-khau', 'ResetPassController@postForgotPassword');
Route::get('resetPassword/{token}', 'ResetPassController@resetPassword');
Route::post('newPass', 'ResetPassController@newPass');
///đổi mật khẩu
Route::post('doi-mat-khau','ResetPassController@changePass');
//loại người dùng
Route::post('doi-mat-khau-ad', 'UserController@changePass');
Route::get('loainguoidung', 'UserController@loainguoidung');
//frontend
Route::get('/', 'HomeController@index');
Route::get('nhom-san-pham/{url}', 'HomeController@nhomsp');
Route::get('chi-tiet-san-pham/{url}', 'HomeController@chitietsp');
Route::post('binh-luan',['as'=>'postBinhluan','uses'=>'HomeController@postComment']);
Route::get('ket-qua-tim-kiem',['as'=>'getTimkiem','uses'=>'TimkiemController@gettimkiem']);
Route::post('ket-qua-tim-kiem',['as'=>'postTimkiem','uses'=>'TimkiemController@posttimkiem']);
Route::get('nhom-san-pham/{url}', 'HomeController@nhomsp');
Route::get('loai-san-pham/{url}', 'HomeController@loaisp');


Route::get('tin-tuc', 'HomeController@tintuc');

Route::get('chi-tiet-tin-tuc/{url}', 'HomeController@chitiet');

Route::get('shop', 'HomeController@shop');

Route::get('trang-chu', 'HomeController@index');

Route::get('dang-ky', 'HomeController@dangky');

Route::get('dang-nhap', 'HomeController@dangnhap');

Route::post('tim-kiem','HomeController@timkiem');

Route::get('lien-he', 'HomeController@getlienhe');

Route::post('lien-he', 'HomeController@postlienhe');

Route::get('mua-hang/{id}/{ten}',['as'=>'muahang','uses'=>'HomeController@mua']);

Route::get('gio-hang',['as'=>'giohang','uses'=>'HomeController@giohang']);

Route::patch('cap-nhat-mua', 'HomeController@capnhat');

Route::delete('xoa-mua', 'HomeController@remove');
 
Route::get('thanh-toan',['as'=>'getThanhtoan','uses'=>'HomeController@getCheckin']);

Route::post('thanh-toan',['as'=>'postThanhtoan','uses'=>'HomeController@postCheckin']);

Route::get('lich-su-mua-hang/{id}',['as'=>'khachhang.History','uses'=>'HomeController@History']);
//Backend
Route::get('admin/login',['as'=>'admin.login.getLogin','uses'=>'Auth\AuthController@getLogin']);
Route::post('admin/login',['as'=>'admin.login.postLogin','uses'=>'Auth\AuthController@postLogin']);
Route::get('admin/logout',['as'=>'admin.login.getLogout','uses'=>'Auth\AuthController@getLogout']);
////////////////////////// admin trang chủ
Route::get('admin-home', ['as'=>'admin.index','uses'=>'AdminController@index']);

Route::get('theongayindex','AdminController@theongay');
Route::get('theongaynoibo','AdminController@theongaynoibo');
/////

//// Người dùng
Route::group(['prefix' => 'user'], function() {
  Route::get('danhsach',['as'=>'admin.user.list','uses'=>'UserController@getList']);
  Route::get('them',['as'=>'admin.user.getAdd','uses'=>'UserController@getAdd']);
  Route::post('them',['as'=>'admin.user.postAdd','uses'=>'UserController@postAdd']);
  Route::get('xoa/{id}',['as'=>'admin.user.getDelete','uses'=>'UserController@getDelete']);
  Route::get('sua/{id}',['as'=>'admin.user.getEdit','uses'=>'UserController@getEdit']);
  Route::post('sua/{id}',['as'=>'admin.user.postEdit','uses'=>'UserController@changePassword']);
});
//Nhom san pham
Route::get('xemnhom','NhomController@xemnhomsp');
Route::get('themnhom','NhomController@themnhomsp');
Route::post('/luunhom', 'NhomController@luunhomsp');
Route::get('/suanhom/{id}', 'NhomController@suanhomsp');
Route::PATCH('/capnhatnhom/{id}', 'NhomController@capnhatnhomsp');
Route::get('/xoanhom/{id}', 'NhomController@xoanhomsp');
//loại sản phẩm
Route::group(['prefix' => 'loaisanpham'], function() {
  Route::get('danhsach',['as'=>'admin.loaisanpham.list','uses'=>'LoaisanphamController@getList']);
    Route::get('them',['as'=>'admin.loaisanpham.getAdd','uses'=>'LoaisanphamController@getAdd']);
    Route::post('them',['as'=>'admin.loaisanpham.postAdd','uses'=>'LoaisanphamController@postAdd']);
    Route::get('xoa/{id}',['as'=>'admin.loaisanpham.getDelete','uses'=>'LoaisanphamController@getDelete']);
    Route::get('sua/{id}',['as'=>'admin.loaisanpham.getEdit','uses'=>'LoaisanphamController@getEdit']);
    Route::post('sua/{id}',['as'=>'admin.loaisanpham.postEdit','uses'=>'LoaisanphamController@postEdit']);
});
//sản phẩm
Route::group(['prefix' => 'sanpham'], function() {
  Route::get('danhsach',['as'=>'admin.sanpham.list','uses'=>'SanphamController@getList']);
  Route::get('them',['as'=>'admin.sanpham.getAdd','uses'=>'SanphamController@getAdd']);
  Route::post('them',['as'=>'admin.sanpham.postAdd','uses'=>'SanphamController@postAdd']);
  Route::get('xoa/{id}',['as'=>'admin.sanpham.getDelete','uses'=>'SanphamController@getDelete']);
  Route::get('sua/{id}',['as'=>'admin.sanpham.getEdit','uses'=>'SanphamController@getEdit']);
  Route::post('sua/{id}',['as'=>'admin.sanpham.postEdit','uses'=>'SanphamController@postEdit']);
  Route::get('xoahinh/{id}',['as'=>'admin.sanpham.delImage','uses'=>'SanphamController@delImage']);
  Route::get('san-pham-theo-lo/{id}',['as'=>'admin.sanphamlo.list','uses'=>'SanphamController@xemsptheolo']);
});
//khách hàng
Route::group(['prefix' => 'khachhang'], function() {
  Route::get('danhsach',['as'=>'admin.khachhang.list','uses'=>'KhachhangController@getList']);
  Route::get('them',['as'=>'admin.khachhang.getAdd','uses'=>'KhachhangController@getAdd']);
  Route::post('them',['as'=>'admin.khachhang.postAdd','uses'=>'KhachhangController@postAdd']);
  Route::get('xoa/{id}',['as'=>'admin.khachhang.getDelete','uses'=>'KhachhangController@getDelete']);
  Route::get('sua/{id}',['as'=>'admin.khachhang.getEdit','uses'=>'KhachhangController@getEdit']);
  Route::post('sua/{id}',['as'=>'admin.khachhang.postEdit','uses'=>'KhachhangController@postEdit']);
  Route::get('xem-lich-su-mua-hang/{id}',['as'=>'admin.khachhang.getHistory','uses'=>'KhachhangController@getHistory']);
  Route::get('dsphieuthu',['as'=>'admin.khachhang.dsphieuthu','uses'=>'KhachhangController@dsphieuthu']);
  Route::get('phieu-thu/{id}',['as'=>'admin.khachhang.phieuthu','uses'=>'KhachhangController@xemphieuthu']);
});
//đơn hàng
Route::get('don-hang-chon-lo-san-pham/{id}', 'DonhangController@chonlo');

Route::post('luu-don-hang-theo-lo', 'DonhangController@postlolo');

Route::get('chi-tiet-don-hang-theo-lo/{id}','DonhangController@xemchitietdonhanglo');

Route::patch('cap-nhat-don-hang-theo-lo', 'DonhangController@capnhatdonlo');

Route::delete('xoa-don-hang-theo-lo', 'DonhangController@removedonlo');


Route::group(['prefix' => 'donhang'], function() {
  Route::get('danhsach',['as'=>'admin.donhang.list','uses'=>'DonhangController@getList']);
  Route::get('xem-don-hang/{id}',['as'=>'admin.donhang.getEdit','uses'=>'DonhangController@getEdit']);
  Route::post('xem-don-hang/{id}',['as'=>'admin.donhang.postEdit','uses'=>'DonhangController@postEdit']);
  Route::get('sua-thong-tin-giao-hang/{id}',['as'=>'admin.donhang.getEdit1','uses'=>'DonhangController@getEdit1']);
  Route::post('sua-thong-tin-giao-hang/{id}',['as'=>'admin.donhang.postEdit1','uses'=>'DonhangController@postEdit1']);
  Route::get('sua-thong-tin-thanh-toan/{id}',['as'=>'admin.donhang.getEdit2','uses'=>'DonhangController@getEdit2']);
  Route::post('sua-thong-tin-thanh-toan/{id}',['as'=>'admin.donhang.postEdit2','uses'=>'DonhangController@postEdit2']);
  Route::get('in-hoa-don/{id}',['as'=>'admin.donhang.pdf','uses'=>'DonhangController@pdf']);
  Route::get('chi-tiet-don-hang/{id}',['as'=>'admin.donhang.chitiet', 'uses'=>'DonhangController@chitietdonhang']);
  Route::get('san-pham-theo-lo/{id}',['as'=>'admin.donhanglo.list','uses'=>'DonhangController@xemsptheolo']);
});
//hàng hóa

Route::get('xemdv','HangHoaController@xemdonvi');
Route::get('themdv','HangHoaController@themdonvi');
Route::post('/luudv', 'HangHoaController@luudonvi');
Route::get('/suadv/{id}', 'HangHoaController@suadonvi');
Route::PATCH('/capnhatdv/{id}', 'HangHoaController@capnhatdonvi');
Route::get('/xoadv/{id}', 'HangHoaController@xoadonvi');

//nhà cung cấp
Route::get('xemncc','DoiTacController@xemnhacungcap');
Route::get('themncc','DoiTacController@themnhacungcap');
Route::post('luuncc','DoiTacController@luunhacungcap');
Route::get('/suancc/{id}', 'DoiTacController@suanhacungcap');
Route::PATCH('/capnhatncc/{id}', 'DoiTacController@capnhatnhacungcap');
Route::get('/xoancc/{id}', 'DoiTacController@xoanhacungcap');

//bình luận
Route::group(['prefix' => 'binhluan'], function() {
  Route::get('danhsach',['as'=>'binhluan.danhsach','uses'=>'BinhluanController@danhsachbl']);
  Route::get('xoa/{id}',['as'=>'binhluan.xoa','uses'=>'BinhluanController@xoabl']);
  Route::get('chap-nhan/{id}',['as'=>'binhluan.chapnhan','uses'=>'BinhluanController@chapnhan']);
  Route::get('khong-chap-nhan/{id}',['as'=>'binhluan.huychapnhan','uses'=>'BinhluanController@huychapnhan']);
});
//Khuyến mãi
Route::group(['prefix' => 'khuyenmai'], function() {
  Route::get('danhsach',['as'=>'admin.khuyenmai.list','uses'=>'KhuyenmaiController@xemdanhsachkm']);
  Route::get('them',['as'=>'admin.khuyenmai.getAdd','uses'=>'KhuyenmaiController@getAdd']);
  Route::post('them',['as'=>'admin.khuyenmai.postAdd','uses'=>'KhuyenmaiController@luukhuyenmai']);
  Route::get('xoa/{id}',['as'=>'admin.khuyenmai.getDelete','uses'=>'KhuyenmaiController@getDelete']);
  Route::get('sua/{id}',['as'=>'admin.khuyenmai.getEdit','uses'=>'KhuyenmaiController@getEdit']);
  Route::post('sua/{id}',['as'=>'admin.khuyenmai.postEdit','uses'=>'KhuyenmaiController@postEdit']);
  Route::get('them-san-pham-km',['as'=>'admin.khuyenmai.getAddPromotion','uses'=>'KhuyenmaiController@getAddPromotion']);
  Route::post('them-san-pham-km',['as'=>'admin.khuyenmai.postAddPromotion','uses'=>'KhuyenmaiController@postAddPromotion']);
  Route::get('sua-san-pham-km/{id}',['as'=>'admin.khuyenmai.getEditPromotion','uses'=>'KhuyenmaiController@getEditPromotion']);
  Route::post('sua-san-pham-km/{id}',['as'=>'admin.khuyenmai.postEditPromotion','uses'=>'KhuyenmaiController@postEditPromotion']);
});
//lô hàng
Route::get('lohang','LohangController@getList');
Route::get('themlohang','LohangController@getAdd');
Route::post('luulohang','LohangController@postAdd');
Route::get('xoalohang/{id}','LohangController@getDelete');
Route::get('sualohang/{id}','LohangController@getEdit');
Route::PATCH('/capnhatlohang/{id}','LohangController@postEdit');
Route::get('nhapsanpham/{id}','LohangController@getNhaphang');
Route::post('nhap-hang/{id}','LohangController@postNhaphang');
Route::get('nhap-hang/{id}',['as'=>'lohang.getNhaphang','uses'=>'LohangController@getNhaphang']);
Route::post('nhap-hang/{id}',['as'=>'lohang.postNhaphang','uses'=>'LohangController@postNhaphang']);
//Khuyến mãi trang chủ
//báo cáo thống kê
Route::group(['prefix' => 'thongke'], function() {
  Route::get('tong-quan',['as'=>'admin.thongke.list','uses'=>'BaocaoController@getList']);
  Route::get('san-pham-nhap-vao',['as'=>'admin.thongke.nhapvao','uses'=>'BaocaoController@getNhapvao']);
  Route::get('san-pham-ban-ra',['as'=>'admin.thongke.banra','uses'=>'BaocaoController@getBanra']);
  Route::get('san-pham-hien-co',['as'=>'admin.thongke.hienco','uses'=>'BaocaoController@getHienco']);
  Route::get('san-pham-doi-tra',['as'=>'admin.thongke.doitra','uses'=>'BaocaoController@getDoitra']);
  Route::get('san-pham-ban-chay',['as'=>'admin.thongke.banchay','uses'=>'BaocaoController@getBanchay']);
  Route::get('san-pham-ton-nhieu',['as'=>'admin.thongke.tonnhieu','uses'=>'BaocaoController@getTonnhieu']);
  Route::get('lo-hang-chua-duoc-ban',['as'=>'admin.thongke.chuaban','uses'=>'BaocaoController@getChuaban']);
  Route::get('lo-hang-het-han',['as'=>'admin.thongke.hethan','uses'=>'BaocaoController@getHethan']);
  Route::get('bao-cao-lo-hang-het-han',['as'=>'admin.thongke.baocaohethan','uses'=>'BaocaoController@baocaohethan']);
  Route::get('lo-hang-con-han',['as'=>'admin.thongke.conhan','uses'=>'BaocaoController@getConhan']);
  ///////////////////////////////////////////
  Route::get('cong-no-khach-hang',['as'=>'admin.thongke.congno','uses'=>'BaocaoController@congno']);
  Route::get('tong-hop-cong-no-khach-hang',['as'=>'admin.thongke.tonghopcongno','uses'=>'BaocaoController@tonghopcongno']);
  Route::get('cong-no-khach-hang-theo-ngay',['as'=>'admin.thongke.congnongay','uses'=>'BaocaoController@congnongay']);
  Route::post('cong-no-tuy-chon',['as'=>'admin.thongke.congnotuychon', 'uses'=>'BaocaoController@congnotuychon']);
  /////////////////////////////////////////////////////////
  Route::get('bao-cao',['as'=>'admin.thongke.baocao','uses'=>'BaocaoController@baocao']);
  Route::get('bao-cao-chi-tiet-don-ban',['as'=>'admin.donban.bcchitietdb', 'uses'=>'BaocaoController@dtctdonban']);
  Route::get('doanh-thu-donban-theo-ngay',['as'=>'admin.donban.doanhthungay', 'uses'=>'BaocaoController@doanhthungay']);
  Route::get('doanh-thu-donban-theo-tuan',['as'=>'admin.donban.dtdonbantuan', 'uses'=>'BaocaoController@dtdonbantuan']);
  Route::get('doanh-thu-donban-theo-thang',['as'=>'admin.donban.dtdonbanthang', 'uses'=>'BaocaoController@dtdonbanthang']);
  Route::post('doanh-thu-donban-tuy-chon',['as'=>'admin.donban.dtdonbantuychon', 'uses'=>'BaocaoController@dtdonbantuychon']);
  ///
  Route::get('bao-cao-chi-tiet-don-hang',['as'=>'admin.donhang.bcchitietdh', 'uses'=>'BaocaoController@dtctdonhang']);
  Route::get('doanh-thu-donhang-theo-ngay',['as'=>'admin.donhang.doanhthungay', 'uses'=>'BaocaoController@dhdoanhthungay']);
  Route::get('doanh-thu-donhang-theo-tuan',['as'=>'admin.donhang.dtdonhangtuan', 'uses'=>'BaocaoController@dtdonhangtuan']);
  Route::get('doanh-thu-donhang-theo-thang',['as'=>'admin.donhang.dtdonhangthang', 'uses'=>'BaocaoController@dtdonhangthang']);
  Route::post('doanh-thu-donhang-tuy-chon',['as'=>'admin.donhang.dtdonhangtuychon', 'uses'=>'BaocaoController@dtdonhangtuychon']);
  /////
  Route::get('bao-cao-chi-tiet-nhap-hang',['as'=>'admin.nhaphang.bcchitietnh', 'uses'=>'BaocaoController@ctnhaphang']);
  Route::get('bao-cao-nhaphang-theo-ngay',['as'=>'admin.nhaphang.nhapngay', 'uses'=>'BaocaoController@nhngay']);
  Route::get('bao-cao-nhaphang-theo-tuan',['as'=>'admin.nhaphang.nhaphangtuan', 'uses'=>'BaocaoController@nhaphangtuan']);
  Route::get('bao-cao-nhaphang-theo-thang',['as'=>'admin.nhaphang.nhaphangthang', 'uses'=>'BaocaoController@nhaphangthang']);
  Route::post('bao-cao-nhaphang-tuy-chon',['as'=>'admin.nhaphang.nhaphangtuychon', 'uses'=>'BaocaoController@nhaphangtuychon']);

});
//////////////////////////////////
Route::get('chi-tiet-bao-cao-doanh-thu-cua-hang-theo-ngay','BaocaoController@dtcuahday');
///////////////////////////////////////////
Route::group(['prefix' => 'nhanvien'], function() {
  Route::get('danhsach',['as'=>'admin.nhanvien.list','uses'=>'NhanvienController@getList']);
  Route::get('them',['as'=>'admin.nhanvien.getAdd','uses'=>'NhanvienController@getAdd']);
  Route::post('them',['as'=>'admin.nhanvien.postAdd','uses'=>'NhanvienController@postAdd']);
  Route::get('xoa/{id}',['as'=>'admin.nhanvien.getDelete','uses'=>'NhanvienController@getDelete']);
  Route::get('sua/{id}',['as'=>'admin.nhanvien.getEdit','uses'=>'NhanvienController@getEdit']);
  Route::post('sua/{id}',['as'=>'admin.nhanvien.postEdit','uses'=>'NhanvienController@postEdit']);
});
Route::group(['prefix' => 'vechungtoi'], function() {
  Route::get('danhsach',['as'=>'admin.vechungtoi.list','uses'=>'VechungtoiController@getList']);
  Route::get('them',['as'=>'admin.vechungtoi.getAdd','uses'=>'VechungtoiController@getAdd']);
  Route::post('them',['as'=>'admin.vechungtoi.postAdd','uses'=>'VechungtoiController@postAdd']);
  Route::get('xoa/{id}',['as'=>'admin.vechungtoi.getDelete','uses'=>'VechungtoiController@getDelete']);
  Route::get('sua/{id}',['as'=>'admin.vechungtoi.getEdit','uses'=>'VechungtoiController@getEdit']);
  Route::post('sua/{id}',['as'=>'admin.vechungtoi.postEdit','uses'=>'VechungtoiController@postEdit']);
});
Route::group(['prefix' => 'slider'], function() {
  Route::get('danhsach',['as'=>'admin.slider.list','uses'=>'SliderController@getList']);
  Route::get('them',['as'=>'admin.slider.getAdd','uses'=>'SliderController@getAdd']);
  Route::post('them',['as'=>'admin.slider.postAdd','uses'=>'SliderController@postAdd']);
  Route::get('xoa/{id}',['as'=>'admin.slider.getDelete','uses'=>'SliderController@getDelete']);
  Route::get('sua/{id}',['as'=>'admin.slider.getEdit','uses'=>'SliderController@getEdit']);
  Route::post('sua/{id}',['as'=>'admin.slider.postEdit','uses'=>'SliderController@postEdit']);
});
Route::group(['prefix' => 'tuyendung'], function() {
  Route::get('danhsach',['as'=>'admin.tuyendung.list','uses'=>'TuyendungController@getList']);
  Route::get('them',['as'=>'admin.tuyendung.getAdd','uses'=>'TuyendungController@getAdd']);
  Route::post('them',['as'=>'admin.tuyendung.postAdd','uses'=>'TuyendungController@postAdd']);
  Route::get('xoa/{id}',['as'=>'admin.tuyendung.getDelete','uses'=>'TuyendungController@getDelete']);
  Route::get('sua/{id}',['as'=>'admin.tuyendung.getEdit','uses'=>'TuyendungController@getEdit']);
  Route::post('sua/{id}',['as'=>'admin.tuyendung.postEdit','uses'=>'TuyendungController@postEdit']);
});

Route::get('khuyen-mai', 'HomeController@khuyenmaitrangchu');

Route::get('khuyen-mai/{urlKM}', 'HomeController@chitietkhuyenmaitrangchu');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('dia-chi', 'HomeController@bando');
Route::get('gioi-thieu', 'HomeController@gioithieu');
Route::get('chinh-sach-bao-mat', 'HomeController@chinhsachbm');


//yêu thích
Route::get('switchToWishlist/{id}', 'WishlistController@switchToWishlist');

Route::PATCH('update/{id}', 'WishlistController@update');

Route::post('switchToCart/{id}', 'WishlistController@switchToCart');

Route::delete('emptyWishlist', 'WishlistController@emptyWishlist');

Route::resource('wishlist', 'WishlistController');

// Route::get('ban', 'BanhangController@index');
// Route::get('trang-ban-hang', 'BanhangController@trangbanhang');

Route::get('danhsach',['as'=>'admin.bannoibo.list','uses'=>'BanhangController@getList']);

Route::get('AddBan/{id}', 'BanhangController@AddBan');

Route::get('danh-sach-don-hang', 'BanhangController@dsdonhang');

Route::patch('cap-nhat-ban', 'BanhangController@capnhat');

Route::delete('xoa-ban', 'BanhangController@remove');

Route::get('thanh-toan-don', 'BanhangController@getthanhtoan');

Route::post('thanh-toan-don-ban', 'BanhangController@postthanhtoan');

Route::get('chon-lo-san-pham/{id}', 'DonbanController@chonlo');

Route::post('luu-sanpham-theo-lo', 'DonbanController@postlo');
Route::post('luu-san-pham-theo-lo', 'DonbanController@postlolo');
Route::get('chi-tiet-ban-theo-lo/{id}','DonbanController@xemchitietdonlo')->name('xemchitietdonlo');

Route::patch('cap-nhat-don-ban-theo-lo', 'DonbanController@capnhatdonlo');

Route::delete('xoa-don-ban-theo-lo', 'DonbanController@removedonlo');
//phiếu thu
Route::group(['prefix' => 'phieuthu'], function() {
  Route::get('tao-phieu-thu-khach-mua/{id}',['as'=>'admin.phieuthu.getkhachmua','uses'=>'PhieuthuController@getphieuthukm']);
  Route::post('tao-phieu-thu-khach-mua',['as'=>'admin.phieuthu.postkhachmua','uses'=>'PhieuthuController@postphieuthukm']);
  Route::get('in-phieu-thu-khach-mua/{id}',['as'=>'admin.phieuthu.pdfkm','uses'=>'PhieuthuController@pdfkm']);

  Route::get('tao-phieu-thu-khach-hang/{id}',['as'=>'admin.phieuthu.getkhachhang','uses'=>'PhieuthuController@getphieuthukh']);
  Route::post('tao-phieu-thu-khach-hang',['as'=>'admin.phieuthu.postkhachhang','uses'=>'PhieuthuController@postphieuthukh']);
  Route::get('in-phieu-thu-khach-hang/{id}',['as'=>'admin.phieuthu.pdfkh','uses'=>'PhieuthuController@pdfkh']);
});
//đơn bán hàng nội bộ
Route::group(['prefix' => 'donban'], function() {
  Route::get('danhsach',['as'=>'admin.donban.list','uses'=>'DonbanController@getList']);
  Route::get('xem-don-hang/{id}',['as'=>'admin.donban.getEdit','uses'=>'DonbanController@getEdit']);
  Route::post('xem-don-hang/{id}',['as'=>'admin.donban.postEdit','uses'=>'DonbanController@postEdit']);
  Route::get('sua-thong-tin-giao-hang/{id}',['as'=>'admin.donban.getEdit1','uses'=>'DonbanController@getEdit1']);
  Route::post('sua-thong-tin-giao-hang/{id}',['as'=>'admin.donban.postEdit1','uses'=>'DonbanController@postEdit1']);
  Route::get('sua-thong-tin-thanh-toan/{id}',['as'=>'admin.donban.getEdit2','uses'=>'DonbanController@getEdit2']);
  Route::post('sua-thong-tin-thanh-toan/{id}',['as'=>'admin.donban.postEdit2','uses'=>'DonbanController@postEdit2']);
  Route::get('in-hoa-don/{id}',['as'=>'admin.donban.pdf','uses'=>'DonbanController@pdf']);
  Route::get('chi-tiet-don-ban/{id}',['as'=>'admin.donban.chitiet', 'uses'=>'DonbanController@chitietdonban']);
});
//khách mua hàng nội bộ
//khách hàng
Route::group(['prefix' => 'khachmua'], function() {
  Route::get('danhsach',['as'=>'admin.khachmua.list','uses'=>'KhachmuaController@getList']);
  Route::get('them',['as'=>'admin.khachmua.getAdd','uses'=>'KhachmuaController@getAdd']);
  Route::get('xoa/{id}',['as'=>'admin.khachmua.getDelete','uses'=>'KhachmuaController@getDelete']);
  Route::get('sua/{id}',['as'=>'admin.khachmua.getEdit','uses'=>'KhachmuaController@getEdit']);
  Route::post('sua/{id}',['as'=>'admin.khachmua.postEdit','uses'=>'KhachmuaController@postEdit']);
  Route::get('xem-lich-su-mua-hang/{id}',['as'=>'admin.khachmua.getHistory','uses'=>'KhachmuaController@getHistory']);
  Route::get('xem-chi_tiet-khachmua/{id}',['as'=>'admin.khachmuact.list','uses'=>'KhachmuaController@xemctkm']);
  Route::get('dsphieuthu',['as'=>'admin.khachmua.dsphieuthu','uses'=>'KhachmuaController@dsphieuthu']);
  Route::get('phieu-thu/{id}',['as'=>'admin.khachmua.phieuthu','uses'=>'KhachmuaController@xemphieuthu']);
});
Route::post('them-khach-mua','KhachmuaController@postAdd');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/load-latest-messages', 'MessagesController@getLoadLatestMessages');
Route::post('/send', 'MessagesController@postSendMessage');
Route::get('/fetch-old-messages', 'MessagesController@getOldMessages');

Route::patch('update_cart_quantity', 'HomeController@update_cart_quantity');
Route::get('demo', 'HomeController@demo');

Route::get('bcton','BaoCaoController@baocaoTon');
Route::get('time', 'BaoCaoController@timeHH');
Route::get('bcchi','BaoCaoController@baocaoChi');
Route::get('theongay','BaoCaoController@bacaotheongay');
Route::get('tongtheongay','BaoCaoController@tongbacaotheongay');
Route::get('thutheongay','BaoCaoController@bacaothutheongay');
Route::get('tongthutheongay','BaoCaoController@tongbacaothutheongay');

Route::get('my-notification/{type}', 'HomeController@myNotification');

Auth::routes();