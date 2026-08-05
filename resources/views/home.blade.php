@extends('layouts.site')

@section('content')
    @include('partials.showcase-searchbar')
    @include('partials.top-banner')

    <section>
        <div class="container mx-auto p-4 mt-4">
            <div class="text-center text-3xl mb-4 font-bold border border-gray-300 p-3">Recent Jobs</div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                @forelse ($listings as $listing)
                    @include('partials.listing-card', ['listing' => $listing])
                @empty
                    <p class="col-span-3 text-center text-gray-600">No listings yet.</p>
                @endforelse
            </div>
            <a href="{{ route('listings.index') }}" class="block text-xl text-center">
                <i class="fa fa-arrow-alt-circle-right"></i>
                Show All Jobs
            </a>
        </div>
    </section>

    @include('partials.bottom-banner')
@endsection
