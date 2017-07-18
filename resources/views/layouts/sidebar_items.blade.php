@foreach($items as $item)

    @if($item->hasChildren())
        <li class="nav-item">
            <a a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti{{ $item->data('id') }}">
                
                    @if($item->data('icon'))
                            <i class="fa fa-fw {{ $item->data('icon') }}"></i> 
                            
                    @endif
                {!! $item->title !!}
            </a>
            <ul class="sidebar-second-level collapse" id="collapseMulti{{ $item->data('id') }}">
                    @include('layouts.sidebar_items', ['items' => $item->children() , 'level' => 2])
            </ul>
        </li>
    @else
        <li class="{{ $level < 2 ? 'nav-item' : ''}}">
            <a class="nav-link" href="{{ $item->url() }}">
                
                    @if($item->data('icon'))
                            <i class="fa fa-fw {{ $item->data('icon') }}"></i> 
                            
                    @endif
                {!! $item->title !!}
            </a>
        </li>
    @endif

@endforeach

<!--
                    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti"><i class="fa fa-fw fa-sitemap"></i> Menu Levels</a>
                    <ul class="sidebar-second-level collapse" id="collapseMulti">
                        <li>
                            <a href="#">Second Level Item</a>
                        </li>
                        <li>
                            <a href="#">Second Level Item</a>
                        </li>
                        <li>
                            <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti2">Third Level</a>
                            <ul class="sidebar-third-level collapse" id="collapseMulti2">
                                <li>
                                    <a href="#">Third Level Item</a>
                                </li>
                                <li>
                                    <a href="#">Third Level Item</a>
                                </li>
                            </ul>
                        </li>
                    </ul>-->