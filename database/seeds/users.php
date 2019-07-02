<?php

use Illuminate\Database\Seeder;
use Faker\factory as Faker;
class users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
       $faker=faker::create('vi_VN'); //Tạo đối tượng thuộc thư viện Faker
        for($i=1;$i<=50;$i++){
            DB::table('users')->insert(
            ['email'=>$faker->email,//
            'password'=>bcrypt('123456'),
            'full'=>$faker->name,
            'address'=>$faker->streetAddress,
            'phone'=>$faker->e164PhoneNumber,
            'level'=>rand(1,4)
        ]);
            
        }
    }
}  
