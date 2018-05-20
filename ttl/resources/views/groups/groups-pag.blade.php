<div class="pagination-element-box-non-style">
    <form id="order-form" method="GET" action="{{ action('GroupController@show') }}">
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

@if (count($groups) != 0)
<span class="link-pagination">
    {{ $groups->links() }}
</span>
@endif


        @foreach ($groups as $group)
        <hr>
            
            <form method="GET" name="group{{ $group->id }}" action="{{ action('GroupController@groupPublications') }}">
                <input type="hidden" name="group_id" value="{{ $group->id }}">

                <a href="#" onclick="group{{ $group->id }}.submit();">{{ $group->name }}</a>
            </form>
                @if ($group->creator_id == session('user')->id)
                <a href="#" data-id="{{ $group->id }}" data-title="Delete Group" style="color: red" data-toggle="modal" data-target="#removeGroupModal{{ $group->id }}">Remove</a>
                @else
                <a href="#" data-id="{{ $group->id }}" data-title="Delete Group" style="color: red" data-toggle="modal" data-target="#removeGroupModal{{ $group->id }}">Leave</a>
                @endif


        <div class="modal fade" id="removeGroupModal{{ $group->id }}" tabindex="-1" role="dialog" aria-labelledby="removeGroupModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <form method="POST" action="{{ action('GroupController@exit', ['id' => $group->id]) }}">
                    {{ csrf_field() }}

                    <input type="hidden" name="group_id" value="{{ $group->id }}">

                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="removeGroupModalLabel"></h4>
                    </div>
                    <div class="modal-body write-pub">
                    Are you sure you want to delete this group?
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

<hr>

@if (count($groups) != 0)
<span class="link-pagination">
    {{ $groups->links() }}
</span>
@endif