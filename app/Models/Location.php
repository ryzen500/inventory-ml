<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $table = 'locations';  // Nama tabel

    protected $fillable = [
        'code',
        'description',
        'capacity',
        'created_at',
        'updated_at',
    ];

    // Relasi dengan tabel Inventory
    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'location_id', 'id');
    }

    // Relasi dengan tabel StockOpname
    public function stockOpnames()
    {
        return $this->hasMany(StockOpname::class, 'location_id', 'id');
    }

    // Relasi dengan tabel StockTransfer (From)
    public function stockTransfersFrom()
    {
        return $this->hasMany(StockTransfer::class, 'from_location_id', 'id');
    }

    // Relasi dengan tabel StockTransfer (To)
    public function stockTransfersTo()
    {
        return $this->hasMany(StockTransfer::class, 'to_location_id', 'id');
    }
}
