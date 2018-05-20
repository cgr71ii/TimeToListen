
<h2>List of Groups</h2>

<hr>

<div class="pagination-element-box-non-style">
    <form id="order-form" method="GET" action="{{ action('GroupController@listGroups') }}">
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

@if (count($groups) != 0)
<span class="link-pagination">
    {{ $groups->links() }}
</span>
@endif

@foreach ($groups as $group)
<div class="pagination-element-box-style">
    <div class="pagination-content-wrapper">
        <p>Id: {{ $group->id }}</p>
        <p>Creator: {{ $group->creator()->first()->email }}</p>
        <p>Name: {{ $group->name }}</p>
        <p>Users: 
        @foreach($group->users()->get() as $member)
        {{ $member->email }}
        @if (!$loop->last)
        , 
        @endif
        @endforeach
        </p>
        @if ($group->created_at != $group->updated_at)
        <p style="text-align: right;">Updated at: {{ $group->updated_at }}</p>
        @endif
        <p style="text-align: right;">Created at: {{ $group->created_at }}</p>
    </div>
</div>

<div class="pagination-actions">
    <a href="#" data-id="{{ $group->id }}" data-title="Delete Group" data-toggle="modal" data-target="#removeGroupModal{{ $group->id }}">Delete</a>
</div>

<div class="modal fade" id="removeGroupModal{{ $group->id }}" tabindex="-1" role="dialog" aria-labelledby="removeGroupModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <form method="POST" action="{{ action('GroupController@delete') }}">
            {{ csrf_field() }}

            <input type="hidden" name="group_id" value="{{ $group->id }}">

            <div class="modal-header">
            
            <h4 class="modal-title" id="removeGroupModalLabel">Remove Group</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
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

@if (count($groups) != 0)
<span class="link-pagination">
    {{ $groups->links() }}
</span>
@endif