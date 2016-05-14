@if (session()->has('success'))
<div class="message-box bg-success">
    {{ session('success') }}
</div>
@endif

@if (session()->has('error'))
<div class="message-box bg-danger">
    {{ session('error') }}
</div>
@endif   