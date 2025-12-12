<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Agrega esta línea para permitir guardar título y descripción:
    protected $fillable = ['title', 'description'];
}