@extends('layout.index')
@section('title', 'Главная')

@section('main')
    @include('layout.carousel')

    <div class="light-wrapper">
        <div class="container inner">

            <div class="section-title text-center">
                <h3>The Product Gallery</h3>
                <p class="lead">awesome products prepared with creative ideas and great design</p>
            </div>
            <div class="cbp-panel">
                <div id="filters-container" class="cbp-filter-container text-center">

                    @foreach ($categories as $category)

                        <div id="filters-container" class="cbp-filter-container text-center" data-filter="{{ $category->id }}">
                            {{ $category->category_name }}
                        </div>

                    @endforeach
                </div>
                <div id="grid-container" class="cbp">
                    <div class="cbp-item 3 motion">
                        @foreach ($category->items as $item)
                            <a href="ajax/project1.html" class="cbp-caption cbp-singlePageInline">
                                <div class="cbp-caption-defaultWrap"> <img src="{{ Storage::url($item->image) }}" alt="" />
                                </div>
                                <div class="cbp-caption-activeWrap">
                                    <div class="cbp-l-caption-alignCenter">
                                        <div class="cbp-l-caption-body">
                                            <div class="cbp-l-caption-title">{{$item->name}}</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="divide30"></div>
                <div class="row">
                    <a href="{{ route('item-category.create') }}" class="btn btn-primary mb-3">Создать новый категорию</a>
                    <a href="{{ route('item.create') }}" class="btn btn-primary mb-3">Создать новую карточку</a>
                </div>
                <!--/.cbp -->
                <!--/.text-center -->
            </div>
            <!--/.cbp-panel -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.light-wrapper -->
@endsection
