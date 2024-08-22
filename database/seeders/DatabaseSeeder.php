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

        /*
        //Add levels
        for($i=1; $i<=12; $i++){
            $exists = DB::table("level")->where("level",$i)->exists();
            if($exists != 1){
                DB::table("level")->insert([
                    'level' => $i,
                    'price' => rand(20000, 150000),
                    'created_at' => now()
                ]);
            }
        }

        //Add Tutors
        $data =  [
            "lname" => "Ssewankambo",
            "fname" => "Martin",
            "is_tutor" => 1,
            "is_active" => 1,
            "email_verified" => 1,
            "email" => "arnoldhenry958@gmail.com",
            "password" => Hash::make("123"),
            "created_at" => now()
        ];

        DB::table("users")->insert($data);

        $levels = DB::table("level")->get();

        foreach($levels as $level){
            DB::table("courses")->insert([
                'title' => "Course $level->level",
                'level' => $level->level,
                'tutor' => 2,
                'description' => "This is a Course About Level $level->level"
            ]);
        }
        */

        DB::table("enrollment")->where([
            'course_id' => 1,
            'student_id' => 7
        ])->update([
            'pay_code' => Str::random(30)
        ]);
    }
}
