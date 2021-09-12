<?php


namespace App\Parsers;

class ArmLurParser extends Parser
{
    private $siteUrl = 'https://www.blognews.am/';

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
        $elements = $this->dom->find('.single-post-content p');
        $iframes = $this->dom->find('.single-post-content iframe');
        $images = $this->dom->find('.single-post-content img');

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
