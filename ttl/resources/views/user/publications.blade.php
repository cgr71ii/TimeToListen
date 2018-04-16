<h2>Publications</h2>
@if (session('publication_fail') !== null)
<div class="alert alert-danger">
    <strong>Error!</strong> Publication can not have empty fields!
</div>
@elseif (session('error_unexpected') !== null)
<div class="alert alert-danger">
    <strong>Error!</strong> Unexpected error!
</div>
@endif
<span class="link-pagination">{{ session(session('publication_session_name'))->links() }}</span>
@foreach (session(session('publication_session_name')) as $pub)
<div class="publication">
    <div class="publication-text-wrapper">
        <p>{{ $pub->text }}</p>
        <p style="text-align: right;">{{ $pub->date }}</p>
    </div>
</div>
@if (isset($actions) && $actions)
<div class="publication-actions">
  <a href="#" data-id="{{ $pub->id }}" data-title="Modify Publication" data-toggle="modal" data-target="#modifyPublicationModal{{ $pub->id }}">Modify</a>
  <a href="#" data-id="{{ $pub->id }}" data-title="Delete Publication" data-toggle="modal" data-target="#removePublicationModal{{ $pub->id }}">Delete</a>
</div>
@endif

<div class="modal fade" id="modifyPublicationModal{{ $pub->id }}" tabindex="-1" role="dialog" aria-labelledby="modifyPublicationModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="POST" action="{{ action('UserController@modifyPublication') }}">
        {{ csrf_field() }}

        <input type="hidden" name="publication_id" value="{{ $pub->id }}">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="modifyPublicationModalLabel">Modify Publication</h4>
        </div>
        <div class="modal-body write-pub">
          <p>Insert your new publication</p>
          <textarea name="publication">{{ $pub->text }}</textarea>
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
      <form method="POST" id="pub{{ $pub->id }}" action="{{ action('UserController@removePublication') }}">
        {{ csrf_field() }}

        <input type="hidden" name="publication_id" value="{{ $pub->id }}">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="removePublicationModalLabel">Remove Publication</h4>
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
<span class="link-pagination">{{ session(session('publication_session_name'))->links() }}</span>
