<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Image
 * 
 * This class represents an image model.
 */
class ImageLora extends Pivot
{
    public function lora(): BelongsTo
    {
        return $this->belongsTo(Lora::class);
    }
    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class);
    }

}
