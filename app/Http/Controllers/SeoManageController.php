<?php

namespace App\Http\Controllers;

use App\Models\SeoManage;
use Illuminate\Http\Request;

class SeoManageController extends Controller
{
    public function index()
    {
        return view('websites.seo', ['seo' => SeoManage::get()]);
    }
    
    public function update(Request $request)
    {
        SeoManage::where('page', $request->page)->update($request->seo);
        return ['result' => 'success'];
    }
}
