<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreListingRequest;
use App\Http\Requests\UpdateListingRequest;
use App\Models\Listing;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ListingController extends Controller
{
    public function index(): View
    {
        $listings = Listing::query()->latest('id')->get();

        return view('listings.index', compact('listings'));
    }

    public function create(): View
    {
        return view('listings.create');
    }

    public function store(StoreListingRequest $request): RedirectResponse
    {
        $listing = Listing::create([
            ...$request->validated(),
            'user_id' => $request->user()->id,
        ]);

        return redirect()
            ->route('listings.show', $listing)
            ->with('success', 'Listing created successfully');
    }

    public function show(Listing $listing): View
    {
        return view('listings.show', compact('listing'));
    }

    public function edit(Listing $listing): View
    {
        return view('listings.edit', compact('listing'));
    }

    public function update(UpdateListingRequest $request, Listing $listing): RedirectResponse
    {
        $listing->update($request->validated());

        return redirect()
            ->route('listings.show', $listing)
            ->with('success', 'Listing updated successfully');
    }

    public function destroy(Listing $listing): RedirectResponse
    {
        $listing->delete();

        return redirect()
            ->route('listings.index')
            ->with('success', 'Listing deleted successfully');
    }
}
