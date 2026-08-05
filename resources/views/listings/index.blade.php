@extends('layouts.site')

@section('content')
    @include('partials.top-banner')

    <section>
        <div class="container mx-auto p-4 mt-4">
            <div class="text-center text-3xl mb-4 font-bold border border-gray-300 p-3">All Jobs</div>
            @include('partials.message')
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                @forelse ($listings as $listing)
                    @include('partials.listing-card', ['listing' => $listing])
                @empty
                    <p class="col-span-3 text-center text-gray-600">No listings yet.</p>
                @endforelse
            </div>
        </div>
    </section>

    @include('partials.bottom-banner')
@endsection
