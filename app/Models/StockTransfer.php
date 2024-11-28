<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockTransfer extends Model
{
    use HasFactory;

    protected $table = 'stock_transfers';  // Nama tabel

    protected $fillable = [
        'from_location_id',
        'to_location_id',
        'product_id',
        'quantity',
        'status',
        'created_at',
        'updated_at',
    ];

    // Relasi dengan tabel Location (From)
    public function fromLocation()
    {
        return $this->belongsTo(Location::class, 'from_location_id', 'id');
    }

    // Relasi dengan tabel Location (To)
    public function toLocation()
    {
        return $this->belongsTo(Location::class, 'to_location_id', 'id');
    }

    // Relasi dengan tabel Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
