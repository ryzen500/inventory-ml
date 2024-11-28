<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventory';
    public $incrementing = false;
    protected $keyType = 'uuid';
    protected $fillable = [
        'id', 'product_id', 'location_id', 'quantity', 
        'reserved_quantity', 'available_quantity', 'updated_at'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
}

?>