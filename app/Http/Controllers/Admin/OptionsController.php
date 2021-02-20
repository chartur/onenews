<?php


namespace App\Http\Controllers\Admin;


use App\Models\Option;

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
}
