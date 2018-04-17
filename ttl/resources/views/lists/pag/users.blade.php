
<div class="pagination-element-box-non-style">
    <form id="order-form" method="GET" action="{{ action('UserController@listUsers') }}">
        {{ csrf_field() }}
        <select name="field" form="order-form">
            <option value="created_at">Created At</option>
            <option value="updated_at">Updated At</option>
            <option value="name">Name</option>
            <option value="lastname">Lastname</option>
            <option value="email">Email</option>
            <option value="birthday">Birthday</option>
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
    <form id="find-form" method="GET" action="{{ action('UserController@listUsers') }}">
        {{ csrf_field() }}
        <p>Email contains <input type="text" name="email_contains"></p>
        <p>Years between <input type="number" name="min_age" min="0" max="150" style="width: 70px;"> and <input type="number" name="max_age" min="0" max="150" style="width: 70px;"></p>
        <p>
            Order by 
            <select name="field" form="find-form">
                <option value="created_at">Created At</option>
                <option value="name">Name</option>
                <option value="lastname">Lastname</option>
                <option value="email">Email</option>
                <option value="birthday">Birthday</option>
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

@if (count($users) != 0)
<span class="link-pagination">
    {{ $users->links() }}
</span>
@endif

@foreach ($users as $user)
<div class="pagination-element-box-style">
    <div class="pagination-content-wrapper">
        <p>Id: {{ $user->id }}</p>
        <p>Name: {{ $user->name }}</p>
        <p>Lastname: {{ $user->lastname }}</p>
        <p>Email: {{ $user->email }}</p>
        <p>Password: {{ str_repeat('*', strlen($user->password)) }}</p>
        <p>Birthday: {{ substr($user->birthday, 0, 10) }}</p>
        @if ($user->song_status !== null)
        <p>Status Id Song: {{ $user->song_status->id }}</p>
        @else
        <p>Status Id Song: No Song Selected</p>
        @endif
        @if ($user->created_at != $user->updated_at)
        <p style="text-align: right;">Updated at: {{ $user->updated_at }}</p>
        @endif
        <p style="text-align: right;">Created at: {{ $user->created_at }}</p>
    </div>
</div>

<div class="pagination-actions">
    <a href="#" data-id="{{ $user->id }}" data-title="Modify User" data-toggle="modal" data-target="#modifyUserModal{{ $user->id }}">Modify</a>
    <a href="#" data-id="{{ $user->id }}" data-title="Delete User" data-toggle="modal" data-target="#removeUserModal{{ $user->id }}">Delete</a>
</div>

<div class="modal fade" id="modifyUserModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="modifyUserModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <form method="POST" action="{{ action('SettingsController@update') }}">
            {{ csrf_field() }}

            <input type="hidden" name="user_id" value="{{ $user->id }}">

            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="modifyUserModalLabel">Modify User</h4>
            </div>
            <div class="modal-body write-pub">
            <p>Changing {{ $user->email }}'s Informacion</p>
                <table style="margin: 0 auto;">
                    <tr>
                        <th>Name&nbsp;</th>
                        <th><input type="text" name="name" value="{{ $user->name }}"></th>
                    <tr>
                    <tr>
                        <th>Lastname&nbsp;</th>
                        <th><input type="text" name="lname" value="{{ $user->lastname }}"></th>
                    </tr>
                    <tr>
                        <th>Email&nbsp;</th>
                        <th><input type="email" name="username" value="{{ $user->email }}"></th>
                    </tr>
                    <tr>
                        <th>Password&nbsp;</th>
                        <th><input type="password" name="password" value="{{ $user->password }}"></th>
                    </tr>
                    <tr>
                        <th>Birthday&nbsp;</th>
                        <th><input type="date" name="birthday" style="width: 100%;" value="{{ substr($user->birthday, 0, 10) }}"></th>
                    </tr>
                    <tr>
                        <th>Song&nbsp;</th>
                        <th>
                            <select multiple name="status_song[]" style="width: 100%;">
                                @forelse ($user->song as $song)
                                @if (session('user')->song_status !== null && $song->id === session('user')->song_status->id)
                                <option value="{{ $song->id }}" selected>{{ $song->name }}</option>
                                @else
                                <option value="{{ $song->id }}">{{ $song->name }}</option>
                                @endif
                                @empty
                                <option value="empty">No Songs Available</option>
                                @endforelse
                            </select>
                        </th>
                    </tr>
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

<div class="modal fade" id="removeUserModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="removeUserModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <form method="POST" action="{{ action('UserController@remove') }}">
            {{ csrf_field() }}

            <input type="hidden" name="user_id" value="{{ $user->id }}">

            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="removeUserModalLabel">Remove Publication</h4>
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

@if (count($users) != 0)
<span class="link-pagination">
    {{ $users->links() }}
</span>
@endif