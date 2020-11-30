<?php
/**
 * Created by PhpStorm.
 * User: arturchilingaryan
 * Date: 11/30/20
 * Time: 19:31
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Adsense;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    public function index()
    {
        $activePage = 'ads';
        $ads = Adsense::get();
        return view('admin.ads')->with(compact('activePage', 'ads'));
    }

    public function store(Request $request)
    {
        $reqs = $request->except('_token');

        $ads = [];
        $count = count($reqs['name']);

        for($i = 0; $i < $count; $i++) {
            $ads[] = [
                'name' => $reqs['name'][$i],
                'slug' => $reqs['slug'][$i],
                'content' => $reqs['content'][$i],
            ];
        }

        Adsense::query()->truncate();
        Adsense::insert($ads);
        return redirect()->back()->with('success', 'Գովազդները հաջողությամբ պահպանված է');
    }

    public function getAds()
    {
        $ads = Adsense::get();
        return response()->json(['ads' => $ads]);
    }
}