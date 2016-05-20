<?php
namespace Norm\Type;

use ROH\Util\Collection;
use JsonKit\JsonKit;
use Norm\Type\Marshallable;

/**
 * Collection abstract class.
 *
 * @author    Ganesha <reekoheek@gmail.com>
 * @copyright 2016 PT Sagara Xinix Solusitama
 * @link      http://sagara.id/p/product Norm
 * @license   https://raw.github.com/xinix-technology/norm/master/LICENSE
 */
class ArrayList extends Collection implements Marshallable
{
    /**
     * {@inheritDoc}
     */
    public function __construct($attributes = null)
    {
        parent::__construct($attributes);

        $this->attributes = array_values($this->attributes);
    }

    /**
     * Add an items to a collection
     *
     * @param mixed $object
     */
    public function add($object)
    {
        $this->attributes[] = $object;
    }

    /**
     * {@inheritDoc}
     */
    public function has($object)
    {
        return in_array($object, $this->attributes);
    }

    /**
     * {@inheritDoc}
     */
    public function offsetSet($key, $value)
    {
        if (! is_int($key)) {
            $this->attributes[] = $value;
        } else {
            $this->attributes[$key] = $value;
        }
    }

    public function marshall()
    {
        return JsonKit::encode($this->toArray());
    }
}