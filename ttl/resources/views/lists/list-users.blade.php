@extends('general')

@section('title', 'List of Users')

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
                                @include('lists.pag.users')
                            </div>

                            @include('pagination-ajax', ['class_name' => 'ajax-pagination', 'object_title' => 'List of Users'])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection