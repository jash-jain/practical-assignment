<?php

use Carbon\Carbon;
use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = "Admin";
        $user->email = 'admin@admin.com';
        $user->email_verified_at = Carbon::now();
        $user->password = bcrypt('password');
        $user->save();
    }
}
