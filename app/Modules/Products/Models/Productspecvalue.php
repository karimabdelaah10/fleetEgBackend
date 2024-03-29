<?php

namespace App\Modules\Products\Models;

use App\Modules\BaseApp\Traits\HasAttach;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class  Productspecvalue extends Model
{
    use HasFactory,HasAttach;
    protected $table='productspecvalues';
    protected $fillable =['stock' , 'image','product_id',
        'parent_spec_value_id','spec_id','spec_value_id'];


    protected static $attachFields = [
        'image' => [
            'sizes' => ['small' => 'resize,300x300', 'large' => 'resize,600x600'],
            'path' => 'storage/uploads'
        ],
    ];

    public function value(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Specvalue::class ,'spec_value_id');
    }

    public function spec(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Spec::class ,'spec_id');
    }

    public function parent()
    {
        return $this->belongsTo(Productspecvalue::class ,'parent_spec_value_id');
    }

}
