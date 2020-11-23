@if ($paginator->hasPages())
    <ul class="uk-pagination my-5 uk-flex-center" uk-margin>
       
        @if ($paginator->onFirstPage())
            <li class="uk-disabled"><span>← Previous</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" class="uk-first-column" rel="prev">← Previous</a></li>
        @endif


      
        @foreach ($elements as $element)
           
            @if (is_string($element))
                <li class="uk-disabled"><span>{{ $element }}</span></li>
            @endif


           
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="uk-active"><span>{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach


        
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" class="uk-last-column" rel="next">Next →</a></li>
        @else
            <li class="uk-disabled"><span>Next →</span></li>
        @endif
    </ul>
@endif 