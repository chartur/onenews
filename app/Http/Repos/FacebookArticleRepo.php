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

    private $htmlDom;

    public function __construct(Post $post, $lang)
    {
        $this->post = $post;
        $this->selectedLanguage = $lang;
    }

    public function loadContent() {
        $this->htmlDom = new DOMDocument();
        $this->htmlDom->loadHTML($this->post->{$this->selectedLanguage.'_content'});
        $this->loadImage();
    }

    private function loadImage() {
        $imageTags = $this->htmlDom->getElementsByTagName('img');
//        dd($imageTags[0]->attributes[0]);
    }
}