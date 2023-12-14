<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ApiResource;
use App\Models\Food;
use App\Models\Review;
use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\URL;

class ApiController extends Controller
{

  public function getFoods(): JsonResponse
  {
    $foods = Food::all();
    $formattedFoods = $foods->map(function ($foods) {
      return [
        'food' => $foods,
        'links' => $foods->getLinks(),
      ];
    });
    return response()->json([
      'foods' => $formattedFoods,
    ]);
  }

  public function search($id): JsonResponse
  {
    $foods = Food::findOrFail($id);
    return response()->json([
      'food' => $foods,
      'links' => $foods->getLinks(),
    ]);
  }

  public function topReviewFood()
  {
    $reviews = Review::where('taste', '=', '3')->where('portion', '=', '3')->get();
    $foods = [];
    foreach ($reviews as $review) {
      $food = $review->food;
      if ($food) {
        $foods[] = $food;
      }
    }

    if (empty($foods)) {
      return response()->json([
        'message' => 'No foods found for the given criteria.',
      ]);
    }

    $formattedFoods = collect($foods)->map(function ($food) {
      return [
        'food' => $food,
        'links' => $food->getLinks(),
      ];
    });

    return response()->json([
      'foods' => $formattedFoods,
    ]);
  }
}
