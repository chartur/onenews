<?php


namespace App\Parsers;

class BlogNewsParser extends Parser
{
    private $siteUrl = 'https://www.blognews.am';

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
        $elements = $this->dom->find('meta[property="og:title"]');
        $element = $elements[0];
        $this->postTitle = $element->getAttribute('content');
        $this->postTitle = str_replace('- BlogNews.am', '', $this->postTitle);
        $this->postTitle = trim($this->postTitle);
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
        $elements = $this->dom->find('article');
        $elements->lastChild()->delete();
        $deleteElements = $this->dom->find('article .note');
        foreach ($deleteElements as $element) {
            $element->delete();
        }
        $element = $elements[0];
        $iframes = $this->dom->find('article iframe');
        $images = $this->dom->find('article img');

        foreach ($images as $image) {
            $src = $image->getAttribute('src');
            if(substr( $src, 0, 4 ) != "http") {
                $src = $this->siteUrl.$src;
            }
            $this->postContent .= "<div><img src='$src'></div>";
        }

        $this->postContent .= '<p>'. $element->innerText() .'</p>';

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
