<?php

namespace Laraflat\Laraflat\Laraflat\Seeders;

use Illuminate\Database\Seeder;
use Laraflat\Laraflat\Laraflat\Models\Menu;
use Laraflat\Laraflat\Laraflat\Models\MenuItem;

class ItemsSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Menu::create(['name' => 'admin']);

        $items = [
            [
                'id' => 1,
                'name_ar' => 'القوائم',
                'name_en' => 'Menus',
                'slug' => 'menus',
                'order' => 0,
                'menu_id' => 1,
                'parent_id' => 0,
                'icon' => '<i class="fa fa-server"></i>',
                'link' => '/admin/menu'
            ],
            [
                'id' => 2,
                'name_ar' => 'المديولات',
                'name_en' => 'Modules',
                'slug' => 'generator',
                'order' => 0,
                'menu_id' => 1,
                'parent_id' => 0,
                'icon' => '<i class="fa fa-dashboard"></i>',
                'link' => '#'
            ],
            [
                'id' => 3,
                'name_ar' => 'انشاء المديولات',
                'name_en' => 'Add Module',
                'slug' => 'add-module',
                'order' => 0,
                'menu_id' => 1,
                'parent_id' => 2,
                'icon' => '',
                'link' => '/admin/generator/module/step-one'
            ],
            [
                'id' => 4,
                'name_ar' => 'التحكم في المدويلات',
                'name_en' => 'Module Control',
                'slug' => 'module-control',
                'order' => 1,
                'menu_id' => 1,
                'parent_id' => 2,
                'icon' => '',
                'link' => '/admin/generator/modules'
            ],
        ];


        MenuItem::insert($items);


    }
}
