<?php
/**
 * Created by PhpStorm.
 * User: arturchilingaryan
 * Date: 11/7/20
 * Time: 02:03
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Place;
use Illuminate\Http\Request;
use Mockery\Exception;

class WidgetController extends Controller
{
    public function getAllWidgets()
    {
        $widgets = PostStyles::get();
    }

    public function saveMainPageStructure(Request $request)
    {
        try {
            $reqs = $request->except('_token');
            $data = [];
            foreach ($reqs as $index => $req) {
                $data[$index] = [
                    'data' => []
                ];
                foreach ($req as $item) {
                    $key = $item['name'];
                    $value = $item['value'];
                    if($key == 'widget_id' || $key == 'place') {
                        $data[$index][$key] = $value;
                    } else {
                        $data[$index]['data'][$key] = $value;
                    }
                }
                $data[$index]['ordering'] = $index + 1;
                $data[$index]['data'] = json_encode($data[$index]['data']);
            }

            Place::query()->truncate();
            Place::insert($data);

            return response()->json(['status' => 'success', 'message' => 'Էջը հաջողությամբ փոփոխված է։']);
        } catch (Exception $exception) {
            return response()->json(['status' => 'danger', 'message' => 'Խնդրում ենք փորձել կրկին։'], 500);
        }

    }
}