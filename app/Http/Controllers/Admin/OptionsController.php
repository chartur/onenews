<?php


namespace App\Http\Controllers\Admin;


use App\Models\Option;
use Illuminate\Http\Request;

class OptionsController
{
    public function toggleOptionsTemplate() {
        $options = Option::get();
        return view('admin.includes.options-controls')->with(compact('options'));
    }

    public function toggleOptionById(Option $option) {
        $option->value = (int) $option->value ? 0 : 1;
        $option->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Փոփոխությունը հաջողությամբ կատարված է' ,
        ]);
    }

    public function loadContentCreator(Option $option) {
        return view('admin.includes.option-content')->with(compact('option'));
    }

    public function storeContent(Option $option, Request $request) {
        $request->validate([
            'content' => 'required',
        ]);

        $option->content = trim($request->content);
        $option->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Փոփոխությունը հաջողությամբ կատարված է' ,
        ]);
    }
}
