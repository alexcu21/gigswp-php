@if (session('success'))
    <div class="message bg-green-500 text-white p-3 my-3">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="message bg-red-500 text-white p-3 my-3">
        {{ session('error') }}
    </div>
@endif
