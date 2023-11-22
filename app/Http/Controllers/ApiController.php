<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ApiResource;
use App\Models\Food;
use App\Models\Review;

class ApiController extends Controller
{
  public function getFoods()
  {
    $foods = Food::all();
    return ApiResource::collection($foods);
  }

  public function searchFoods(Request $request)
  {
    $search = $request->search;
    $foods = Food::where('name', 'LIKE', '%' . $search . '%')->get();
    return ApiResource::collection($foods);
  }

  public function topReviewFood()
  {
    $reviews = Review::where('taste', '=', '3')->orWhere('portion', '=', '3')->get();
    $foods = [];
    foreach ($reviews as $review) {
      $food = Food::where('id', '=', $review->food_id)->first();
      if ($food) {
        $foods[] = $food;
      }
    }

    return ApiResource::collection($foods);
  }
}
