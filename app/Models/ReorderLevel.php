<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReorderLevel extends Model
{
    use HasFactory;

    protected $table = 'reorder_levels';  // Nama tabel

    protected $fillable = [
        'product_id',
        'minimum_quantity',
        'maximum_quantity',
        'reorder_point',
        'created_at',
        'updated_at',
    ];

    // Relasi dengan tabel Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}

?>