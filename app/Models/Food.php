<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
  use HasFactory;

  protected $guarded = [];

  public function getLinks(): array
  {
    $baseUri = '/api/foods/' . $this->id;
    
    return [
      'self' => [
        'href' => $baseUri,
        'method' => 'GET',
        'type' => 'application/json',
        'description' => 'Get food details',
      ],
      'update' => [
        'href' => $baseUri . '/update',
        'method' => 'PUT',
        'type' => 'application/json',
        'description' => 'Update food details',
      ],
      'delete' => [
        'href' => $baseUri . '/delete',
        'method' => 'DELETE',
        'type' => 'application/json',
        'description' => 'Delete food',
      ],
    ];
  }
}
