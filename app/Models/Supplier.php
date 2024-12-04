<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'supplier';  // Nama tabel

    protected $fillable = [
        'name',
        'telp',
        'address',
        'created_at',
        'updated_at',
    ];

    
}
