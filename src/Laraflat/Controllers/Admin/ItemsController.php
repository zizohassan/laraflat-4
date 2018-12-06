<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 6/5/18
 * Time: 2:37 AM
 */

namespace Laraflat\Laraflat\Laraflat\Controllers\Admin;

use Laraflat\Laraflat\Laraflat\Models\MenuItem;
use Laraflat\Laraflat\Laraflat\Requests\ItemsRequest;


class ItemsController
{

    public function store(ItemsRequest $request, MenuItem $item)
    {

        $item->create($request->all());

        return redirect()->back();
    }

    public function destroy($id, MenuItem $item)
    {

        $item->findOrFail($id)->delete();

        return redirect()->back();
    }

    public function update($id  , ItemsRequest $request, MenuItem $item){

        $item->findOrFail($id)->update($request->all());

        return redirect()->back();
    }


}