<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Parsers\BlogNewsParser;
use App\Parsers\IravabanNetParser;
use App\Parsers\LragirParser;
use App\Parsers\NewsAmParser;
use App\Parsers\ShamshyanParser;

class FacebookController extends Controller
{
    public function index() {
//        $parser = new LragirParser('https://www.lragir.am/2021/09/11/667534/');
//        $parser = new NewsAmParser('https://news.am/arm/news/662305.html');
//        $parser = new BlogNewsParser('https://www.blognews.am/arm/news/772053/arcakhy-chenq-korcrel-korcrel-enq-arcakhi-mi-masy-ory-tshnamin-stacel-e-gortsarqi-u-nviratvutyan-hetevanqov.html');
//        $parser = new ShamshyanParser('https://shamshyan.com/hy/article/2021/09/11/1195832/');
        $parser = new IravabanNetParser('https://iravaban.net/349165.html');

        return response()->json($parser->getPostData());
    }
}
