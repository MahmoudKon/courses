<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name'      => 'super admin',
            'email'     => 'super_admin@app.com',
            'address'   => 'Sintmay, Mit Ghamer, Al Dakahlia, Egypt',
            'phone'     => '01156455369',
            'password'  => bcrypt('123'),
            'birthday'  => '24/8/1995',
            'gender'    => 'Male',
            'status'    => 'Single',
            'role'      => 'super_admin',
            'image'     => 'admin.jpg',
        ]);

        $user->attachRole('super_admin');

        factory(User::class, 25)->create();

    }//end of run

}//end of seeder
