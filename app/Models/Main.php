<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Main
 *
 * @package App\Models
 */
class Main extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['main'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function mainid()
    {
        return $this->hasOne(MainId::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function mainstring()
    {
        return $this->hasOne(MainString::class);
    }

    /**
     * Get list of mains.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Collection
     */
    public function getList(array $data)
    {
        if (array_get($data, 'paginate', true) == 0) {
            return $this->get();
        }

        return $this->paginate(array_get($data, 'count', 10));
    }
}
