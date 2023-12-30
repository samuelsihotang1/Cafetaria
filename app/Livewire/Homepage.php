<?php

namespace App\Livewire;

use App\Models\Food;
use App\Models\Review;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Homepage extends Component
{
  use WithFileUploads;

  public $foods;
  public $reviews = [];

  public $foodTitle;
  public $foodImage;

  public $openCreate = false;

  protected $rules = [
    'foodImage' => 'required|image|max:2048',
    'foodTitle' => 'required|string|max:100',
  ];

  public function updatedFoodImage()
  {
    $this->validateOnly('foodImage');
  }

  public function deleteImage()
  {
    $this->foodImage = NULL;
  }

  public function updatedFoodTitle()
  {
    $this->validateOnly('foodTitle');
  }

  public function boot()
  {
    $this->foods = Food::orderBy('created_at', 'desc')->get();
    foreach ($this->foods as $food) {
      $this->reviews[$food->id] = Review::where('user_id', '=', auth()->user()->id)->where('food_id', '=', $food->id)->first();
    }
  }

  public function render()
  {
    return view('homepage')->title('Homepage');
  }

  public function reviewTaste(Food $food, $total)
  {
    if (isset($this->reviews[$food->id])) {
      $this->reviews[$food->id]->taste = $total;
      $this->reviews[$food->id]->save();
    } else {
      $this->reviews[$food->id] =
        Review::create([
          'user_id' => auth()->user()->id,
          'food_id' => $food->id,
          'taste' => $total,
        ]);
    }
  }

  public function reviewPortion(Food $food, $total)
  {
    if (isset($this->reviews[$food->id])) {
      $this->reviews[$food->id]->portion = $total;
      $this->reviews[$food->id]->save();
    } else {
      $this->reviews[$food->id] =
        Review::create([
          'user_id' => auth()->user()->id,
          'food_id' => $food->id,
          'portion' => $total,
        ]);
    }
  }

  public function deleteFood(Food $food)
  {
    $food->delete();
    $this->boot();
  }

  public function createFood()
  {
    $this->validate([
      'foodImage' => 'required|image|max:2048', // Maksimum 2MB
    ], [
      'foodImage.required' => 'Gambar gagal diupload, ukurannya terlalu besar.',
      'foodImage.image' => 'File harus berupa gambar.',
      'foodImage.max' => 'Ukuran gambar terlalu besar.',
    ]);

    Food::create([
      'name' => $this->foodTitle,
      'name_slug' => Str::of($this->foodTitle)->slug('-'),
      'image' => $this->storeDocument(),
      'created_at' => now(),
      'updated_at' => now(),
    ]);

    $this->foodTitle = NULL;
    $this->foodImage = NULL;
    $this->openCreate = false;

    $this->boot();
  }

  public function storeDocument()
  {
    $documentName = auth()->user()->name_slug . Str::of($this->foodTitle)->slug('-') . '.' . $this->foodImage->getClientOriginalExtension();
    $documentPath = 'public/imgFood/';
    $this->foodImage->storeAs($documentPath, $documentName);
    return $documentName;
  }
}
