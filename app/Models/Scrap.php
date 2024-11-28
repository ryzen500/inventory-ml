<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scrap extends Model
{
    use HasFactory;

    protected $table = 'scrap';  // Nama tabel

    protected $fillable = [
        'product_id',
        'quantity',
        'reason',
        'created_at',
    ];

    // Relasi dengan tabel Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
