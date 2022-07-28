<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alcaldia extends Model
{
    use HasFactory;

  protected $fillable = [
    'codigo_postal',
    'superficie_terreno',
    'superficie_construccion',
    'uso_construccion',
    'valor_unitario',
    'valor_suelo',
    'subsidio'
  ];
}
