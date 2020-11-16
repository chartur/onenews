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
}