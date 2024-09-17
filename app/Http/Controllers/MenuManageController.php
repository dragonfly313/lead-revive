<?php

namespace App\Http\Controllers;

use App\Models\MenuManage;
use Illuminate\Http\Request;

class MenuManageController extends Controller
{
    public function index()
    {
        return view('websites.menu', ['menu' => MenuManage::get()]);
    }
    
    public function add(Request $request)
    {
        MenuManage::insert($request->data);
        return ['result' => 'success'];
    }
    
    public function update(Request $request, $id)
    {
        MenuManage::where('id', $id)->update($request->data);
        return ['result' => 'success'];
    }
    
    public function remove($id)
    {
        MenuManage::where('id', $id)->delete();
        return ['result' => 'success'];
    }
}
