<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{

    public $password;

    public function __construct()
    {
        $this->password = config('settings.default.user.password');
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(array(
            array(
                'first_name' => 'Amir',
                'last_name' => "Zare",
                'mobile' => '09131234567',
                'user_name' => '5240',
                'personnel_code' => '5240',
                'password' => bcrypt($this->password),
            ),
            array(
                'first_name' => 'Ali',
                'last_name' => "kamali",
                'mobile' => '09193250000',
                'user_name' => '3276',
                'personnel_code' => '3276',
                'password' => bcrypt($this->password),
            ),
            array(
                'first_name' => 'Maryam',
                'last_name' => "Mehrnezhad",
                'mobile' => '09131234123',
                'user_name' => '1234',
                'personnel_code' => '1234',
                'password' => bcrypt($this->password),
            ),
            array(
                'first_name' => 'Arman',
                'last_name' => "Eghtedari",
                'mobile' => '09193251970',
                'user_name' => '4847',
                'personnel_code' => '4847',
                'password' => bcrypt($this->password),
            ),
            array(
                'first_name' => 'Alex',
                'last_name' => "Sanchez",
                'mobile' => '09193250012',
                'user_name' => '3232',
                'personnel_code' => '3232',
                'password' => bcrypt($this->password),
            ),
            array(
                'first_name' => 'Mohammad',
                'last_name' => "Mohammadi",
                'mobile' => '09193250082',
                'user_name' => '2525',
                'personnel_code' => '2525',
                'password' => bcrypt($this->password),
            ),
            array(
                'first_name' => 'Joe',
                'last_name' => "Ghafari",
                'mobile' => '09193250212',
                'user_name' => '5210',
                'personnel_code' => '5210',
                'password' => bcrypt($this->password),
            ),
            array(
                'first_name' => 'Mary',
                'last_name' => "Gharex",
                'mobile' => '09193250212',
                'user_name' => '4242',
                'personnel_code' => '4242',
                'password' => bcrypt($this->password),
            ),
            array(
                'first_name' => 'Abrahim',
                'last_name' => "Jafari",
                'mobile' => '09193250212',
                'user_name' => '3636',
                'personnel_code' => '3636',
                'password' => bcrypt($this->password),
            ),
            array(
                'first_name' => 'Sara',
                'last_name' => "Gholi Zadeh",
                'mobile' => '09193250212',
                'user_name' => '3290',
                'personnel_code' => '3290',
                'password' => bcrypt($this->password),
            )
            ));
    }
}
