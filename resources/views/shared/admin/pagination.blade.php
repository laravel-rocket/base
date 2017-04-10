<div class="c-pagination">
    <ul class="c-pagination__list">
        @if( isset($firstPageLink) )
            <li class="c-pagination__arrow"><a href="{!! $firstPageLink!!}">«</a></li>
        @else
            <li class="c-pagination__arrow c-pagination__arrow--is-disabled"><a>«</a></li>
        @endif
        @foreach( $pages as $page)
            @if( $page['current'] )
                <li class="c-pagination__page c-pagination__page--is-active"><a>{{ $page['number'] }}</a></li>
            @else
                <li class="c-pagination__page"><a href="{!! $page['link'] !!}">{{ $page['number'] }}</a></li>
            @endif
        @endforeach
        @if( isset($lastPageLink) )
            <li class="c-pagination__arrow"><a href="{!! $lastPageLink!!}">»</a></li>
        @else
            <li class="c-pagination__arrow c-pagination__arrow--is-disabled"><a>»</a></li>
        @endif
    </ul>
</div>
