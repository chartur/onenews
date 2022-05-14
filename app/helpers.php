<?php

    function getAttributeByLang($collection, $attribute) {
        $lang = app()->getLocale();
        if(is_array($collection)) {
            return $collection[$lang.'_'.$attribute];
        }
        return $collection->{$lang.'_'.$attribute};
    }

    function routingWithLang($url) {
        return url($url[0] == '/' ? app()->getLocale(). $url : app()->getLocale() . "/$url");
    }

    function createPostLink($id, $lang = false) {
        if($lang) {
            return url($lang .'/article?id='. $id);
        }
        return url('/article?id='. $id);
    }

    function addPostViewed($post_id) {
        $post = \App\Models\Post::find($post_id);
        if($post) {
            $post->viewed++;
            $post->save();
        }
    }