<?php namespace App\Decorators;

use Illuminate\Database\Eloquent\Collection;

class SelectboxDecorator
{
    /**
     * @var Collection $collection
     */
    private $collection;

    /**
     * SelectboxDecorator constructor.
     *
     * @param Collection $collection
     */
    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

    /**
     * @param string $field
     * @param string $key
     *
     * @return array
     */
    public function prepare($field = 'name', $key = 'id')
    {
        $output = [];
        foreach ($this->collection as $item) {
            $output[$item->{$key}] = $item->{$field};
        }

        return $output;
    }
}