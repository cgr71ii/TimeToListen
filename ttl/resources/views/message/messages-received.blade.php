@extends('general')

@section('title', 'List of Received Messages')

@section('css')
    <!-- All css imports or <style></style> here. -->

    <link rel="stylesheet" type="text/css" href="/css/pagination.css">
@endsection

@section('content')
    <!--All body code here.-->
<section class="page-section cta">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="cta-inner text-center rounded">
                    <div class="row">
                        <div class="col-xl-12 mx-auto">
                            <div id="pagination-box-style" class="ajax-pagination">
                            @include('message.messages-received-pag')
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