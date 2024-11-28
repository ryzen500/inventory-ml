<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MlPrediction extends Model
{
    use HasFactory;

    protected $table = 'ml_predictions';
    public $incrementing = false;
    protected $keyType = 'uuid';
    protected $fillable = ['id', 'dataset_id', 'predicted_demand', 'prediction_date', 'created_at', 'updated_at'];

    public function dataset()
    {
        return $this->belongsTo(MlDataset::class, 'dataset_id');
    }
}

?>