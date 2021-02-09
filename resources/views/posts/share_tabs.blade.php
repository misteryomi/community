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
                    @if(auth()->user() && (auth()->user()->followedCommunities()->count() == 0))
                        <div class="uk-alert-danger text-center" uk-alert>
                            <p><strong>You are not following any community at the moment. <br/><a href="{{ route('community.all') }}" class="text-dark">Find a community</a></strong></p>
                            </p>
                        </div>
                    @else 
                        @include('posts.form')
                    @endif
                                        
                    </li>

                    <!-- <li>Coming soon</li> -->
                    <li>@include('questions.form')</li>
                    <li>@include('rants.form')</li>
                    </ul>
            </div>



