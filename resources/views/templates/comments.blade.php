
        @if($comments->count() > 0)
        <div class="comments m-0" >
            <ul>
                @foreach ($comments as $comment)
                <li class="border-bottom my-2 card" id="#{{ $comment->id }}">
                    <div class="">
                        <div class="user-details-card py-0 mb-3">
                            <div class="user-details-card-avatar user-details-card-avatar-sm">
                                {!! $comment->user->displayAvatar() !!}
                            </div>
                            <div class="user-details-card-name">
                                {{ ucfirst($comment->user->username) }} <span> {{ $comment->user->level }}<span><small>{{ $comment->date }}</small> </span> </span>
                            </div>
                        </div>

                        {!! $comment->comment !!}
                    </div>
                    <div class="btn-acts mt-5">
                        <div>
                            <a href="#" class="button white circle pr-1 like {{ $comment->liked() ? 'liked ' : '' }}"  uk-tooltip="{{ $comment->liked() ? 'Unlike ' : 'Like' }}" title="" aria-expanded="false">
                              <small><i class="uil-thumbs-up mr-1"></i> <span class="liked_text m-0 pr-1"> {{ $comment->liked() ? 'Liked ' : 'Like' }}</span><span class="m-0 {{ $comment->likes()->count() > 0  ? '' : 'uk-hidden'  }}"> - <span class=" m-0 likes-count">{{ $comment->likes()->count() }}</span></span></small>
                            </a>
                            @if($post->isQuestion() && $comment->user_id != $post->user->id) 
                            <a href="?best_answer={{ $comment->id }}" title="" class="button white circle pr-1" aria-expanded="false"><small><strong>
                                Mark as Best Answer</strong></small>
                            </a>
                            @endif
                        </div>
                        <div>
                            <a target="blank" title="Share on Facebook" uk-tooltip="Share on Facebook" href="https://www.facebook.com/sharer/sharer.php?u={{ route('posts.show', ['post' => $post->slug]) }}&quote={{ $post->title }}&utm_source=jaracentral.com" class="mr-2 text-gray">
                                <i class="fa fa-facebook"></i>
                            </a>
                            <a target="blank" title="Share on Twitter" uk-tooltip="Share on Twitter" href="http://twitter.com/share?text={{ $post->title }}&url={{ route('posts.show', ['post' => $post->slug]) }}&text={{ $post->title }}&utm_source=jaracentral.com" class="mr-2 text-gray">
                                <i class="fa fa-twitter"></i>
                            </a>
                            <a target="blank" class="uk-hidden@m mr-2" title="Share on WhatsApp" uk-tooltip="Share on WhatsApp" href="whatsapp://send?text=?{{ \urlencode($post->title.'<br/>'.route('posts.show', ['post' => $post->slug])) }}" class="mr-2 text-gray">
                                <i class="fa fa-whatsapp"></i>
                            </a>
                            <a target="blank" class="uk-visible@m mr-2" title="Share on WhatsApp" uk-tooltip="Share on WhatsApp" href="http://wa.me?text={{ \urlencode($post->title.' '.route('posts.show', ['post' => $post->slug])) }}" class="mr-2 text-gray">
                                <i class="fa fa-whatsapp"></i>
                            </a>

                            <a href="#" class="#"><i class="uil-ellipsis-h"></i></a>

                            <div uk-dropdown="mode: click">
                                <ul class="uk-list uk-list-divider">
                                    <li>
                                        <a href="#">Report Post </a>
                                    </li>
                                    @if($comment->canEdit())
                                    <li>
                                        <a href="{{ route('posts.comment.edit', ['comment' => $comment->id, 'post' => $post->slug]) }}"><strong>Edit</strong></a>
                                    </li>
                                    @endif
                                </ul>
                            </div>                
                        </div>
                    </div>

                </li>
                @endforeach

            </ul>

        </div>
        @endif
        

{{ $comments->links('layouts.pagination.custom') }}
