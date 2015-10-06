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

namespace Zapoyok\ExtraFormBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Zapoyok\ExtraFormBundle\KeyValueContainer;

class HashToKeyValueArrayTransformer implements DataTransformerInterface
{
    private $useContainerObject;

    /**
     * @param bool $useContainerObject Whether to return a KeyValueContainer object or simply an array
     */
    public function __construct($useContainerObject)
    {
        $this->useContainerObject = $useContainerObject;
    }

    /**
     * Doing the transformation here would be too late for the collection type to do it's resizing magic, so
     * instead it is done in the forms PRE_SET_DATA listener.
     */
    public function transform($value)
    {
        return $value;
    }

    /**
     * @param mixed $value
     *
     * @throws \Symfony\Component\Form\Exception\TransformationFailedException
     *
     * @return KeyValueContainer|array
     */
    public function reverseTransform($value)
    {
        $return = $this->useContainerObject ? new KeyValueContainer() : [];

        foreach ($value as $data) {
            if (['key', 'value'] != array_keys($data)) {
                throw new TransformationFailedException();
            }

            if (array_key_exists($data['key'], $return)) {
                throw new TransformationFailedException('Duplicate key detected');
            }

            $return[$data['key']] = $data['value'];
        }

        return $return;
    }
}
