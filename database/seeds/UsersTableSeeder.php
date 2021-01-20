<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Str;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user1=new User();
        $user1->name='Doe';
        $user1->email='john@gwdental.com';
        $user1->password=bcrypt('superadmin');
        $user1->api_token=Str::random(80);
        $user1->remember_token=Str::random(10);
        $user1->is_admin=1;
        $user1->save();
    }
}
