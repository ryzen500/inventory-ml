<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MlDataset extends Model
{
    use HasFactory;

    protected $table = 'ml_datasets';
    public $incrementing = false;
    protected $keyType = 'uuid';
    protected $fillable = ['id', 'product_id', 'date', 'demand', 'supply', 'price', 'season', 'created_at', 'updated_at'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}

?>