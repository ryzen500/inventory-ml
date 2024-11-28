<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOpname extends Model
{
    use HasFactory;

    protected $table = 'stock_opnames';  // Nama tabel

    protected $fillable = [
        'location_id',
        'product_id',
        'system_quantity',
        'counted_quantity',
        'difference',
        'created_at',
    ];

    // Relasi dengan tabel Location
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }

    // Relasi dengan tabel Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
