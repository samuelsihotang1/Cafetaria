<?php

namespace App\Livewire;

use Livewire\Component;

class Homepage extends Component
{
  public function render()
  {
    return view('homepage')->title('Homepage');
  }
}
