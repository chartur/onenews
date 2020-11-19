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
     * @param Tag $tag
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function updateTagView(Tag $tag)
    {
        $activePage = 'tag';
        $tag->loadCount('posts');
        return view('admin.edit-tag')->with(compact('tag', 'activePage'));
    }

    /**
     * Returns all posts
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function lists()
    {
        $activePage = 'all_tags';
        $tags = Tag::withCount('posts')
            ->orderByDesc('id')
            ->paginate(20);


        return view('admin.tags-list')->with(compact('activePage', 'tags'));
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

        $tag->posts()->detach();

        $status = $tag->delete();

        if($status) {
            return response()->json(['status' => 'success', 'Թեգը հաջողությամբ ջնջված է']);
        }
        return response()->json(['status' => 'danger', 'Խնդրում ենք կրկին փորձել']);
    }
}