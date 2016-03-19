<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class League extends Model
{
    protected $table = 'leagues';

    protected $guarded = ['id'];

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return HasMany
     */
    public function matches()
    {
        return $this->hasMany('App\Models\Match');
    }

    /**
     * @param string $name
     *
     * @return League
     */
    public static function make($name = '')
    {
        return new static([
            'name' => $name
        ]);
    }
}
