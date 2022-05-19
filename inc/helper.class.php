<?php

class Helper {

    /**
     * static generate random string function
     * length by default 6 digit
     */
    public static function generateRandomString($length = 6){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function get_gallery_post_by_slug($slug){
        $posts = get_posts(array(
            'name' => $slug,
            'posts_per_page' => 1,
            'post_type' => 'galleries',
            'post_status' => 'publish'
        ));

        return $posts ? $posts[0] : false;
    }
}