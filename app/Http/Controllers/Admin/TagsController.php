<?php
/**
 * Created by PhpStorm.
 * User: arturchilingaryan
 * Date: 11/13/20
 * Time: 01:46
 */

namespace App\Http\Controllers\Admin;


use App\Models\Tag;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TagsController
{
    /**
     * Add new tag
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function addNewTag(Request $request)
    {
        $request->validate([
            'hy_name' => 'required',
            'ru_name' => 'required',
        ]);

        $tag = new Tag();
        $tag->hy_name = $request->hy_name;
        $tag->ru_name = $request->ru_name;
        $tag->saveOrFail();

        return response()->json(['status' => 'success', 'message' => 'Թեգը հաջողությամբ ավելացվել է։', 'tag' => $tag]);
    }


    public function saveTagData(Request $request)
    {
        $request->validate([
            'hy_name' => 'required',
            'ru_name' => 'required',
        ]);

        $tag = new Tag();

        if($request->has('tag_id') && $request->tag_id) {
            $tag = Tag::find($request->tag_id);
        }

        if(!$tag) {
            $tag = new Tag();
        }
        $tag->hy_name = $request->hy_name;
        $tag->ru_name = $request->ru_name;
        $tag->saveOrFail();

        return response()->json(['status' => 'success', 'message' => 'Թեգը հաջողությամբ ավելացվել է։', 'tag' => $tag]);
    }

    /**
     * Returns post update template
     *
     * @param Request $request
     * @param Tag $tag
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function updateTagView(Request $request, Tag $tag)
    {
        if ($request->ajax()) {
            $tags = Tag::withCount('posts')
                ->where('id', '<>', $tag->id);

            return Datatables::of($tags)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<input type="radio" class="form-control" name="replace-post-tag" value="'. $row->id .'">';

                    return $btn;
                })
                ->addColumn('date', function($row) {
                    return $row->created_at->diffForHumans();
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $activePage = 'tag';
        $tag->loadCount('posts');
        return view('admin.edit-tag')->with(compact('tag', 'activePage'));
    }

    /**
     * Returns all posts
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function lists(Request $request)
    {
        dd(ini_get('post_max_size'));
        if ($request->ajax()) {
            $tags = Tag::withCount('posts');

            return Datatables::of($tags)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<a href="/cabinet/tags/update/'. $row->id .'" class="edit btn btn-warning btn-sm mr-2">
                                <i class="fa fa-edit"></i>
                            </a>';

                    return $btn;
                })
                ->addColumn('date', function($row) {
                    return $row->created_at->diffForHumans();
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $activePage = 'all_tags';

        return view('admin.tags-list')->with(compact('activePage'));
    }

    /**
     * Delete tag
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteTag(Request $request)
    {
        $request->validate([
            'tag_id' => 'required'
        ]);

        $tag = Tag::find($request->tag_id);
        if(!$tag) {
            return response()->json(['status' => 'danger', 'message' => 'Թեգը չի գտնվել'], 404);
        }

        if($request->replace) {
            $tag->posts()->update(['tag_id' => $request->replace]);
        }else {
            $tag->posts()->detach();
        }

        $status = $tag->delete();

        if($status) {
            return response()->json(['status' => 'success', 'Թեգը հաջողությամբ ջնջված է']);
        }
        return response()->json(['status' => 'danger', 'Խնդրում ենք կրկին փորձել']);
    }

    public function adminTagSearch(Request $request)
    {
        $tags = Tag::where('hy_name', 'like', '%'.$request->q.'%')
            ->get();

        return view('admin.includes.tag-search-result')->with(compact('tags'));
    }
}