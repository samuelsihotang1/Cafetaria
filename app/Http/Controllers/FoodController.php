<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class FoodController extends Controller
{
  public function index(): JsonResponse
  {
    $foods = Food::all();
    $formattedFoods = $foods->map(function ($food) {
      return [
        'food' => $food,
        'links' => $food->getLinks(),
      ];
    });
    return response()->json([
      'foods' => $formattedFoods,
    ]);
  }

  public function show($id): JsonResponse
  {
    $food = Food::findOrFail($id);
    return response()->json([
      'food' => $food,
      'links' => $food->getLinks(),
    ]);
  }

  public function update(Request $request, $id): JsonResponse
  {
    $food = Food::findOrFail($id);
    $food->update($request->all());
    return response()->json([
      'message' => 'Food updated successfully',
      'food' => $food,
      'links' => $food->getLinks(),
    ]);
  }
  
  public function destroy($id): JsonResponse
  {
    $food = Food::findOrFail($id);
    $food->delete();
    return response()->json([
      'message' => 'Food deleted successfully',
    ]);
  }
}
