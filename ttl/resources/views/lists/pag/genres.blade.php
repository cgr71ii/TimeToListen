
<h2>List of Genres</h2>

<hr>

<div class="pagination-element-box-non-style">
    <form id="order-form" method="GET" action="{{ action('GenreController@listGenres') }}">
        {{ csrf_field() }}
        <select name="field" form="order-form">
            <option value="created_at">Created At</option>
            <option value="updated_at">Updated At</option>
            <option value="name">Name</option>
        </select>

        <select name="direction" form="order-form">
            <option value="asc">Ascendent</option>
            <option value="desc">Descendent</option>
        </select>
        
        <input type="hidden" name="order-form">
        <input type="submit" value="Order">
    </form>
</div>

<hr>

@if (count($genres) != 0)
<span class="link-pagination">
    {{ $genres->links() }}
</span>
@endif

@foreach ($genres as $genre)
<div class="pagination-element-box-style">
    <div class="pagination-content-wrapper">
        <p>Id: {{ $genre->id }}</p>
        <p>Name: {{ $genre->name }}</p>
        @if ($genre->created_at != $genre->updated_at)
        <p style="text-align: right;">Updated at: {{ $genre->updated_at }}</p>
        @endif
        <p style="text-align: right;">Created at: {{ $genre->created_at }}</p>
    </div>
</div>

<div class="pagination-actions">
    <a href="#" data-id="{{ $genre->id }}" data-title="Modify Genre" data-toggle="modal" data-target="#modifyGenreModal{{ $genre->id }}">Modify</a>
    <a href="#" data-id="{{ $genre->id }}" data-title="Delete Genre" data-toggle="modal" data-target="#removeGenreModal{{ $genre->id }}">Delete</a>
</div>

<div class="modal fade" id="modifyGenreModal{{ $genre->id }}" tabindex="-1" role="dialog" aria-labelledby="modifyGenreModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <form method="POST" action="{{ action('GenreController@update') }}">
            {{ csrf_field() }}

            <input type="hidden" name="genre_id" value="{{ $genre->id }}">

            <div class="modal-header">
            <h4 class="modal-title" id="modifyGenreModalLabel">Modify Genre</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body write-pub">
            <p>Changing {{ $genre->name }} Genre</p>
                <table style="margin: 0 auto;">
                    <tr>
                        <th>Name&nbsp;</th>
                        <th><input type="text" name="name" value="{{ $genre->name }}"></th>
                    <tr>
                </table>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <span class="pull-right">
                <button type="submit" class="btn btn-primary">Modify</button>
            </span>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal fade" id="removeGenreModal{{ $genre->id }}" tabindex="-1" role="dialog" aria-labelledby="removeGenreModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <form method="POST" action="{{ action('GenreController@remove') }}">
            {{ csrf_field() }}

            <input type="hidden" name="genre_id" value="{{ $genre->id }}">

            <div class="modal-header">
            
            <h4 class="modal-title" id="removeGenreModalLabel">Remove Genre</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body write-pub">
            Are you sure you want to delete this genre?
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <span class="pull-right">
                <button type="submit" class="btn btn-primary">Delete</button>
            </span>
            </div>
        </form>
        </div>
    </div>
</div>

@endforeach

@if (count($genres) != 0)
<span class="link-pagination">
    {{ $genres->links() }}
</span>
@endif