<?php

/*
 * This file is part of the Zapoyok project.
 *
 * (c) Jérôme Fix <jerome.fix@zapoyok.info>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * See : src/Resources/meta/LICENSE
 */

namespace Zapoyok\ExtraFormBundle;

class KeyValueContainer implements \ArrayAccess
{
    private $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function toArray()
    {
        return $this->data;
    }

    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->data);
    }

    public function offsetGet($offset)
    {
        return $this->data[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->data[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }
}
