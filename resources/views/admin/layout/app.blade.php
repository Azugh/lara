<div class="main-container " id="container">

    <div class="overlay"></div>
    <div class="cs-overlay"></div>
    <div class="search-overlay"></div>

    <!--  BEGIN SIDEBAR  -->
    @include('admin.layout.sidebar')
    <!--  END SIDEBAR  -->

    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="container">
            <div class="container">

                <!-- BREADCRUMB -->
                {{-- <div class="page-meta">
                    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Form</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Slider</li>
                        </ol>
                    </nav>
                </div> --}}
                <!-- /BREADCRUMB -->
                <div class="row layout-top-spacing">
                    <div class="col-lg-12 layout-spacing">
                        <div class="row">
                            <div class="col-lg-12 mb-4">
                                <div class="statbox widget box box-shadow">
                                    <div class="widget-header">
                                        <div class="row">
                                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                                <h4 class="mb-4">Создать Слайдер</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4 class="mb-4">Non linear slider</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content widget-content-area align-center">
                                    <div class="container">
                                        <div id="nonlinear"></div>
                                        <br />
                                        <div class="row mt-4 mb-4">
                                            <div class="col-lg-6">
                                                <a href="{{ route('admin.create') }}" class="btn btn-success mb-3">
                                                    Создать слайдер
                                                </a>

                                                @if($sliders->count() > 0)
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Изображение</th>
                                                                <th>Заголовок</th>
                                                                <th>Текст слайдера</th>
                                                                <th>Текст кнопки</th>
                                                                <th>Действия</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($sliders as $slider)
                                                                <tr>
                                                                    <td>{{ $slider->id }}</td>
                                                                    <td>
                                                                        @if($slider->image)
                                                                            <img src="{{ Storage::url($slider->image) }}"
                                                                                width="300">
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ $slider->title }}</td>
                                                                    <td>{{ $slider->content }}</td>
                                                                    <td>{{ $slider->btn_txt }}</td>
                                                                    <td>
                                                                        <a href="{{ route('admin.edit', $slider->id) }}"
                                                                            class="btn btn-warning">Редактировать</a>
                                                                        <a href="{{ route('admin.show', $slider->id) }}"
                                                                            class="btn btn-warning">Детали</a>
                                                                        <form action="{{ route('admin.destroy', $slider->id) }}"
                                                                            method="POST" class="d-inline">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit" class="btn btn-danger"
                                                                                onclick="return confirm('Удалить?')">Удалить</button>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <p>Нет слайдеров.</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <!--  BEGIN FOOTER  -->
    @include('admin.layout.footer')
    <!--  END FOOTER  -->

</div>
