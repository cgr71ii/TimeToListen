<h2>My Publications</h2>
<span class="link-pagination">{{ session('publications')->links() }}</span>
@foreach (session('publications') as $pub)
<div class="publication">
    <div class="publication-text-wrapper">
        <p>{{ $pub->text }}</p>
        <p style="text-align: right;">{{ $pub->date }}</p>
    </div>
</div>
<div class="publication-actions">
    <form method="POST" id="pub{{ $pub->id }}" action="{{ action('UserController@removePublication') }}">
        {{ csrf_field() }}
        <input type="hidden" name="publication_id" value="{{ $pub->id }}">
        <a href="javascript:{}" onclick="document.getElementById('pub{{ $pub->id }}').submit(); return false;">Delete</a>
    </form>
</div>
@endforeach
<span class="link-pagination">{{ session('publications')->links() }}</span>