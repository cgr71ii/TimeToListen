@extends('general')

@section('title', 'List of Publications')

@section('content')

<section class="page-section cta">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <div class="cta-inner text-center rounded">
                    <div class="row">
                        <div class="col-xl-9 mx-auto">        
                            <div id="pagination-box-style" class="ajax-pagination">
                                @include('lists.pag.publications')
                            </div>

                            @include('pagination-ajax', ['class_name' => 'ajax-pagination', 'object_title' => 'List of Publications'])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection