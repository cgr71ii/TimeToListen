<h2>My Publications</h2>
<span class="link-pagination">{{ session('publications')->links() }}</span>
@foreach (session('publications') as $pub)
<div class="publication">
    <div class="publication-text-wrapper">
        <p>{{ $pub->text }}</p>
        <p style="text-align: right;">{{ $pub->date }}</p>
    </div>
</div>
@endforeach
<span class="link-pagination">{{ session('publications')->links() }}</span>