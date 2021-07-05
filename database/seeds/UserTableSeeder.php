<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([ 
            ['name'=>'Ngọc Mai','email'=>'nguyenmai198.hust@gmail.com','password'=>bcrypt('123456'),'loainguoidung_id'=>'1'],
            ['name'=>'Nguyễn Thị Mai','email'=>'nguyenmai9595@gmail.com','password'=>bcrypt('123456'),'loainguoidung_id'=>'3'],
        ]);
    }
}
