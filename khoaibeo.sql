DROP TABLE IF EXISTS `binhluan`;
CREATE TABLE IF NOT EXISTS `binhluan` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `binhluan_ten` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `binhluan_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `binhluan_noi_dung` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `binhluan_trang_thai` int(11) NOT NULL,
  `sanpham_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `binhluan_sanpham_id_foreign` (`sanpham_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdonban`
--

DROP TABLE IF EXISTS `chitietdonban`;
CREATE TABLE IF NOT EXISTS `chitietdonban` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sanpham_id` int(10) UNSIGNED NOT NULL,
  `donban_id` int(10) UNSIGNED NOT NULL,
  `chitietdonban_so_luong` int(11) NOT NULL,
  `chitietdonban_thanh_tien` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `chitietdonban_sanpham_id_foreign` (`sanpham_id`),
  KEY `chitietdonban_donban_id_foreign` (`donban_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


--
-- Cấu trúc bảng cho bảng `chitietdonhang`
--

DROP TABLE IF EXISTS `chitietdonhang`;
CREATE TABLE IF NOT EXISTS `chitietdonhang` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sanpham_id` int(10) UNSIGNED NOT NULL,
  `donhang_id` int(10) UNSIGNED NOT NULL,
  `chitietdonhang_so_luong` int(11) NOT NULL,
  `chitietdonhang_thanh_tien` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `chitietdonhang_sanpham_id_foreign` (`sanpham_id`),
  KEY `chitietdonhang_donhang_id_foreign` (`donhang_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ctbantheolo`
--

DROP TABLE IF EXISTS `ctbantheolo`;
CREATE TABLE IF NOT EXISTS `ctbantheolo` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ctbantheolo_ma` int(11) NOT NULL,
  `ctdonban_id` int(11) NOT NULL,
  `lohang_id` int(10) UNSIGNED NOT NULL,
  `ctbantheolo_so_luong` int(11) NOT NULL,
  `ctbantheolo_thanh_tien` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ctbantheolo_lohang_id_foreign` (`lohang_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cttheolo`
--

DROP TABLE IF EXISTS `cttheolo`;
CREATE TABLE IF NOT EXISTS `cttheolo` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cttheolo_ma` int(11) NOT NULL,
  `ctdonhang_id` int(11) NOT NULL,
  `lohang_id` int(10) UNSIGNED NOT NULL,
  `cttheolo_so_luong` int(11) NOT NULL,
  `cttheolo_thanh_tien` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cttheolo_lohang_id_foreign` (`lohang_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donban`
--

DROP TABLE IF EXISTS `donban`;
CREATE TABLE IF NOT EXISTS `donban` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `donban_nguoi_nhan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `donban_nguoi_nhan_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `donban_nguoi_nhan_sdt` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `donban_nguoi_nhan_dia_chi` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `donban_ghi_chu` longtext COLLATE utf8mb4_unicode_ci,
  `donban_tong_tien` decimal(10,2) NOT NULL,
  `khachmua_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `tinhtranghd_id` int(10) UNSIGNED NOT NULL,
  `donban_xu_ly` int(11) NOT NULL,
  `donban_ngay_ban` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `donban_khachmua_id_foreign` (`khachmua_id`),
  KEY `donban_user_id_foreign` (`user_id`),
  KEY `donban_tinhtranghd_id_foreign` (`tinhtranghd_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

DROP TABLE IF EXISTS `donhang`;
CREATE TABLE IF NOT EXISTS `donhang` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `donhang_nguoi_nhan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `donhang_nguoi_nhan_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `donhang_nguoi_nhan_sdt` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `donhang_nguoi_nhan_dia_chi` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `donhang_ghi_chu` longtext COLLATE utf8mb4_unicode_ci,
  `donhang_tong_tien` decimal(10,2) NOT NULL,
  `khachhang_id` int(10) UNSIGNED NOT NULL,
  `tinhtranghd_id` int(10) UNSIGNED NOT NULL,
  `donhang_xu_ly` int(11) NOT NULL,
  `donhang_ngay_ban` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `donhang_khachhang_id_foreign` (`khachhang_id`),
  KEY `donhang_tinhtranghd_id_foreign` (`tinhtranghd_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donvitinh`
--

DROP TABLE IF EXISTS `donvitinh`;
CREATE TABLE IF NOT EXISTS `donvitinh` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `donvitinh_ten` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `donvitinh_mo_ta` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

DROP TABLE IF EXISTS `khachhang`;
CREATE TABLE IF NOT EXISTS `khachhang` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `khachhang_ten` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khachhang_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khachhang_sdt` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khachhang_dia_chi` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `khachhang_tonno_dk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khachhang_tonco_dk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khachhang_phat_sinh_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khachhang_phat_sinh_co` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khachhang_tonno_ck` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khachhang_tonco_ck` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `khachhang_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachmua`
--

DROP TABLE IF EXISTS `khachmua`;
CREATE TABLE IF NOT EXISTS `khachmua` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `khachmua_ten` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khachmua_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khachmua_sdt` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khachmua_dia_chi` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khachmua_tonno_dk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khachmua_tonco_dk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khachmua_phat_sinh_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khachmua_phat_sinh_co` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khachmua_tonno_ck` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khachmua_tonco_ck` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khuyenmai`
--

DROP TABLE IF EXISTS `khuyenmai`;
CREATE TABLE IF NOT EXISTS `khuyenmai` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `khuyenmai_tieu_de` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khuyenmai_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khuyenmai_noi_dung` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `khuyenmai_anh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khuyenmai_phan_tram` int(11) NOT NULL,
  `khuyenmai_thoi_gian` int(11) NOT NULL,
  `khuyenmai_tinh_trang` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loainguoidung`
--

DROP TABLE IF EXISTS `loainguoidung`;
CREATE TABLE IF NOT EXISTS `loainguoidung` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `loainguoidung_ten` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loainguoidung`
--


-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaisanpham`
--

DROP TABLE IF EXISTS `loaisanpham`;
CREATE TABLE IF NOT EXISTS `loaisanpham` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `loaisanpham_ten` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loaisanpham_url` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loaisanpham_mo_ta` longtext COLLATE utf8mb4_unicode_ci,
  `loaisanpham_anh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nhom_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `loaisanpham_nhom_id_foreign` (`nhom_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lohang`
--

DROP TABLE IF EXISTS `lohang`;
CREATE TABLE IF NOT EXISTS `lohang` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lohang_ky_hieu` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lohang_han_su_dung` int(11) NOT NULL,
  `lohang_gia_mua_vao` decimal(10,2) NOT NULL,
  `lohang_so_luong_nhap` int(11) NOT NULL,
  `lohang_so_luong_da_ban` int(11) NOT NULL,
  `lohang_so_luong_doi_tra` int(11) NOT NULL,
  `lohang_so_luong_hien_tai` int(11) NOT NULL,
  `lohang_ngay_nhap` date NOT NULL,
  `lohang_tinh_trang` int(11) DEFAULT NULL,
  `sanpham_id` int(10) UNSIGNED NOT NULL,
  `nhacungcap_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lohang_sanpham_id_foreign` (`sanpham_id`),
  KEY `lohang_nhacungcap_id_foreign` (`nhacungcap_id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lydo`
--

DROP TABLE IF EXISTS `lydo`;
CREATE TABLE IF NOT EXISTS `lydo` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mo_ta` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhacungcap`
--

DROP TABLE IF EXISTS `nhacungcap`;
CREATE TABLE IF NOT EXISTS `nhacungcap` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nhacungcap_ten` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nhacungcap_dia_chi` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nhacungcap_sdt` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhacungcap`
--


-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

DROP TABLE IF EXISTS `nhanvien`;
CREATE TABLE IF NOT EXISTS `nhanvien` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nhanvien_ten` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nhanvien_cmnd` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nhanvien_sdt` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nhanvien_dia_chi` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nhanvien_ngay_vao_lam` date NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nhanvien_nhanvien_cmnd_unique` (`nhanvien_cmnd`),
  KEY `nhanvien_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--


-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhom`
--

DROP TABLE IF EXISTS `nhom`;
CREATE TABLE IF NOT EXISTS `nhom` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nhom_ten` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nhom_url` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nhom_mo_ta` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

DROP TABLE IF EXISTS `sanpham`;
CREATE TABLE IF NOT EXISTS `sanpham` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sanpham_ky_hieu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sanpham_ten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sanpham_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sanpham_anh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sanpham_mo_ta` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `sanpham_gia_ban` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sanpham_khuyenmai` int(11) NOT NULL,
  `loaisanpham_id` int(10) UNSIGNED NOT NULL,
  `donvitinh_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sanpham_loaisanpham_id_foreign` (`loaisanpham_id`),
  KEY `sanpham_donvitinh_id_foreign` (`donvitinh_id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanphamkhuyenmai`
--

DROP TABLE IF EXISTS `sanphamkhuyenmai`;
CREATE TABLE IF NOT EXISTS `sanphamkhuyenmai` (
  `khuyenmai_id` int(10) UNSIGNED NOT NULL,
  `sanpham_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `sanphamkhuyenmai_khuyenmai_id_foreign` (`khuyenmai_id`),
  KEY `sanphamkhuyenmai_sanpham_id_foreign` (`sanpham_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `slider`
--

DROP TABLE IF EXISTS `slider`;
CREATE TABLE IF NOT EXISTS `slider` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `slider_ten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slider_anh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thukh`
--

DROP TABLE IF EXISTS `thukh`;
CREATE TABLE IF NOT EXISTS `thukh` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `khachhang_id` int(11) NOT NULL,
  `tien_thu` decimal(10,2) NOT NULL,
  `ly_do_thu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thukm`
--

DROP TABLE IF EXISTS `thukm`;
CREATE TABLE IF NOT EXISTS `thukm` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `khachmua_id` int(11) NOT NULL,
  `tien_thu` decimal(10,2) NOT NULL,
  `ly_do_thu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tinhtranghd`
--

DROP TABLE IF EXISTS `tinhtranghd`;
CREATE TABLE IF NOT EXISTS `tinhtranghd` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tinhtranghd_ten` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tinhtranghd_mo_ta` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loainguoidung_id` int(10) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_loainguoidung_id_foreign` (`loainguoidung_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_activations`
--

DROP TABLE IF EXISTS `user_activations`;
CREATE TABLE IF NOT EXISTS `user_activations` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `user_activations_token_index` (`token`(250))
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user_activations`
--

INSERT INTO `user_activations` (`user_id`, `token`, `created_at`, `updated_at`) VALUES
(3, '3dbef65c4144b533210d4aaa51e393f7e7e9ee12f29636cb20f91021adda10d3', '2020-07-01 07:58:11', NULL),
(4, 'bc55288580480761e08355ac51f510fb3e3f28e5caf2047a0f6395ef81bf872b', '2020-07-01 08:04:43', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vechungtoi`
--

DROP TABLE IF EXISTS `vechungtoi`;
CREATE TABLE IF NOT EXISTS `vechungtoi` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `vechungtoi_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vechungtoi_tieu_de` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `vechungtoi_noi_dung` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `vechungtoi_anh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vechungtoi_ngay_tao` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `vechungtoi`
--

INSERT INTO `vechungtoi` (`id`, `vechungtoi_url`, `vechungtoi_tieu_de`, `vechungtoi_noi_dung`, `vechungtoi_anh`, `vechungtoi_ngay_tao`, `created_at`, `updated_at`) VALUES
(1, 'mau-son-noi-that-nao-kich-thich-su-sang-tao?', 'Màu sơn nội thất nào kích thích sự sáng tạo?', '<p>&emsp;</p>\r\n\r\n<p>Sự s&aacute;ng tạo v&agrave; hiệu quả c&ocirc;ng việc l&agrave; điều m&agrave; bất cứ ai cũng mong muốn nhưng đ&oacute; l&agrave; th&aacute;ch thức m&agrave; kh&ocirc;ng phải ai cũng c&oacute; thể đạt được. Lựa chọn m&agrave;u sắc hợp l&yacute; cho kh&ocirc;ng gian của bạn c&oacute; thể thay đổi điều n&agrave;y kh&ocirc;ng? C&ugrave;ng kh&aacute;m ph&aacute; b&agrave;i viết dưới đ&acirc;y để t&igrave;m c&acirc;u trả lời</p>\r\n\r\n<p>&emsp;</p>\r\n\r\n<p>B&agrave; Alexcandra Arens, người đồng s&aacute;ng lập thương hiệu Claribel đ&atilde; chia sẻ về l&yacute; do họ chọn m&agrave;u sắc cho bộ sưu tập m&ugrave;a h&egrave; sắp tới. Đ&oacute; l&agrave; bởi họ muốn kh&aacute;ch h&agrave;ng cảm thấy thoải m&aacute;i v&agrave; tr&agrave;n đầy năng lượng th&ocirc;ng qua những tone m&agrave;u ấn tượng.</p>\r\n\r\n<p>M&ocirc;i trường l&agrave;m việc l&agrave; nơi kh&ocirc;ng tr&aacute;nh khỏi những ồn &agrave;o v&agrave; sự mất tập trung. Để c&oacute; năng suất c&ocirc;ng việc cao nhất, bạn phải biết c&aacute;ch lờ đi mọi thứ xung quanh v&agrave; chỉ tập trung v&agrave;o những thứ m&igrave;nh đang l&agrave;m.</p>\r\n\r\n<p>Theo số liệu so s&aacute;nh gần đ&acirc;y nhất được c&ocirc;ng bố bởi Văn ph&ograve;ng Thống K&ecirc; Quốc Gia Vương Quốc Anh, năng suất l&agrave;m việc trung b&igrave;nh trong 4 ng&agrave;y của người ch&acirc;u &Acirc;u cao hơn so với 5 ng&agrave;y của người Anh. Điều n&agrave;y l&agrave; hồi chu&ocirc;ng b&aacute;o động người Anh cần thay đổi &ndash; nhưng l&agrave;m thế n&agrave;o?</p>\r\n\r\n<p>Thực tế, c&oacute; nhiều nh&agrave; khoa học đ&atilde; chứng minh rằng, năng suất lao động của 1 người bắt nguồn từ kh&ocirc;ng gian họ l&agrave;m việc. Sắp xếp kh&ocirc;ng gian hợp l&yacute; kh&ocirc;ng chỉ gi&uacute;p cải thiện hiệu quả c&ocirc;ng việc m&agrave; c&ograve;n k&iacute;ch th&iacute;ch tr&iacute; tưởng tượng. Tất cả mọi thứ xung quanh bạn đều c&oacute; t&aacute;c động nhất định đến những việc bạn đang l&agrave;m.</p>\r\n\r\n<p>B&agrave;i viết dưới đ&acirc;y sẽ gợi &yacute; cho bạn 1 số m&agrave;u&nbsp;Sơn nội thất&nbsp;ph&ugrave; hợp gi&uacute;p n&acirc;ng cao hiệu quả c&ocirc;ng việc</p>\r\n\r\n<p>&emsp;</p>\r\n\r\n<p><strong>M&agrave;u trắng</strong></p>\r\n\r\n<p><strong><img alt=\"\" src=\"http://trinitydecor.vn/uploads/white-colour-feeling-920x920(1).jpg\" style=\"height:350px; width:1160px\" /></strong></p>\r\n\r\n<p>M&agrave;u trắng thường được xem l&agrave; lựa chọn an to&agrave;n trong thiết kế nội thất bởi t&iacute;nh linh hoạt v&agrave; dễ kết hợp của n&oacute;. Gần đ&acirc;y, xu hướng nội thất Bắc &Acirc;u đang dần trở n&ecirc;n phổ biến khiến tone m&agrave;u trắng &ndash; đen tr&agrave;n ngập mọi gia đ&igrave;nh. Tăng th&ecirc;m sắc trắng hoặc m&agrave;u ng&agrave; v&agrave; c&aacute;c m&agrave;u trung lập kh&aacute;c l&agrave; điều l&yacute; tưởng để tăng năng suất l&agrave;m việc, đồng thời tạo ra 1 kh&ocirc;ng gian đơn giản, &iacute;t sự d&iacute;nh mắc.</p>\r\n\r\n<div class=\"row\">\r\n<div class=\"col-lg-6\">\r\n<p>&nbsp;</p>\r\n</div>\r\n</div>\r\n\r\n<p>&emsp;</p>\r\n\r\n<p><strong>M&agrave;u v&agrave;ng đồng</strong></p>\r\n\r\n<p><img alt=\"\" src=\"http://trinitydecor.vn/uploads/living-room-gold-colour-productive-920x920(1).jpg\" style=\"height:350px; width:1160px\" /></p>\r\n\r\n<p>V&agrave;ng đồng l&agrave; một m&agrave;u rất sức mạnh &ndash; m&agrave;u sắc của sự tự tin v&agrave; th&agrave;nh c&ocirc;ng. Ở bất kỳ kh&ocirc;ng gian n&agrave;o, n&oacute; cũng tạo n&ecirc;n sự thanh nh&atilde; v&agrave; sang trọng. M&agrave;u gold cũng được xem l&agrave; m&agrave;u của sự thịnh vượng, tinh tế v&agrave; năng động. Khi thử &aacute;p dụng m&agrave;u n&agrave;y v&agrave;o kh&ocirc;ng gian l&agrave;m việc n&oacute; cũng tạo n&ecirc;n hiệu quả tuyệt vời. Bạn h&atilde;y thử trang tr&iacute; 1 chiếc gối với m&agrave;u gold, hoặc c&aacute;c đồ nội thất kh&aacute;c, hiệu quả sẽ đến v&ocirc; c&ugrave;ng bất ngờ.</p>\r\n\r\n<p>Lưu &yacute;: Bạn kh&ocirc;ng n&ecirc;n lạm dụng qu&aacute; nhiều m&agrave;u gold trong kh&ocirc;ng gian của m&igrave;nh. Kh&ocirc;ng n&ecirc;n sơn to&agrave;n bộ mảng tường lớn nh&agrave; m&igrave;nh với m&agrave;u n&agrave;y m&agrave; h&atilde;y c&acirc;n nhắc th&ecirc;m n&oacute; để tạo điểm nhấn sang trọng cho ng&ocirc;i nh&agrave;.</p>\r\n\r\n<p>&emsp;</p>\r\n\r\n<p><strong>M&agrave;u ngọc lam</strong></p>\r\n\r\n<p><img alt=\"\" src=\"http://trinitydecor.vn/uploads/bedroom-colour-feeling-920x920%20(1).jpg\" style=\"height:350px; width:1160px\" /></p>\r\n\r\n<p>Ngọc lam l&agrave; m&agrave;u sắc kh&aacute; th&uacute; vị. Trinity gợi &yacute; bạn n&ecirc;n sử dụng m&agrave;u n&agrave;y bởi n&oacute; l&agrave; sự kết hợp của 2 m&agrave;u xanh dương v&agrave; xanh l&aacute;. Xanh dương l&agrave; tượng trưng của năng suất, c&ograve;n xanh l&agrave; l&agrave; m&agrave;u của sự nhẹ nh&agrave;ng v&agrave; c&acirc;n bằng. Tone m&agrave;u đậm v&agrave; tươi s&aacute;ng n&agrave;y chắc chắn sẽ l&agrave;m bừng tỉnh mọi kh&ocirc;ng gian. Bằng việc th&ecirc;m m&agrave;u ngọc lam v&agrave;o 1 phần trong ng&ocirc;i nh&agrave; cũng c&oacute; thể khiến bạn thổi b&ugrave;ng s&aacute;ng tạo v&agrave; th&ecirc;m động lực l&agrave;m việc.</p>\r\n\r\n<p>M&agrave;u ngọc lam n&agrave;y ho&agrave;n hảo cho kh&ocirc;ng gian ph&ograve;ng bếp, ph&ograve;ng tắm hoặc ph&ograve;ng ngủ. Tỉnh giấc v&agrave;o mỗi buổi s&aacute;ng v&agrave; thứ đầu ti&ecirc;n bạn nh&igrave;n thấy m&agrave; một m&agrave;u ngọc lam sống động, chắc chắn sẽ tạo hứng khởi để bạn sẵn s&agrave;ng một ng&agrave;y mới.</p>', 'hinh-anh-thu-te-can-ho-noi-that-hoan-my.jpg', '2020-05-16', NULL, NULL),
(2, '5-mau-son-nha-pho-bien-khong-loi-thoi', '5 màu sơn nhà phổ biến không lỗi thời', '<p>&emsp;</p>\r\n\r\n<p>5 mẫu Sơn nội thất&nbsp;được lựa chọn nhiều nhất l&agrave; g&igrave;?</p>\r\n\r\n<p>&emsp;</p>\r\n\r\n<p><strong>M&agrave;u trắng tinh khiết:</strong>&nbsp;Trong tất cả c&aacute;c bảng m&agrave;u th&igrave; tone trắng l&agrave; tone m&agrave;u nguy&ecirc;n thủy nhất, c&oacute; thể phối với bất kỳ m&oacute;n vật dụng n&agrave;o cũng như ph&ugrave; hợp với bất kỳ phong c&aacute;ch kiến tr&uacute;c n&agrave;o. V&agrave; được xem l&agrave; m&agrave;u sơn kh&ocirc;ng bao giờ lỗi mốt.</p>\r\n\r\n<p><img alt=\"\" src=\"http://qtvietnam.com.vn/wp-content/uploads/2019/08/1.jpg\" style=\"height:450px; width:1160px\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Bất kỳ l&agrave; d&ugrave;ng cho khu vực ngoại thất, hay nội thất của ng&ocirc;i nh&agrave;. M&agrave;u sơn trắng lu&ocirc;n thể hiện được sự tinh tế, mang lại một kh&ocirc;ng gian tho&aacute;ng đ&atilde;ng, sang trọng. V&igrave; c&oacute; thể kết hợp với bất kỳ tone m&agrave;u nhấn n&agrave;o, m&agrave;u trắng lu&ocirc;n tạo n&ecirc;n cảm gi&aacute;c tươi mới, trẻ trung hay đẳng cấp sang trọng t&ugrave;y thuộc v&agrave;o nhu cầu thực tế của gia chủ.</p>\r\n\r\n<p>&emsp;</p>\r\n\r\n<p><strong>M&agrave;u x&aacute;m trang nh&atilde;:</strong>&nbsp;Một trong những m&agrave;u Sơn nội thất&nbsp;được c&aacute;c gia chủ lựa chọn nhiều trong năm 2019 l&agrave; gam m&agrave;u x&aacute;m trang nh&atilde;. Đ&acirc;y l&agrave; m&agrave;u sắc được sử dụng nhiều ở những c&ocirc;ng tr&igrave;nh nh&agrave; phố cao cấp hoặc c&aacute;c căn hộ chung cư hiện đại. N&oacute; đem đến cảm gi&aacute;c h&agrave;i h&ograve;a, tinh tế cho kh&ocirc;ng gian sống.</p>\r\n\r\n<p><img alt=\"\" src=\"http://qtvietnam.com.vn/wp-content/uploads/2019/08/2.jpg\" style=\"height:450px; width:1160px\" /></p>\r\n\r\n<p>Tuy c&oacute; sắc độ kh&aacute; nhẹ nh&agrave;ng, song tone m&agrave;u x&aacute;m lu&ocirc;n thể hiện tốt vai tr&ograve; của n&oacute; khi tạo được điểm nhấn cho ng&ocirc;i nh&agrave;, mang lại chiều s&acirc;u kh&ocirc;ng gian cũng như gi&uacute;p t&ocirc;n l&ecirc;n vẻ đẹp của c&aacute;c vật dụng nội thất bằng gỗ, khiến cho người nh&igrave;n kh&ocirc;ng thể rời mắt.</p>\r\n\r\n<p>&emsp;</p>\r\n\r\n<p><strong>M&agrave;u san h&ocirc; ấm &aacute;p:</strong>&nbsp;Mặc d&ugrave; kh&aacute; k&eacute;n chọn kh&ocirc;ng gian, nhưng tone m&agrave;u san h&ocirc; lu&ocirc;n giữ được vẻ đẹp của n&oacute; trong thời gian d&agrave;i v&agrave; kh&ocirc;ng l&agrave;m cho c&aacute;c gia chủ thất vọng về gi&aacute; trị thẩm mỹ n&oacute; mang lại. Trong năm 2019, bạn sẽ thấy được sự nổi bật, thịnh h&agrave;nh của tone m&agrave;u n&agrave;y.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"http://qtvietnam.com.vn/wp-content/uploads/2019/08/3.jpg\" style=\"height:450px; width:1160px\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Cảm gi&aacute;c ấn tượng giữa sự pha trộn của sắc cam v&agrave; hồng kh&ocirc;ng chỉ khiến cho ng&ocirc;i nh&agrave; c&oacute; cảm gi&aacute;c tươi trẻ hiện đại m&agrave; c&ograve;n tạo n&ecirc;n m&ocirc;i trường sống ấm &aacute;p, quầy quần giữa c&aacute;c th&agrave;nh vi&ecirc;n trong nh&agrave;.</p>\r\n\r\n<p>&emsp;</p>\r\n\r\n<p><strong>M&agrave;u be c&aacute; t&iacute;nh:</strong>&nbsp;C&oacute; sắc độ đậm hơn m&agrave;u x&aacute;m, thể hiện sự c&aacute; t&iacute;nh, mạnh mẽ trong kh&ocirc;ng gian sống. Mảng m&agrave;u be lu&ocirc;n khiến cho ng&ocirc;i nh&agrave; trở n&ecirc;n độc đ&aacute;o hơn. L&agrave; tone m&agrave;u thi&ecirc;n về sắc độ tối, tuy nhi&ecirc;n n&oacute; l&agrave; một trong những bảng m&agrave;u kh&aacute; linh hoạt, ph&ugrave; hợp với nhiều phong c&aacute;ch kiến tr&uacute;c v&agrave; kh&ocirc;ng qu&aacute; k&eacute;n c&aacute;c phụ kiện trang tr&iacute; đi k&egrave;m.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"http://qtvietnam.com.vn/wp-content/uploads/2019/08/4.jpg\" style=\"height:450px; width:1160px\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Nếu bạn sở hữu một ng&ocirc;i nh&agrave;, hoặc căn hộ c&oacute; thiết kế hiện đại, đơn giản với diện t&iacute;ch rộng r&atilde;i th&igrave; đ&acirc;y sẽ l&agrave; một lựa chọn ph&ugrave; hợp.</p>\r\n\r\n<p><strong>Hiện đại v&agrave; sang trọng với Cavern Clay:</strong>&nbsp;Sẽ v&ocirc; c&ugrave;ng th&uacute; vị nếu bạn đang t&igrave;m kiếm sự tươi mới v&agrave; một ch&uacute;t kh&aacute;c lạ cho căn nh&agrave; của m&igrave;nh, th&igrave; tone m&agrave;u n&agrave;y sẽ v&ocirc; c&ugrave;ng th&iacute;ch hợp. Bạn sẽ t&igrave;m thấy sự b&igrave;nh y&ecirc;n, nhẹ nh&agrave;ng của thi&ecirc;n nhi&ecirc;n với bảng m&agrave;u n&agrave;y. Th&ocirc;ng thường, m&agrave;u sơn nội thất&nbsp;n&agrave;y sẽ được d&ugrave;ng l&agrave;m điểm nhấn ch&iacute;nh cho kh&ocirc;ng gian ph&ograve;ng ngủ, h&agrave;nh lang, c&aacute;c mảng tường ở ph&ograve;ng kh&aacute;ch đem đến sự mới lạ, hiện đại v&agrave; sang trọng cho kh&ocirc;ng gian.</p>', 'maunha.jpg', '2020-05-16', NULL, NULL),
(3, 'cach-chon-loai-son-noi-that-an-toan', 'Cách chọn loại sơn nội thất an toàn', '&emsp;<p>Sơn l&agrave; vật liệu x&acirc;y dựng được sử dụng rộng r&atilde;i nhất khi trang tr&iacute; cải tạo nh&agrave; ở cũ. Tuy nhi&ecirc;n, khi sử dụng Sơn nội thất&nbsp;kh&ocirc;ng đủ ti&ecirc;u chuẩn, t&aacute;c hại m&agrave; n&oacute; g&acirc;y ra cũng nguy hiểm v&agrave; kh&oacute; chữa trị nhất. V&igrave; thế, h&ocirc;m nay ch&uacute;ng ta sẽ đi t&igrave;m hiểu về c&aacute;ch chọn loại Sơn nội thất&nbsp;an to&agrave;n, kh&ocirc;ng g&acirc;y hại tới sức khỏe con người v&agrave; kh&ocirc;ng g&acirc;y &ocirc; nhiễm m&ocirc;i trường.</p>\r\n\r\n<h2>L&agrave;m thế n&agrave;o để chọn loại&nbsp;Sơn nội thất&nbsp;kh&ocirc;ng ảnh hưởng tới sức khỏe v&agrave; &ocirc; nhiễm m&ocirc;i trường.</h2>\r\n\r\n<p>Trước khi mua, bạn n&ecirc;n t&igrave;m hiểu những thương hiệu Sơn nội thất&nbsp; lớn c&oacute; danh tiếng v&agrave; đảm bảo chất lượng tr&ecirc;n thị trường, v&agrave; quyết định lựa chọn c&aacute;c sản phẩm bạn cần. Tốt nhất l&agrave; n&ecirc;n chọn loại sơn gốc nước c&oacute; thể pha lo&atilde;ng bằng nước v&agrave; một số loại sơn th&acirc;n thiện với m&ocirc;i trường kh&ocirc;ng sử dụng c&ocirc;ng nghệ bổ sung.</p>\r\n\r\n<p>Mọi người n&ecirc;n hiểu c&aacute;c thuộc t&iacute;nh cơ bản, c&aacute;c th&agrave;nh phần ch&iacute;nh của sản phẩm sơn m&agrave; gia chủ định mua, v&agrave; y&ecirc;u cầu người b&aacute;n đưa ra c&aacute;c loại giấy chứng nhận loại sơn đ&oacute; l&agrave; th&acirc;n thiện với m&ocirc;i trường, kh&ocirc;ng ảnh hưởng tới sức khỏe của con người v&agrave; cần viết giấy đảm b&agrave;o về chất lượng của loại sơn đ&oacute;.</p>\r\n\r\n<p>Trong qu&aacute; tr&igrave;nh thi c&ocirc;ng, cần phải gi&aacute;m s&aacute;t nghi&ecirc;m ngặt qu&aacute; tr&igrave;nh sơn v&agrave; đảm bảo rằng tường được sơn theo đ&uacute;ng c&aacute;c th&ocirc;ng số kỹ thuật x&acirc;y dựng được ghi tr&ecirc;n th&ugrave;ng sơn, c&oacute; c&aacute;c y&ecirc;u cầu nghi&ecirc;m ngặt trong việc sử dụng dụng cụ khi sơn, nếu c&oacute; lỗi trong xử l&yacute; tường, lỗi trong việc pha lo&atilde;ng dung m&ocirc;i, thời gian sơn, thời gian sấy kh&ocirc; &hellip; th&igrave; cũng c&oacute; thể g&acirc;y nhiễm bẩn sơn.</p>', 'kientaoxanh.jpg', '2020-05-16', NULL, NULL),
(4, 'su-khac-biet-giua-son-noi-that-va-son-ngoai-that', 'Sự khác biệt giữa sơn nội thất và sơn ngoại thất', '&emsp;<p>Sơn c&oacute; rất nhiều loại v&agrave; mục đ&iacute;ch sử dụng kh&aacute;c nhau, sơn ngoại thất v&agrave; nội thất được sử dụng phổ biến hơn cả v&agrave; bản chất của ch&uacute;ng l&agrave; ho&agrave;n to&agrave;n kh&aacute;c.</p>\r\n\r\n<p>Để ho&agrave;n thiện c&ocirc;ng tr&igrave;nh kh&ocirc;ng thể thiếu giai đoạn thi c&ocirc;ng sơn tường, kh&ocirc;ng những gi&uacute;p căn nh&agrave; trở n&ecirc;n đẹp hơn m&agrave; c&ograve;n gi&uacute;p bảo vệ tốt hơn căn hộ của bạn. Tuy nhi&ecirc;n, để lựa chọn được mẫu sơn ưng &yacute; v&agrave; ph&ugrave; hợp bạn cần t&igrave;m hiểu kĩ lưỡng v&agrave; xem x&eacute;t cẩn thận. Với từng điều kiện sử dụng&nbsp;sơn nội thất, sơn ngoại thất để ph&aacute;t huy tối đa c&ocirc;ng dụng, mang lại cho c&ocirc;ng tr&igrave;nh hiệu quả nhất.</p>\r\n\r\n<p><strong>Đặc điểm của từng loại sơn</strong></p>\r\n\r\n<p><strong>Sơn Nội thất</strong></p>\r\n\r\n<p>Sơn nội thất được sử dụng cho b&ecirc;n trong nh&agrave;. V&igrave; ứng dụng l&agrave; sơn ở trong nh&agrave; n&ecirc;n th&agrave;nh phần, c&ocirc;ng đoạn sản xuất hoặc qu&aacute; tr&igrave;nh sơn cũng ho&agrave;n to&agrave;n kh&aacute;c.</p>\r\n\r\n<p>Th&ocirc;ng thường&nbsp;c&aacute;c loại sơn nh&agrave;&nbsp;n&agrave;y &iacute;t c&oacute; khả năng chống r&ecirc;u mốc m&agrave; thi&ecirc;n về yếu tố thẩm mỹ nhiều hơn v&igrave; đặc t&iacute;nh sơn trong nh&agrave; n&ecirc;n kh&ocirc;ng chịu t&aacute;c động của m&ocirc;i trường.</p>\r\n\r\n<p><img alt=\"su-khac-nhau-giua-son-noi-that-va-son-ngoai-that\" src=\"http://nipponmienbac.com/wp-content/uploads/2019/08/su-khac-nhau-giua-son-noi-that-va-son-ngoai-that-300x165.png\" style=\"height:165px; width:300px\" /></p>\r\n\r\n<p>Bởi vậy nếu d&ugrave;ng sơn nội thất cho ph&iacute;a tường ngo&agrave;i sẽ dẫn đến c&aacute;c hiện tượng như m&agrave;ng sơn bị phấn h&oacute;a, bị r&ecirc;u mốc, phai m&agrave;u, tr&oacute;c sơn do nhiệt độ cao. Kh&ocirc;ng chỉ vậy, nếu d&ugrave;ng kh&ocirc;ng đ&uacute;ng loại sơn sẽ dẫn đến tốn k&eacute;m, chất lượng kh&ocirc;ng cao, kh&ocirc;ng c&oacute; t&iacute;nh thẩm mỹ v&agrave; bền bỉ.</p>\r\n\r\n<p><strong>Sơn ngoại thất</strong></p>\r\n\r\n<p>Sơn ngoại thất&nbsp;l&agrave; loại sơn sử dụng cho b&ecirc;n ngo&agrave;i c&ocirc;ng tr&igrave;nh. Loại sơn n&agrave;y c&oacute; khả năng chống r&ecirc;u mốc, chịu t&aacute;c động của m&ocirc;i trường, như một lớp &aacute;o cho&agrave;ng mang đến khả năng chống chọi với những t&aacute;c động xấu từ m&ocirc;i trường.</p>\r\n\r\n<p>Những loại&nbsp;sơn nước ngo&agrave;i trời&nbsp;n&agrave;y c&oacute; khả năng chống r&ecirc;u mốc rất tốt, chịu được t&aacute;c dụng của m&ocirc;i trường như bụi, nắng, mưa&hellip; V&igrave; vậy gi&aacute; th&agrave;nh của&nbsp;sơn chống thấm ngo&agrave;i trời&nbsp;c&oacute; nhiều loại cũng cao hơn nội thất.</p>\r\n\r\n<p><img alt=\"son-noi-that\" src=\"http://nipponmienbac.com/wp-content/uploads/2019/08/son-noi-that-300x225.jpg\" style=\"height:225px; width:300px\" /></p>\r\n\r\n<p>Sơn ngoại thất được d&ugrave;ng để bảo vệ c&ocirc;ng tr&igrave;nh của bạn từ b&ecirc;n ngo&agrave;i, c&oacute; khả năng chịu đựng được nhiều t&aacute;c động từ b&ecirc;n ngo&agrave;i của thời tiết như:</p>\r\n\r\n<p>+ Chống thấm nước hiệu quả, cho c&ocirc;ng tr&igrave;nh của bạn được bền l&acirc;u.</p>\r\n\r\n<p>+ Chống r&ecirc;u mốc, vi khuẩn tấn c&ocirc;ng, gi&uacute;p c&ocirc;ng tr&igrave;nh của bạn lu&ocirc;n sạch đẹp như mới.</p>\r\n\r\n<p>+ Chống lại t&aacute;c động của nhiệt độ cao để c&ocirc;ng tr&igrave;nh kh&ocirc;ng bị bong tr&oacute;c.</p>\r\n\r\n<p>Để ph&acirc;n biệt được sơn ngoại thất v&agrave; sơn nội thất, c&oacute; một c&aacute;ch kh&aacute; đơn giản dựa tr&ecirc;n mắt thường để lựa chọn sản phẩm. Tr&ecirc;n bao b&igrave; c&aacute;c loại sơn đều ghi r&otilde; đ&oacute; l&agrave; sơn ngoại thất hay nội thất. Bạn cần để &yacute; kỹ bao b&igrave; để tr&aacute;nh sai s&oacute;t trong việc chọn sơn.</p>', 'greenngoaithat.jpg', '2020-05-21', '2020-05-20 18:55:13', '2020-05-20 18:55:13');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
