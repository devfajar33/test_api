<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiModel extends Model
{
    use HasFactory;
    public $incrementing = false;

    protected $fillable = ['title', 'content'];

    public function details()
    {
        return $this->hasMany(ApiDetailModel::class, 'parent_id', 'id');
    }

    public function toArray()
    {
        $array = parent::toArray();
        $array['details'] = $this->details()->get()->toArray();
        return $array;
    }
}
