<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ApiResource;
use App\Models\Food;

class ApiController extends Controller
{
  public function getFoods()
  {
    $foods = Food::all();
    return ApiResource::collection($foods);
  }
}
