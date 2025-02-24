<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        
        // //Add levels
        // for($i=1; $i<=12; $i++){
        //     $exists = DB::table("level")->where("level",$i)->exists();
        //     if($exists != 1){
        //         DB::table("level")->insert([
        //             'level' => $i,
        //             'price' => rand(20000, 150000),
        //             'created_at' => now()
        //         ]);
        //     }
        // }

        // //Add Tutors
        // $data =  [
        //     "lname" => "Ssewankambo",
        //     "fname" => "Martin",
        //     "gender" => "male",
        //     "is_tutor" => 1,
        //     "is_active" => 1,
        //     "email_verified" => 1,
        //     "email" => "arnoldhenry958@gmail.com",
        //     "password" => Hash::make("123"),
        //     "created_at" => now()
        // ];

        // DB::table("users")->insert($data);

        // $levels = DB::table("level")->get();

        // foreach($levels as $level){
        //     DB::table("courses")->insert([
        //         'title' => "Course $level->level",
        //         'level' => $level->level,
        //         'tutor' => 2,
        //         'description' => "This is a Course About Level $level->level"
        //     ]);
        // }

        for($i = 0; $i < 100; $i++){
            DB::table("messages")->insert([
                "from" => $faker->email,
                "to" => "arnoldhenry958@gmail.com",
                "message" => $faker->realText(300),
                "created_at" => now()
            ]);
        }
    }
}
