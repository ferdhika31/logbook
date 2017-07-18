
    @if(($items = app('cashtag.menu')->roots()) && (!$items->isEmpty()))
        @include('layouts.sidebar_items', ['items' => $items])
    @endif
