
<h2>List of Messages</h2>

<hr>

<div class="pagination-element-box-non-style">
    <form id="order-form" method="GET" action="{{ action('MessageController@listMessages') }}">
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

@if (count($messages) != 0)
<span class="link-pagination">
    {{ $messages->links() }}
</span>
@endif

@foreach ($messages as $message)
<div class="pagination-element-box-style">
    <div class="pagination-content-wrapper">
        <p>Id: {{ $message->id }}</p>
        <p>From: {{ $message->user->email }}</p>
        <p>To: 
        @foreach ($message->user_receive()->get() as $member)
        {{ $member->email }}
        @if (!$loop->last)
        , 
        @endif
        @endforeach
        </p>
        <p>Title: {{ $message->title }}</p>
        <p>Body of Message: {{ $message->text }}</p>
        @if ($message->created_at != $message->updated_at)
        <p style="text-align: right;">Updated at: {{ $message->updated_at }}</p>
        @endif
        <p style="text-align: right;">Created at: {{ $message->created_at }}</p>
    </div>
</div>

<div class="pagination-actions">
    <a href="#" data-id="{{ $message->id }}" data-title="Delete Message" data-toggle="modal" data-target="#removeMessageModal{{ $message->id }}">Delete</a>
</div>

<div class="modal fade" id="removeMessageModal{{ $message->id }}" tabindex="-1" role="dialog" aria-labelledby="removeMessageModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <form method="POST" action="{{ action('MessageController@delete') }}">
            {{ csrf_field() }}

            <input type="hidden" name="message_id" value="{{ $message->id }}">

            <div class="modal-header">
            
            <h4 class="modal-title" id="removeMessageModalLabel">Remove Message</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
            <div class="modal-body write-pub">
            Are you sure you want to delete this message?
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

@if (count($messages) != 0)
<span class="link-pagination">
    {{ $messages->links() }}
</span>
@endif