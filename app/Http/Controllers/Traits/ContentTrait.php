<?php

namespace App\Http\Controllers\Traits;

trait ContentTrait {
    
    private function fetchMentions($post) {
        $post =  html_entity_decode(strip_tags($post));
        preg_match_all('/@(?=.*\w)[\w]{2,}/', $post, $matches);


        return $matches[0];
    }

    private function notifyMentions($post, $comment, $mentions){

        foreach($mentions as $mention) {
            $username = str_replace('@', '', $mention);
            $user = $this->user->where('username', $username)->first();

            if($user) {
                $user->notifications()->create([
                    'message' => ' mentioned you in "'.$post->title.'"',
                    'from_id' => auth()->user()->id,
                    'url' => $comment ?  route('posts.show', ['post' => $post->slug]).'#'.$comment->id :  route('posts.show', ['post' => $post->slug])
                ]);
                //Send Notification of mention here
            }
        }
        
    }

}
