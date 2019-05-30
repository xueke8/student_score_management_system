<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('zh_CN');

        foreach (range(0, 160) as $item) {
            $data = [
                'class_id' => $faker->numberBetween(1, 4),
                'password' => bcrypt('123456'),
                'sex' => $faker->boolean ? '男' : '女',
                'name' => $faker->name,
                'phone' => $faker->phoneNumber,
                'id_number' => $faker->numerify('##################'),
                'address' => $faker->address,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            DB::table('students')->insert($data);
        }

//        foreach (range(0, 20) as $i) {
//            $data = [
//                'username' => $username = $faker->numberBetween(10000000, 99999999),
//                'password' => bcrypt('123456'),
//                'name' => $name = $faker->name,
//                'identity' => 'student',
//                'created_at' => date('Y-m-d H:i:s'),
//                'updated_at' => date('Y-m-d H:i:s'),
//            ];
//
//            $id = DB::table('admin_users')->insertGetId($data);
//
//            $data = [
//                'user_id' => $id,
//                'stu_id' => $username,
//                'class_id' => 1,
//                'name' => $name,
//                'sex' => $faker->boolean ? '男' : '女',
//                'phone' => $faker->phoneNumber,
//                'id_number' => $faker->creditCardNumber,
//                'address' => $faker->address,
//                'created_at' => date('Y-m-d H:i:s'),
//                'updated_at' => date('Y-m-d H:i:s'),
//            ];
//
//            DB::table('students')->insert($data);
//        }


    }
}
