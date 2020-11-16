<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;


    /**
     * Returns widget
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function widget()
    {
        return $this->belongsTo(Widget::class);
    }

    /**
     * Decode data json
     *
     * @param $value
     * @return mixed
     */
    public function getDataAttribute($value) {
        return json_decode($value);
    }
}
