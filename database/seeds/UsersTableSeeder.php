<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;//To hash password

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
        $user = User::where('email', 'quantumcoma@gmail.com')->first();
if(!$user){
  User::create([
  'name'=>'Samba Traore',
  'email'=>'quantumcoma@gmail.com',
  'role'=>'admin',
  'password'=> Hash::make('123')

  ]);
}

    }
}
