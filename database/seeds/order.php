<?php

use Illuminate\Database\Seeder;

class order extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order')->delete();
        DB::table('order')->insert([
            ['id'=>1,'full'=>'Nguyễn Văn Đạt','address'=>'Bắc Cạn','email'=>'vandat@gmail.com','phone'=>'01627327308','total'=>110000,'state'=>1],
            ['id'=>2,'full'=>'Nguyễn tùng Lâm','address'=>'Hải Dương','email'=>'tunglam@gmail.com','phone'=>'01627457308','total'=>110000,'state'=>1],
            ['id'=>3,'full'=>'Võ Văn Minh','address'=>'Ninh Bình','email'=>'vanminh@gmail.com','phone'=>'01627798308','total'=>110000,'state'=>2],
            ['id'=>4,'full'=>'Nguyễn Thế Kiên','address'=>'Hà Nội','email'=>'thekien@gmail.com','phone'=>'01627327311','total'=>110000,'state'=>2],
            ['id'=>5,'full'=>'Trần Đại Thụ','address'=>'Nam Định','email'=>'daithu@gmail.com','phone'=>'01627327309','total'=>110000,'state'=>2],
        ]);
    }
}
