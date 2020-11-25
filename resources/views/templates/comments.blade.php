
        @if($comments->count() > 0)
        <div class="comments mt-4">
            <!-- <h3>Comments
                <span class="comments-amount">{{ $post->comments->count() }}</span>
            </h3> -->

            <ul>
                @foreach ($comments as $comment)
                <li>
                    <!-- <div class="comments-avatar"><img src="{{ $comment->user->avatar }}" alt="">
                    </div> -->
                    <div class="">
                        <a href="#" class="user-details-card pt-0">
                            <div class="user-details-card-avatar" style="max-width: 40px">
                                <img src="{{ $post->user->avatar }}" alt="">
                            </div>
                            <div class="user-details-card-name">
                                {{ ucfirst($comment->user->username) }} <span> {{ $comment->user->level }} <span> {{ $post->date }} </span> </span>
                            </div>
                        </a>
                        <!-- <div class="comment-by">{{ ucfirst($comment->user->username) }}<span>{{ $comment->date}}</span> -->
                        <!-- {{ $comment->user->level}} -->
                            <!-- <a href="#" class="reply"><i class="icon-line-awesome-undo"></i> Reply</a> -->
                        {!! $comment->comment !!}
                    </div>
                    <div class="btn-acts">
                        <div>
                            <a href="#" class="button white circle like {{ $post->liked() ? 'liked ' : '' }}"  uk-tooltip="{{ $post->liked() ? 'Unlike ' : 'Like' }}" title="" aria-expanded="false">
                                <i class="uil-thumbs-up mr-1"></i> <span class="liked_text m-0 pr-1"> {{ $post->liked() ? 'Liked ' : 'Like' }}</span><span class="m-0 {{ $post->likes()->count() > 0  ? '' : 'uk-hidden'  }}"> - <span class=" m-0 likes-count">{{ $post->likes()->count() }}</span></span>
                            </a>
                        </div>
                        <div>
                            <a target="blank" title="Share on Facebook" uk-tooltip="Share on Facebook" href="https://www.facebook.com/sharer/sharer.php?u={{ route('posts.show', ['post' => $post->slug]) }}&quote={{ $post->title }}&utm_source=facebook" class="mr-2 text-gray">
                                <i class="fa fa-facebook"></i>
                            </a>
                            <a target="blank" title="Share on Twitter" uk-tooltip="Share on Twitter" href="http://twitter.com/share?text={{ $post->title }}&url=https://www.facebook.com/sharer/sharer.php?u={{ route('posts.show', ['post' => $post->slug]) }}&text={{ $post->title }}&utm_source=twitter" class="mr-2 text-gray">
                                <i class="fa fa-twitter"></i>
                            </a>
                            <a href="#" uk-tooltip="Save for later" class="mr-2 text-gray bookmark {{ $post->bookmarked() ? 'bookmarked' : '' }} " data-toggle="tooltip" data-placement="top" title="{{ $post->bookmarked() ? 'Remove from Saved' : 'Save for later' }}">
                                <i class="fa {{ $post->bookmarked() ? 'fa-bookmark' : 'fa-bookmark-o' }}"></i>
                            </a>

                            <!-- <a href="#" class="#"><i class="uil-share-alt"></i></a> -->
                            <a href="#" class="#"><i class="uil-ellipsis-h"></i></a>

                            <div uk-dropdown="mode: click">
                                <ul class="uk-list uk-list-divider">
                                    <li>
                                        <a href="#">Report Post </a>
                                    </li>
                                    @if($post->canEdit())
                                    <li>
                                        <a href="#"><strong>Edit</strong></a>
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
        <hr>

{{ $comments->links('layouts.pagination.custom') }}
