<?php


namespace App\Parsers;

class ShamshyanParser extends Parser
{
    private $siteUrl = 'https://shamshyan.com/';

    public function getPostData() {
        $this->parsePostTitle()
            ->parsePostContent()
            ->parsePostDescription()
            ->parsePostImage()
            ->uploadImage();

        return [
            'content' => $this->postContent,
            'title' => $this->postTitle,
            'image' => $this->postImage,
            'ref' => $this->nativeUrl,
            'description' => $this->postDescription
        ];
    }

    private function parsePostTitle()
    {
        $elements = $this->dom->getElementsByTag('h2');
        $element = $elements[0];
        $this->postTitle = $element->innerText();
        return $this;
    }

    private function parsePostDescription()
    {
        $elements = $this->dom->find('meta[property="og:description"]');
        $element = $elements[0];
        $this->postDescription = $element->getAttribute('content');
        return $this;
    }

    private function parsePostContent()
    {
        $element = $this->dom->getElementById('newsText');
        $images = $this->dom->find('.swiper-slide img');
        $iframes = $this->dom->find('#newsText iframes');

        $this->postContent .= $element->innerText();

        foreach ($images as $image) {
            $src = $image->getAttribute('src');
            $this->postContent .= "<div><img src='$src'></div>";
        }

        foreach ($iframes as $iframe) {
            $src = $iframe->getAttribute('src');
            if(!$src) {
                continue;
            }
            $width = $iframe->getAttribute('width');
            $height = $iframe->getAttribute('height');
            $this->postContent .= "<iframe src='$src' height='$height' width='$width'></iframe>";
        }

        return $this;
    }

    private function parsePostImage()
    {
        $elements = $this->dom->find('meta[property="og:image"]');
        $element = $elements[0];
        $this->postImage = $element->getAttribute('content');
        return $this;
    }
}
