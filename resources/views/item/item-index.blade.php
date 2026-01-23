<div class="container layout-top-spacing">
    <h1>итемы</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
{{--TODO Доделать саорачивание сайдбара возможно js ajax--}}
    <div id="filters-container" class="cbp-filter-container text-center">
        @if(isset($categories) && count($categories) > 0)
            <div class="cbp-panel">
                <div data-filter="*" class="cbp-filter-item-active cbp-filter-item"> All</div>

                @foreach ($categories as $category)
                    <div data-filter=".{{ $category->id }}" class="cbp-filter-item">
                        {{ $category->category_name }}
                    </div>
                @endforeach
            </div>

            <div id="grid-container" class="cbp">
                @foreach ($categories as $category)
                    @if(isset($category->items) && count($category->items) > 0)
                        @foreach ($category->items as $item)
                            <div class="cbp-item {{ $category->id }} col-xxl-4 col-xl-6 col-lg-6 col-md-6"><a
                                    href="{{route('item.show', ['item' => $item])}}">
                                    <div class="cbp-caption-defaultWrap card-img-top">
                                        <img src="{{ $item->image }}" alt="{{ $item->name }}"/>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endif
                @endforeach
            </div>

            <div class="divide30"></div>
            @if(\Illuminate\Support\Facades\Auth::user()?->isAdmin())
                <div class="row">
                    <a href="{{ route('admin.item-category.create') }}" class="btn btn-primary mb-3">Создать
                        новый
                        категорию</a>
                    <a href="{{ route('admin.item.create') }}" class="btn btn-primary mb-3">Создать новую
                        карточку</a>
                </div>
            @endif

        @else
            <div class="alert alert-info">
                <p>Категории пока не созданы.</p>
                <a href="{{ route('item-category.create') }}" class="btn btn-primary">Создать первую
                    категорию</a>
            </div>
        @endif
    </div>
</div>
