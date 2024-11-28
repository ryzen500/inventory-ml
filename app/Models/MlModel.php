<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MlModel extends Model
{
    use HasFactory;

    protected $table = 'ml_models';
    public $incrementing = false;
    protected $keyType = 'uuid';
    protected $fillable = ['id', 'name', 'version', 'created_at', 'updated_at'];

    public function trainingLogs()
    {
        return $this->hasMany(MlTrainingLog::class, 'model_id');
    }
}

?>