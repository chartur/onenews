<?php

namespace App\Parsers;

use Carbon\Carbon;
use PHPHtmlParser\Dom;
use GuzzleHttp\Client;
use GuzzleHttp\TransferStats;

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

        $opts = [
            'http' => ['header' => "User-Agent:MyAgent/1.0\r\n"],
            "ssl" => [
                "verify_peer" => false,
                "verify_peer_name" => false,
            ],
        ];  
        
        $file = file_get_contents($this->postImage, false, stream_context_create($opts));

        $extension = pathinfo(parse_url($this->postImage, PHP_URL_PATH), PATHINFO_EXTENSION);
        $now = Carbon::now();
        $name = $now->format('YmdHisu');

        file_put_contents(public_path($this->uploadDir.'/'.$name.'.'.$extension), $file);
        file_put_contents(public_path($this->thumbsDir.'/'.$name.'.'.$extension), $file);

        $this->postImage = url($this->uploadDir.'/'.$name.'.'.$extension);
    }

    private function file_get_contents_utf8($url) {
        // $client = new Client;
        // return $client->get($url, [
        //     'verify' => false,
        //     'headers' => [
        //         'User-Agent' => "Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0",
        //     ],
        //     'curl' => [
        //         CURLOPT_SSL_VERIFYPEER => false
        //     ],
        //     'on_stats' => function (TransferStats $stats) use (&$url) {
        //         $url = $stats->getEffectiveUri();
        //     }
        // ])->getBody()->getContents();

        $opts = [
            'http' => ['header' => "User-Agent:MyAgent/1.0\r\n"],
            "ssl" => [
                "verify_peer" => false,
                "verify_peer_name" => false,
            ],
        ];  
        
        $context = stream_context_create($opts);
        $content = file_get_contents($url,false, $context);

        return mb_convert_encoding($content, 'UTF-8',
            mb_detect_encoding($content, 'UTF-8, ISO-8859-1', true));
    }
}
