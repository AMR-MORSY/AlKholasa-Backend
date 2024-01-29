<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $super_admin=[
            "first_name"=>"amr",
            "last_name"=>"morsy",
            "middle_name"=>"mahmoud",
            "mobile"=>"01224484223",
            "user_name"=>"ammorsy",
            "email"=>"morsy.mamr@gmail.com",
            "password"=>Hash::make("@Mobinil2023"),
            'remember_token' => Str::random(10),

        ];
        $normal_user=[
            "first_name"=>"heba",
            "last_name"=>"kawkab",
            "middle_name"=>"abdelwahab",
            "mobile"=>"012711111568",
            "user_name"=>"hkawkab",
            "email"=>"heba.kawkab@gmail.com",
            "password"=>Hash::make("@Mobinil2023"),
            'remember_token' => Str::random(10),


        ];
        $users=["admin"=>$super_admin,"normal_user"=>$normal_user];
        foreach($users as $key=>$value)
        {
            $user=User::create(
                $value
            );

        }
      
    }
}
