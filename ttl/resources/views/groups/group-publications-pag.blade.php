
<h2>Publications</h2>

<hr>

<div class="row">
    <div class="col-xl-9 mx-auto">
        <div class="pagination-element-box-non-style">
            <form id="order-form" method="GET" action="{{ action('GroupController@groupPublications') }}">
                {{ csrf_field() }}
                <select name="field" form="order-form">
                    <option value="created_at">Created At</option>
                    <option value="updated_at">Updated At</option>
                </select>

                <select name="direction" form="order-form">
                    <option value="asc">Ascendent</option>
                    <option value="desc">Descendent</option>
                </select>
                
                <input type="hidden" name="order-form">
                <input type="submit" value="Order">
            </form>
        </div>
    </div>
</div>

<hr>

@if (count($publications) != 0)
<span class="link-pagination">
    {{ $publications->links() }}
</span>
@endif

<hr>

@foreach ($publications as $publication)
<div class="pagination-element-box-style">
    <div class="pagination-content-wrapper">
        <b>Message From: {{ $publication->user->name }} {{ $publication->user->lastname }} ({{ $publication->user->email }})</b>
        <p style="margin-top: 5%;">{{ $publication->text }}</p>
        @if ($publication->created_at != $publication->updated_at)
        <p style="text-align: right; margin-bottom: -1%;">Updated at: {{ $publication->updated_at }}</p>
        @endif
        <p style="text-align: right;">Created at: {{ $publication->created_at }}</p>
    </div>
</div>

@endforeach

<hr>

@if (count($publications) != 0)
<span class="link-pagination">
    {{ $publications->links() }}
</span>
@endif