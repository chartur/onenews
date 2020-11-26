<?php
/**
 * Created by PhpStorm.
 * User: arturchilingaryan
 * Date: 11/26/20
 * Time: 19:44
 */

namespace App\Http\Repos;


use App\Models\Post;
use DOMDocument;

class FacebookArticleRepo
{
    private $post;

    private $selectedLanguage;

    private $dom;

    private $tags = [];

    public function __construct(Post $post, $lang)
    {
        $this->post = $post;
        $this->selectedLanguage = $lang;
        app()->setLocale($lang);
        $this->dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $this->dom->loadHTML('<?xml encoding="utf-8" ?>'. $post->{$lang.'_content'});
    }

    public function createContentHTML()
    {
        $this->getImages();
        $this->getVideos();
        $this->getIframes();
        $content = $this->getParagraphs();
        $title = $this->post->{$this->selectedLanguage.'_title'};
        $url = createPostLink($this->post->id, $this->selectedLanguage);
        $datetime = $this->post->created_at->toIso8601String();
        $datetime_print = $this->post->created_at->formatLocalized('%d %b, %Y %H:%M');
        $image = url($this->post->image);
        $tags = $this->tags;

        $HTML = view('admin.includes.article-template')->with(compact(
            'content','title','url','datetime','datetime_print','image','tags'
        ))->render();
        return $HTML;
    }

    private function getParagraphs()
    {
        $ps = $this->dom->getElementsByTagName('p');
        $content = '';
        foreach ($ps as $p) {
            $innerText = trim($p->textContent);
            if(!empty($innerText)){
                $content .= "<p>$innerText</p>\n";
            }
        }
        return $content;
    }

    private function getImages()
    {
        $images = $this->dom->getElementsByTagName('img');
        foreach ($images as $image) {
            $dom = new DOMDocument();
            $img = $dom->importNode($image);
            $img = $dom->saveHTML($img);
            $this->tags[] = [
                'type' => 'image',
                'content' => $img
            ];
        }
    }

    private function getVideos()
    {
        $videos = $this->dom->getElementsByTagName('video');
        foreach ($videos as $video) {
            $dom = new DOMDocument();
            $source = $video->getAttribute('src');
            if(!$source) {
                $source = $video->getElementsByTagName('source')->item(0);
                if(!$source) {
                    continue;
                }

                $source = $source->getAttribute('src');
                $video->setAttribute('src', $source);
            }
            $vid = $dom->importNode($video);
            $vid = $dom->saveHTML($vid);
            $this->tags[] = [
                'type' => 'video',
                'content' => $vid
            ];
        }
    }

    private function getIframes()
    {
        $iframes = $this->dom->getElementsByTagName('iframe');
        foreach ($iframes as $iframe) {
            $dom = new DOMDocument();
            $ifr = $dom->importNode($iframe);
            $ifr = $dom->saveHTML($ifr);
            $this->tags[] = [
                'type' => 'iframe',
                'content' => $ifr
            ];
        }
    }
}