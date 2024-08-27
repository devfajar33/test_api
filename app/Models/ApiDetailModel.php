<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiDetailModel extends Model
{
    use HasFactory;
    public $incrementing = false;

    public function details()
    {
        return $this->hasMany(ApiAnswerMonthModel::class, 'parent_id', 'id');
    }

    public function details_q()
    {
        return $this->hasMany(ApiAnswerQuarterModel::class, 'parent_id', 'id');
    }

    public function toArray()
    {
        $array = parent::toArray();
        $array['answer'] = $this->details()->get()->toArray();
        return $array;
    }
}
