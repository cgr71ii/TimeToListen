
<h2>List of Songs</h2>

<hr>

<div class="pagination-element-box-non-style">
    <form id="order-form" method="GET" action="{{ action('SongController@listSongs') }}">
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

@if (count($songs) != 0)
<span class="link-pagination">
    {{ $songs->links() }}
</span>
@endif

@foreach ($songs as $song)
<div class="pagination-element-box-style">
    <div class="pagination-content-wrapper">
        <p>Id: {{ $song->id }}</p>
        <p>Name: {{ $song->name }}</p>
        @if ($song->created_at != $song->updated_at)
        <p style="text-align: right;">Updated at: {{ $song->updated_at }}</p>
        @endif
        <p style="text-align: right;">Created at: {{ $song->created_at }}</p>
    </div>
</div>

<div class="pagination-actions">
    <a href="#" data-id="{{ $song->id }}" data-title="Modify Song" data-toggle="modal" data-target="#modifySongModal{{ $song->id }}">Modify</a>
    <a href="#" data-id="{{ $song->id }}" data-title="Delete Song" data-toggle="modal" data-target="#removeSongModal{{ $song->id }}">Delete</a>
</div>

<div class="modal fade" id="modifySongModal{{ $song->id }}" tabindex="-1" role="dialog" aria-labelledby="modifySongModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <form method="POST" action="{{ action('SongController@update') }}">
            {{ csrf_field() }}

            <input type="hidden" name="song_id" value="{{ $song->id }}">

            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="modifySongModalLabel">Modify Song</h4>
            </div>
            <div class="modal-body write-pub">
            <p>Changing {{ $song->name }} Song</p>
                <table style="margin: 0 auto;">
                    <tr>
                        <th>Name&nbsp;</th>
                        <th><input type="text" name="name" value="{{ $song->name }}"></th>
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

<div class="modal fade" id="removeSongModal{{ $song->id }}" tabindex="-1" role="dialog" aria-labelledby="removeSongModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <form method="POST" action="{{ action('SongController@removeSong') }}">
            {{ csrf_field() }}

            <input type="hidden" name="song_id" value="{{ $song->id }}">

            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="removeSongModalLabel">Remove Song</h4>
            </div>
            <div class="modal-body write-pub">
            Are you sure you want to delete this song?
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

@if (count($songs) != 0)
<span class="link-pagination">
    {{ $songs->links() }}
</span>
@endif