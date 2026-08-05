@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="message bg-red-100 p-3 my-3">
            {{ $error }}
        </div>
    @endforeach
@endif
