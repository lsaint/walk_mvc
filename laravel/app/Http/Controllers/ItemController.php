<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Item;
use Log;
use EasyWeChat\Foundation\Application;

class ItemController extends Controller
{

    public function index() {
        $options = [
            'debug'  => true,
            'app_id' => 'wx0572e52dc3d9139a',
            'secret' => 'a9ca60ddeba44a9117a762ed173ac2ef',
            'log' => [
                'level' => 'debug',
                'file'  => '/Users/lsaint/php/panniversary/storage/logs/wechat.log'],
        ];
        $app = new Application($options);
        $js = $app->js;

        return view('index', ['js' => $js]);
    } 


    public function pullitems($major_type) 
    {
        $items = Item::where('major_type', $major_type)
                     ->where('active', true)
                     ->get();
        $jn = [];
        foreach ($items as $item) {
            if (!isset($jn[$item->minor_type])) {
                $jn[$item->minor_type] = [];
            }
            $jn[$item->minor_type][] = [$item->id, 
                $item->name, $item->brand, $item->photo,
                $item->original_price, $item->discount_price,
                $item->original_points, $item->discount_points];
        }
        //return json_encode($jn);
        return response()->json($jn);
    }

    public function click(Request $request, $id) 
    {
        $item = Item::findOrFail($id);
        if ($item->active) {
            $item->hits += 1;
            $item->save();
            $url = $item->url;
            $exception = array_merge(range(95, 104), range(123, 132));
            error_log(json_encode($request->query()));
            if ($request->query("m") && in_array($id, $exception))  {
                $url = str_replace("www", "m", $url); 
            }
            return redirect($url);
        }
    }
    
}
