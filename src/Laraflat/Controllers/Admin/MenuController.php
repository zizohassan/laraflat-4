<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 6/5/18
 * Time: 2:37 AM
 */

namespace Laraflat\Laraflat\Laraflat\Controllers\Admin;


use Laraflat\Laraflat\Laraflat\Models\Menu;
use Laraflat\Laraflat\Laraflat\Models\MenuItem;
use Laraflat\Laraflat\Laraflat\Models\Module;
use Laraflat\Laraflat\Laraflat\Requests\MenuRequest;

class MenuController
{
    public function index(){

        $menus = Menu::get();

        return view('laraflat::admin.menu.index' , compact('menus'));
    }

    public function store(MenuRequest $request , Menu $menu){

        $menu->create($request->all());

        return redirect()->back();
    }

    public function delete($id , Menu $menu){

        if($id == 1){
            return redirect()->back();
        }
        $menu->findOrFail($id)->delete();

        return redirect()->back();
    }

    public function build($id  , Menu $menu){

        $menu = $menu->with(['items' => function($query){

            return $query->orderBy('order');

        }])->findOrFail($id);

        $parents = MenuItem::where('parent_id' , 0)->where('menu_id' , $menu->id)->pluck('name_'.l() , 'id')->toArray();

        return view('laraflat::admin.menu.build' , compact('menu' , 'parents'));
    }
}