<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';  // Nama tabel

    protected $fillable = [
        'name',
        'sku',
        'category',
        'weight',
        'dimensions',
        'created_at',
        'updated_at',
    ];

    // Relasi dengan tabel Inventory
    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'product_id', 'id');
    }

    // Relasi dengan tabel ReorderLevel
    public function reorderLevels()
    {
        return $this->hasOne(ReorderLevel::class, 'product_id', 'id');
    }

    // Relasi dengan tabel Scrap
    public function scraps()
    {
        return $this->hasMany(Scrap::class, 'product_id', 'id');
    }

    // Relasi dengan tabel StockOpname
    public function stockOpnames()
    {
        return $this->hasMany(StockOpname::class, 'product_id', 'id');
    }

    // Relasi dengan tabel StockTransfer
    public function stockTransfers()
    {
        return $this->hasMany(StockTransfer::class, 'product_id', 'id');
    }

    // Relasi dengan tabel ML Datasets
    public function mlDatasets()
    {
        return $this->hasMany(MlDataset::class, 'product_id', 'id');
    }
}
