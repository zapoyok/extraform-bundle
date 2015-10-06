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

namespace Zapoyok\ExtraFormBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Zapoyok\ExtraFormBundle\Form\DataTransformer\HashToKeyValueArrayTransformer;

class KeyValueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer(new HashToKeyValueArrayTransformer($options['use_container_object']));

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $e) {
            $input = $e->getData();

            if (null === $input) {
                return;
            }

            $output = [];

            foreach ($input as $key => $value) {
                $output[] = [
                    'key'   => $key,
                    'value' => $value,
                ];
            }

            $e->setData($output);
        }, 1);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'type'                 => 'zapoyok_extraform_key_value_row',
            'allow_add'            => true,
            'allow_delete'         => true,
            'value_options'        => [],
            'allowed_keys'         => null,
            'use_container_object' => false,
            'options'              => function (Options $options) {
                return [
                    'value_type'    => $options['value_type'],
                    'value_options' => $options['value_options'],
                    'allowed_keys'  => $options['allowed_keys'],
                ];
            },
        ]);

        $resolver->setRequired(['value_type']);
        $resolver->setAllowedTypes(['allowed_keys' => ['null', 'array']]);
    }

    public function getParent()
    {
        return 'sonata_type_native_collection';
    }

    public function getName()
    {
        return 'zapoyok_extraform_key_value';
    }
}
