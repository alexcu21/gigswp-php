<header class="bg-blue-900 text-white p-4">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-3xl font-semibold">
            <a href="{{ route('home') }}">GIGSWP</a>
        </h1>
        <nav class="space-x-4">
            @auth
                <a href="{{ route('profile.edit') }}" class="text-white hover:underline">{{ auth()->user()->name }}</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-white hover:underline">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-white hover:underline">Login</a>
                <a href="{{ route('register') }}" class="text-white hover:underline">Register</a>
            @endauth
            <a href="{{ route('listings.create') }}"
               class="bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded hover:shadow-md transition duration-300">
                <i class="fa fa-edit"></i> Post a Job
            </a>
        </nav>
    </div>
</header>
