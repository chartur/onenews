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

    function createPostLink($id) {
        return url('/article/'. $id);
    }