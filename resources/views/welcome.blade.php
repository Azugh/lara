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
            <div id="filters-container" class="cbp-filter-container text-center">
                <div class="cbp-panel">

                    <div data-filter="*" class="cbp-filter-item-active cbp-filter-item"> All </div>
                    {{-- <div data-filter=".print" class="cbp-filter-item"> Print </div>
                    <div data-filter=".web" class="cbp-filter-item"> Web Design </div>
                    <div data-filter=".logo" class="cbp-filter-item"> Logo </div>
                    <div data-filter=".motion" class="cbp-filter-item"> Motion </div> --}}
                    @foreach ($categories as $category)
                        <div data-filter=".{{ $category->id }}" class="cbp-filter-item"> {{ $category->category_name }} </div>
                    @endforeach
                </div>
                <div id="grid-container" class="cbp">
                    @foreach ($categories as $category)
                        @foreach ($category->items as $item)
                            <div class="cbp-item {{ $category->id }}">

                                <div class="cbp-caption-defaultWrap"> <img src="{{ Storage::url($item->image) }}" alt="" />
                                </div>
                                <div class="cbp-caption-activeWrap">
                                    <div class="cbp-l-caption-alignCenter">
                                        <div class="cbp-l-caption-body">
                                            <div class="cbp-l-caption-title">{{ $item->name }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    @endforeach

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
            </>
            <!-- /.container -->
        </div>
        <!-- /.light-wrapper -->
@endsection