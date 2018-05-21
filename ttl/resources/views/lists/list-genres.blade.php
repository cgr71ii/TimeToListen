@extends('general')

@section('title', 'List of Genres')

@section('content')

<section class="page-section cta">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="cta-inner text-center rounded">
                    <div class="row">
                        <div class="col-xl-12 mx-auto">
                            <div id="pagination-box-style" class="ajax-pagination">
                                @include('lists.pag.genres')
                            </div>

                            @include('pagination-ajax', ['class_name' => 'ajax-pagination', 'object_title' => 'List of Genres'])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection