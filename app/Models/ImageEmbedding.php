<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Class Image
 * 
 * This class represents an image model.
 */
class ImageEmbedding extends Pivot
{
    public function embedding(): BelongsTo
    {
        return $this->belongsTo(Embedding::class);
    }
    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class);
    }

}
