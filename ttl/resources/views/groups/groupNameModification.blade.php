
@extends('general')

@section('title', "Groups")

@section('content')

<section class="page-section cta">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <div class="cta-inner text-center rounded">
                    <h2 class="section-heading mb-4">
                        <span class="section-heading-lower">New Group Name</span>
                    </h2>

                    <form method="POST" action="{{ action('GroupController@updateOnlyName') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="group_id" value="{{ $id }}">

                        <div style="text-align: center;margin-top: 5%;">
                            <div class="row">
                                <div class="col-md-4 offset-md-4">
                                    <input type="text" id="new-group-name" name="name" style="width:100%">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 offset-md-4">
                                <div style="text-align: center; margin-top: 5%;">
                                    <input type="submit" value="Change">
                                </div>
                            </div>
                        </div>
                    </form>

            </div>
        </div>
    </div>
</section>

@endsection