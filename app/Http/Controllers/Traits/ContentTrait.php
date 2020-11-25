<?php

namespace App\Http\Controllers\Traits;

trait ContentTrait {
    
    private function fetchMentions($post) {
        $post =  html_entity_decode(strip_tags($post));
        preg_match_all('/@(?=.*\w)[\w]{2,}/', $post, $matches);


        return $matches[0];
    }

    private function notifyMentions($post, $mentions){

        foreach($mentions as $mention) {
            $username = str_replace('@', '', $mention);
            $checkExists = $this->user->where('username', $username)->count();

            if($checkExists) {
                //Send Notification of mention here
            }
        }
        
    }

}
