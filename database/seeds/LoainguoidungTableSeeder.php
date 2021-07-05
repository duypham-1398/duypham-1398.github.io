<?php

use Illuminate\Database\Seeder;

class LoainguoidungTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('loainguoidung')->insert([
            ['loainguoidung_ten'=>'Admin'], 
            ['loainguoidung_ten'=>'User'],
            ['loainguoidung_ten'=>'Nhanvien'],
        ]);
    }
}
