<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * Get all of the product's photos.
     */
    public function pictures()
    {
        return $this->morphMany(Picture::class, 'imageable');
    }
}
