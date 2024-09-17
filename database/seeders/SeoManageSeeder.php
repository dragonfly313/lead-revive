<?php

namespace Database\Seeders;

use App\Models\SeoManage;
use Illuminate\Database\Seeder;

class SeoManageSeeder extends Seeder
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
                'page' => 'home',
                'title' => 'leadreviver | home',
                'description' => 'leadreviver home',
                'keywords' => 'leadreviver home',
            ],
            [
                'page' => 'profile',
                'title' => 'leadreviver | profile',
                'description' => 'leadreviver profile',
                'keywords' => 'leadreviver profile',
            ],
        ];

        SeoManage::insert($defaultData);
    }
}
