<?php


namespace App\Parsers;

use PHPHtmlParser\Dom;
use PHPHtmlParser\Dom\Node\HtmlNode;

class NewsAmParser extends Parser
{
    private $siteUrl = 'https://news.am/';

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
        $elements = $this->dom->find('.article-title');
        $element = $elements[0];
        $this->postTitle = $element->innerText();
        return $this;
    }

    private function parsePostDescription()
    {
        $elements = $this->dom->find('meta[property="og:description"]');
        if(!$elements->count()) {
            $elements = $this->dom->find('meta[name="description"]');
        }
        $element = $elements[0];
        $this->postDescription = $element->getAttribute('content');
        return $this;
    }

    private function parsePostContent()
    {
        $elements = $this->dom->find('.article-text .article-body p');
        $iframes = $this->dom->find('.article-text iframe');
        $images = $this->dom->find('.article-text .article-body img');

        foreach ($images as $image) {
            $src = $image->getAttribute('src');
            $this->postContent .= "<div><img src='$src'></div>";
        }

        foreach ($elements as $p)
        {
            $this->postContent .= '<p>'. $p->innerText() .'</p>';
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
