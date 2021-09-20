<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\User::create([
            'name' => 'User',
            'email' => 'email@mail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12341234'), // password
            'remember_token' => Str::random(10),
        ]);
        \App\Models\Plan::create(['name' => 'First', 'price' => 500, 'stripe_plan_id' => '', 'slug' => 'first']);
        \App\Models\Plan::create(['name' => 'Second', 'price' => 1500, 'stripe_plan_id' => '', 'slug' => 'second']);
        \App\Models\Plan::create(['name' => 'Third', 'price' => 3000, 'stripe_plan_id' => '', 'slug' => 'third']);
    }
}
