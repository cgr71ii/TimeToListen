
<h2>Log</h2>

<hr>

@if (count($logs) != 0)
<span class="link-pagination">
    {{ $logs->links() }}
</span>
@endif

@foreach ($logs as $log)
<div class="pagination-element-box-style">
    <div class="pagination-content-wrapper">
        <p>Id: {{ $log->id }}</p>
        <p>Email: {{ $log->email }}</p>
        <p>Type of User: {{ $log->typeOfUser }}</p>
        <p>Ip: {{ $log->ip }}</p>
        <p>Unix Time: {{ $log->unixTime }}</p>
        <p>Time: {{ gmdate("Y-m-d H:i:s", $log->unixTime) }}</p>
        <p>Description:</p>
        <p style="word-wrap: break-word;">{{ $log->description }}</p>
    </div>
</div>

@endforeach

@if (count($logs) != 0)
<span class="link-pagination">
    {{ $logs->links() }}
</span>
@endif