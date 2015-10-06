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
use Symfony\Component\Form\Extension\Core\ChoiceList\SimpleChoiceList;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class KeyValueRowType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if (null === $options['allowed_keys']) {
            $builder->add('key', 'text', []);
        } else {
            $builder->add('key', 'choice', [
                'choice_list' => new SimpleChoiceList($options['allowed_keys']),
            ]);
        }

        $builder->add('value', $options['value_type'], $options['value_options']);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'value_options' => [],
            'allowed_keys'  => null,
        ]);

        $resolver->setRequired([
            'value_type',
        ]);
        $resolver->setAllowedTypes([
            'allowed_keys' => [
                'null',
                'array',
            ],
        ]);
    }

    public function getName()
    {
        return 'zapoyok_extraform_key_value_row';
    }
}
