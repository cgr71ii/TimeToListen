
<h2>List of Publications</h2>

<hr>

<div class="pagination-element-box-non-style">
  <form id="order-form" method="GET" action="{{ action('PublicationController@listPublications') }}">
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

<hr>

<div class="pagination-element-box-non-style">
  <form id="find-form" method="GET" action="{{ action('PublicationController@listPublications') }}">
    {{ csrf_field() }}
    <p>Publication contains <input type="text" name="pub_contains"></p>
    <p>
      Publication between <input type="date" name="min_date"> and <input type="date" name="max_date">
      <div class="row">
        <div class="col-md-9 offset-md-1">
          <div>
            (<input type="radio" name="date_field" value="created_at" checked>Created 
            <input type="radio" name="date_field" value="updated_at">Updated)
          </div>
        </div>
      </div>
    </p>
    <p>
      Order by 
      <select name="field" form="find-form">
        <option value="created_at">Created At</option>
        <option value="updated_at">Updated At</option>
      </select>

      <select name="direction" form="find-form">
        <option value="asc">Ascendent</option>
        <option value="desc">Descendent</option>
      </select>
    </p>

    <input type="hidden" name="find-form">
    <input type="submit" value="Find">
  </form>
</div>

<hr>

<span class="link-pagination">
  {{ $publications->links() }}
</span>

@foreach ($publications as $pub)
<div class="pagination-element-box-style">
    <div class="pagination-content-wrapper">
        <p>User: {{ $pub->user->email }}</p>
        <hr>
        @if ($pub->group_id != 0 && $pub->group !== null)
        <p>Group: {{ $pub->group->name }}</p>
        <hr>
        @endif
        <p>{{ $pub->text }}</p>
        @if ($pub->created_at != $pub->updated_at)
        <p style="text-align: right;">Updated at: {{ $pub->updated_at }}</p>
        @endif
        <p style="text-align: right;">Created at: {{ $pub->created_at }}</p>
    </div>
</div>

<div class="pagination-actions">
  <a href="#" data-id="{{ $pub->id }}" data-title="Modify Publication" data-toggle="modal" data-target="#modifyPublicationModal{{ $pub->id }}">Modify</a>
  <a href="#" data-id="{{ $pub->id }}" data-title="Delete Publication" data-toggle="modal" data-target="#removePublicationModal{{ $pub->id }}">Delete</a>
</div>

<div class="modal fade" id="modifyPublicationModal{{ $pub->id }}" tabindex="-1" role="dialog" aria-labelledby="modifyPublicationModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="POST" action="{{ action('UserController@modifyPublication') }}">
        {{ csrf_field() }}

        <input type="hidden" name="publication_id" value="{{ $pub->id }}">

        <div class="modal-header">
          
          <h4 class="modal-title" id="modifyPublicationModalLabel">Modify Publication</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body write-pub">
          <p>Insert the new publication</p>
          <textarea style="resize: none; width: 100%;" name="publication">{{ $pub->text }}</textarea>
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

<div class="modal fade" id="removePublicationModal{{ $pub->id }}" tabindex="-1" role="dialog" aria-labelledby="removePublicationModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="POST" action="{{ action('PublicationController@delete') }}">
        {{ csrf_field() }}

        <input type="hidden" name="publication_id" value="{{ $pub->id }}">

        <div class="modal-header">
          
          <h4 class="modal-title" id="removePublicationModalLabel">Remove Publication</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body write-pub">
          Are you sure you want to delete this publication?
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

<span class="link-pagination">
  {{ $publications->links() }}
</span>
