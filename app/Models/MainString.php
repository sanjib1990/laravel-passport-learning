<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MainString
 *
 * @package App\Models
 */
class MainString extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function main()
    {
        return $this->belongsTo(Main::class);
    }
}
