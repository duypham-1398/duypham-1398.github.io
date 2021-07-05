<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(UserTableSeeder::class);
        // $this->call(LoainguoidungTableSeeder::class);
        $this->call(NhanvienTableSeeder::class);
        // $this->call(TinhtranghoadonTableSeeder::class);
    }
}
Class TinhtranghoadonTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('tinhtranghd')->insert([ 
            ['tinhtranghd_ten'=>'Chưa xác nhận','tinhtranghd_mo_ta'=>'Đơn hàng chưa được xác nhận'],
            ['tinhtranghd_ten'=>'Đã xác nhận','tinhtranghd_mo_ta'=>'Đơn hàng đã được xác nhận'],
            ['tinhtranghd_ten'=>'Đã hủy','tinhtranghd_mo_ta'=>'Đơn hàng đã hủy'],
            ['tinhtranghd_ten'=>'Giao hàng','tinhtranghd_mo_ta'=>'Đơn hàng đã được giao'],
        ]);
    }
}
Class NhanvienTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('nhanvien')->insert([ 
            ['nhanvien_ten'=>'Nguyễn Thị Mai','nhanvien_cmnd'=>'123456789','nhanvien_dia_chi'=>'Hải Dương','nhanvien_ngay_vao_lam'=>'2020-04-19','user_id'=>'3'],
        ]);
    }
}
