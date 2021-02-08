<div class="post-newer">

<div class="post-new" uk-toggle="target: body ; cls: post-focus">
    <div class="post-new-media">
        <div class="post-new-media-user">
            @guest
            <span class="icon-border mt-3"><i class="uil-user"></i></span>
            @else
            {!! auth()->user()->displayAvatar() !!}
            @endguest
        </div>
        <div class="post-new-media-input">
            <input type="text" class="uk-input" placeholder="Share your memes, thoughts, any stuff!">
        </div>

    </div>
    <hr>
    <div class="post-new-type">

        <a href="#">
            <i class="uil-angry pr-2"></i> Rant!
        </a>

        <a href="#">
            <i class="uil-comment-alt-question pr-2"></i> Question
        </a>

        <a href="#">
            <i class="uil-briefcase-alt pr-2"></i> Stuff
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
                uk-tooltip="title:Close; pos: left "></span>

        </div>

        <div>
                <ul class="uk-child-width-expand" uk-tab
                    uk-switcher="animation: uk-animation-slide-left-medium, uk-animation-slide-right-medium">
                    <li class="uk-active"><a href="#">Topic</a></li>
                    <!-- <li><a href="#">News</a></li> -->
                    <li><a href="#">Question</a></li>
                    <li><a href="#">Rant</a></li>
                </ul>                    
                        
                <ul class="uk-switcher uk-margin uk-padding-small pt-0">
                        <!-- tab 1 -->
                    <li>
                        @include('posts.form')
                    </li>

                    <!-- <li>Coming soon</li> -->
                    <li>@include('questions.form')</li>
                    <li>@include('rants.form')</li>
                    </ul>
            </div>


            @endguest

    </div>
</div>

</div>
