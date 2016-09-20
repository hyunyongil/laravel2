<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    /**
     * picture 의 모든 소유자 모델 리턴
     */
    public function imageable()
    {
        return $this->morphTo();
    }
}
