<?php
/**
 * Created by PhpStorm.
 * User: arturchilingaryan
 * Date: 11/6/20
 * Time: 22:32
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Place;
use App\Models\Widget;

class AdminController extends Controller
{
    /**
     * Admin Dashboard
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $activePage = 'index';
        return view('admin.index')->with(compact('activePage'));
    }

    /**
     * Returns page where we can build general page structure
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function buildMainPage()
    {

        $activePage = 'build';
        $widgets = Widget::get();
        $cats = Category::get();
        $activeWidgets = Place::with('widget')
                            ->orderBy('ordering', 'asc')
                            ->get();
        return view('admin.build-main-page')
            ->with(compact('activePage', 'cats', 'widgets', 'activeWidgets'));
    }

}