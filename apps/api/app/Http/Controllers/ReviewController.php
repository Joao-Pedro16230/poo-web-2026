<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Http\Requests\ReviewStoreRequest;
use App\Http\Requests\ReviewUpdateRequest;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Review::paginate();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReviewStoreRequest $request)
    {
        $data = $request->validated();

        $review = Review::create($data);

        return $review;
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        return $review;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        Review $review,
        ReviewUpdateRequest $request
    ) {
        $data = $request->validated();

        $review->update($data);

        return $review;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        $review->delete();

        return response()->noContent();
    }
}