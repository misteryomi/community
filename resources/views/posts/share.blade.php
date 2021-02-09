      @if(auth()->user() && (auth()->user()->followedCommunities()->count() == 0))
      <div class="uk-alert-danger" uk-alert>
          <a class="uk-alert-close" uk-close></a>
          <p><strong>You are not following any community at the moment. <a href="{{ route('community.all') }}" class="text-dark">Find a community</a></strong></p>
          </p>
      </div>
      @endif
      

<div class="post-newer">

<div class="post-new" uk-toggle="target: body ; cls: post-focus">
    <div class="post-new-media">
        <div class="post-new-media-user">
            @guest
                <div class="mt-2">
                    <span class="icon-border"><i class="uil-user"></i></span>
                </div>
            @else
            {!! auth()->user()->displayAvatar() !!}
            @endguest
        </div>
        <div class="post-new-media-input">
            <input type="text" class="uk-input" disabled placeholder="Share your memes, thoughts, any stuff!">
        </div>

    </div>
    <hr>
    <div class="post-new-type">

        <a href="{{ route('topics.new') }}">
            <i class="uil-briefcase-alt pr-2"></i> Stuff
        </a>

        <a href="{{ route('rants.new') }}">
            <i class="uil-angry pr-2"></i> Rant!
        </a>

        <a href="{{ route('questions.new') }}">
            <i class="uil-comment-alt-question pr-2"></i> Question
        </a>

    </div>
</div>

<div class="post-pop">

    <div class="post-new-overyly" uk-toggle="target: body ; cls: post-focus"></div>
    <div class="post-new uk-animation-slide-top-small">

        @guest

            @include('auth.login-form')

        @else 


        <div class="post-new-header">

            <h4> Post new stuff!</h4>
            <span class="post-new-btn-close" uk-toggle="target: body ; cls: post-focus"
                uk-tooltip="pos: left "></span>

        </div>

          @include('posts.share_tabs')
        @endguest

    </div>
</div>

</div>
