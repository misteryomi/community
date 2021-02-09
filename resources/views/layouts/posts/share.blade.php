
                    <a target="blank" title="Share on Facebook" uk-tooltip="Share on Facebook" href="https://www.facebook.com/sharer/sharer.php?u={{ route('posts.show', ['post' => $post->slug]) }}&quote={{ $post->title }}" class="mr-2 text-gray">
                        <i class="fa fa-facebook"></i>
                    </a>
                    <a target="blank" title="Share on Twitter" uk-tooltip="Share on Twitter" href="http://twitter.com/share?text={{ $post->title }}&url={{ route('posts.show', ['post' => $post->slug]) }}" class="mr-2 text-gray">
                        <i class="fa fa-twitter"></i>
                    </a>
                    <a target="blank" class="uk-hidden@m mr-2" title="Share on WhatsApp" uk-tooltip="Share on WhatsApp" href="whatsapp://send?text=?{{ \urlencode($post->title.'<br/>'.route('posts.show', ['post' => $post->slug])) }}" class="mr-2 text-gray">
                        <i class="fa fa-whatsapp"></i>
                    </a>
                    <a target="blank" class="uk-visible@m mr-2" title="Share on WhatsApp" uk-tooltip="Share on WhatsApp" href="http://wa.me?text={{ \urlencode($post->title.' '.route('posts.show', ['post' => $post->slug])) }}" class="mr-2 text-gray">
                        <i class="fa fa-whatsapp"></i>
                    </a>
                    <a href="#" uk-tooltip="{{ $post->bookmarked() ? 'Saved' : 'Save for later' }}" class="mr-2 text-gray bookmark {{ $post->bookmarked() ? 'bookmarked' : '' }} " data-toggle="tooltip" data-placement="top" title="{{ $post->bookmarked() ? 'Remove from Saved' : 'Save for later' }}">
                        <i class="fa {{ $post->bookmarked() ? 'fa-bookmark' : 'fa-bookmark-o' }}"></i>
                    </a>

