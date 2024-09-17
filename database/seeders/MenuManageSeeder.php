<?php

namespace Database\Seeders;

use App\Models\MenuManage;
use Illuminate\Database\Seeder;

class MenuManageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
        $defaultData = [
            [
                'text' => 'HOME',
                'link' => '#home',
            ],
            [
                'text' => 'ABOUT US',
                'link' => '#aboutUs',
            ],
            [
                'text' => 'CONTACT US',
                'link' => '#contactUs',
            ],
            [
                'text' => 'REVIEWS',
                'link' => '#reviews',
            ],
            [
                'text' => 'PRICING',
                'link' => '#pricing',
            ],
        ];

        MenuManage::insert($defaultData);
    }
}
