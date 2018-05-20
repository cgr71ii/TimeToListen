@extends('general')

@section('title', 'List of Messages')

@section('content')

<section class="page-section cta">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <div class="cta-inner text-center rounded">
                    <div class="row">
                        <div class="col-xl-9 mx-auto">        
                            <div id="pagination-box-style" class="ajax-pagination">
                                @include('lists.pag.messages')
                            </div>

                            @include('pagination-ajax', ['class_name' => 'ajax-pagination', 'object_title' => 'List of Messages'])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection