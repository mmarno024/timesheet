<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
  
class Trs_d_image extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $connection = 'mysql';
    protected $dates = ['deleted_at'];
    protected $table = 'trs_d_image';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'h_id',
        'filename',
        'path',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $hidden = [
        'deleted_at'
    ];
  
    /**
     * Set the user's first name.
     *
     * @param  string  $value
     * @return void
     */
    public function setFilenamesAttribute($value)
    {
        $this->attributes['filename'] = json_encode($value);
    }
}