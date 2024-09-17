<?php

namespace App\Http\Controllers;

use App\Models\MenuManage;
use App\Models\PageManage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageManageController extends Controller
{
    public function index()
    {
        return view('websites.compose', ['settings' => PageManage::get(), 'menu' => MenuManage::get()]);
    }
    
    public function upsert(Request $request)
    {
        PageManage::upsert($request->upsert_data, ['key'], ['value']);
        return ['result' => 'success'];
    }

    public function upload(Request $request)
    {
        if (Storage::exists('back_imgs/'.$request->file('file')->getClientOriginalName())) {
            echo 'exist';
            Storage::delete('back_imgs/'.$request->file('file')->getClientOriginalName());
        }
        $path = $request->file('file')->storeAs('back_imgs', $request->file('file')->getClientOriginalName());
        if ($path) {
            return response()->json(['path' => $path]);
        } else {
            return response()->json(['path' => $path], 500);
        }
    }
}
