<?php

namespace App\Livewire;

use App\Models\Food;
use App\Models\Review;
use Livewire\Component;

class Homepage extends Component
{
  public $foods;
  public $reviews = [];

  public function mount()
  {
    $this->foods = Food::get();
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
}
