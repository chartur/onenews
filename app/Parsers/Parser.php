<?php

namespace App\Parsers;

use Carbon\Carbon;
use PHPHtmlParser\Dom;

class Parser
{
    /**
     * @var Dom
     */
    protected $dom;

    /**
     * @var string
     */
    protected $postTitle;

    /**
     * @var string
     */
    protected $postContent;

    /**
     * @var string
     */
    protected $postImage;

    /**
     * @var string
     */
    protected $postDescription;

    /**
     * @var string
     */
    protected $nativeUrl;

    /**
     * @var string
     */
    private $thumbsDir = '/thumbs';

    /**
     * @var string
     */
    private $uploadDir = '/upload';


    public function __construct($url)
    {
        $this->nativeUrl = $url;
        $html = $this->file_get_contents_utf8($this->nativeUrl);
        $this->dom = new Dom;
        $this->dom->loadStr($html);
    }

    protected function uploadImage() {
        if(!$this->postImage) {
            return;
        }
        $file = file_get_contents($this->postImage);
        $extension = pathinfo(parse_url($this->postImage, PHP_URL_PATH), PATHINFO_EXTENSION);
        $now = Carbon::now();
        $name = $now->format('YmdHisu');

        file_put_contents(public_path($this->uploadDir.'/'.$name.'.'.$extension), $file);
        file_put_contents(public_path($this->thumbsDir.'/'.$name.'.'.$extension), $file);

        $this->postImage = url($this->uploadDir.'/'.$name.'.'.$extension);
    }

    private function file_get_contents_utf8($url) {
        $opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
        $context = stream_context_create($opts);
        $content = file_get_contents($url,false, $context);
        return mb_convert_encoding($content, 'UTF-8',
            mb_detect_encoding($content, 'UTF-8, ISO-8859-1', true));
    }
}