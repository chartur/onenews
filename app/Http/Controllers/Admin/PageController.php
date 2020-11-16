<?php
/**
 * Created by PhpStorm.
 * User: arturchilingaryan
 * Date: 11/15/20
 * Time: 15:13
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Seo;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Return about us page content data
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getAboutPage()
    {
        $activePage = 'seo_about';
        $page = Page::where('slug','about')
            ->first();

        $seo = Seo::where('slug', 'about')
            ->first();

        return view('admin.seo.about')->with(compact('activePage', 'page', 'seo'));
    }

    /**
     * Return about us page content data
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getContactUsPage()
    {
        $activePage = 'seo_contact';
        $page = Page::where('slug','contact')
            ->first();

        $seo = Seo::where('slug', 'contact')
            ->first();

        return view('admin.seo.contact')->with(compact('activePage', 'page', 'seo'));
    }

    /**
     * Return about us page content data
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getMainPage()
    {
        $activePage = 'seo_main';
        $page = Page::where('slug','main')
            ->first();

        $seo = Seo::where('slug', 'main')
            ->first();

        return view('admin.seo.main')->with(compact('activePage', 'page', 'seo'));
    }

    public function savePageData(Request $request)
    {
        $request->validate([
            'hy_title' => 'required',
            'ru_title' => 'required',
        ]);

        $page = new Page();
        if($request->has('page')) {
            $page = Page::where('slug', $request->page)
                ->first();

            if(!$page){
                $page = new Page();
            }
        }

        if($request->has('hy_content')){
            $page->hy_content = trim($request->hy_content);
        }
        if($request->has('ru_content')) {
            $page->ru_content = trim($request->ru_content);
        }
        if($request->has('page')) {
            $page->slug = $request->page;
        }
        if($request->has('image')) {
            $page->image = str_replace(url(''),'',$request->image);
        }

        $page->saveOrFail();

        $seo = Seo::where('slug', $page->slug)
            ->first();
        if(!$seo) {
            $seo = new Seo();
        }

        $seo->hy_title = trim($request->hy_title);
        $seo->ru_title = trim($request->ru_title);
        if($request->has('page')) {
            $seo->slug = $request->page;
        }

        $seo->hy_keywords = trim($request->metas['hy_keywords']);
        $seo->ru_keywords = trim($request->metas['ru_keywords']);
        $seo->hy_description = trim($request->metas['hy_description']);
        $seo->ru_description = trim($request->metas['ru_description']);

        $seo->saveOrFail();

        return response()->json(['status' => 'success', 'message' => 'Էջի տվյալները հաջողությամբ պահպանվել է։']);
    }
}