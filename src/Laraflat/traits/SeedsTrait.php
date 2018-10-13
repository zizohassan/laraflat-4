<?php

namespace Laraflat\Laraflat\Laraflat\Traits;

use Laraflat\Laraflat\Laraflat\Models\Menu;
use Laraflat\Laraflat\Laraflat\Models\MenuItem;

trait SeedsTrait
{

    public function adminMenu()
    {
        Menu::create(['name' => 'admin']);
    }

    public function menuItems()
    {

        $items = [
            [
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

        foreach ($items as $item) {
            MenuItem::create($item);
        }

    }

}