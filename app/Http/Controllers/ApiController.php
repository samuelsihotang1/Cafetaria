<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ApiResource;
use App\Models\Food;
use App\Models\Review;
use App\Models\User;
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

  public function deleteFoods($id): JsonResponse
  {
    Food::destroy($id);
    return response()->json([
      'info' => 'Makanan telah dihapus'
    ]);
  }







  public function getUsers(): JsonResponse
  {
    return response()->json([
      'users' => User::all()->map(function ($user) {
        return [
          'users' => $user,
          'links' => $user->getLinks(),
        ];
      }),
    ]);
  }

  public function searchUsers($id): JsonResponse
  {
    return response()->json([
      'users' => $users = User::findOrFail($id),
      'links' => $users->getLinks(),
    ]);
  }

  public function deleteUsers($id): JsonResponse
  {
    User::destroy($id);
    return response()->json([
      'info' => 'User telah dihapus'
    ]);
  }



  public function getReviews(): JsonResponse
  {
    return response()->json([
      'reviews' => Review::all()->map(function ($review) {
        return [
          'reviews' => $review,
          'links' => $review->getLinks(),
        ];
      }),
    ]);
  }

  public function searchReviews($id): JsonResponse
  {
    return response()->json([
      'reviews' => $reviews = Review::findOrFail($id),
      'links' => $reviews->getLinks(),
    ]);
  }

  public function deleteReviews($id): JsonResponse
  {
    Review::destroy($id);
    return response()->json([
      'info' => 'Review telah dihapus'
    ]);
  }
}
