@extends('layout.index')
@section('title', 'Главная')

@section('main')
    @include('layout.carousel')

    <div class="section-title text-center">
        <h3>The Product Gallery</h3>
        <p class="lead">awesome products prepared with creative ideas and great design</p>
    </div>

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
                            <div class="cbp-item {{ $category->id }} "><a
                                    href="{{route('item.show', ['item' => $item])}}">
                                    <div class="cbp-caption-defaultWrap">
                                        <img src="{{ $item->image }}" alt="{{ $item->name }}"/>
                                    </div>
                                    <div class="cbp-caption-activeWrap ">
                                        <div class="cbp-l-caption-alignCenter">
                                            <div class="cbp-l-caption-body">
                                                <div class="cbp-l-caption-title">{{ $item->name }}</div>
                                            </div>
                                        </div>
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
                    <a href="{{ route('admin.item-category.create') }}" class="btn btn-primary mb-3">Создать новый
                        категорию</a>
                    <a href="{{ route('admin.item.create') }}" class="btn btn-primary mb-3">Создать новую карточку</a>
                </div>
            @endif

        @else
            <div class="alert alert-info">
                <p>Категории пока не созданы.</p>
                <a href="{{ route('item-category.create') }}" class="btn btn-primary">Создать первую категорию</a>
            </div>
        @endif
    </div>
@endsection
