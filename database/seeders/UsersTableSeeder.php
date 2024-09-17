<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('users')->delete();

        \DB::table('users')->insert(
            array(
                0 =>
                    array(
                        'id' => 1,
                        'name' => 'Super Admin',
                        'email' => 'admin@admin.com',
                        'email_verified_at' => '2024-04-02 20:42:47',
                        'password' => Hash::make('11111111'),
                        'two_factor_secret' => NULL,
                        'two_factor_recovery_codes' => NULL,
                        'remember_token' => '2blPLIUy3IK8nSPVnYPhVx0qAzmgG2HVlAeYlp2SmWQ7oE4XSNmYJEmGVauh',
                        'timezone' => 'America/New_York',
                        'current_team_id' => 2,
                        'profile_photo_path' => NULL,
                        'created_at' => '2024-04-02 23:56:45',
                        'updated_at' => '2024-04-02 11:49:12',
                        'last_login_at' => '2024-04-02',
                        'last_login_ip' => NULL,
                        'mobile' => '7862522284',
                        'mobile_verified' => 0,
                        'active' => 1,
                        'gender' => 'male',
                        'country' => NULL,
                        'city' => NULL,
                        'address' => NULL,
                        'zip' => NULL,
                        'locale' => 'en',
                    ),
                1 =>
                    array(
                        'id' => 4,
                        'name' => 'User test',
                        'email' => 'user@user.com',
                        'email_verified_at' => '2024-04-02 17:06:28',
                        'password' => Hash::make('11111111'),
                        'two_factor_secret' => NULL,
                        'two_factor_recovery_codes' => NULL,
                        'remember_token' => NULL,
                        'timezone' => 'America/New_York',
                        'current_team_id' => 4,
                        'profile_photo_path' => NULL,
                        'created_at' => '2024-04-02 17:03:35',
                        'updated_at' => '2024-04-01 16:25:18',
                        'last_login_at' => '2024-04-02',
                        'last_login_ip' => NULL,
                        'mobile' => NULL,
                        'mobile_verified' => 0,
                        'active' => 1,
                        'gender' => NULL,
                        'country' => NULL,
                        'city' => NULL,
                        'address' => NULL,
                        'zip' => NULL,
                        'locale' => 'en',
                    ),
            )
        );

    }
}