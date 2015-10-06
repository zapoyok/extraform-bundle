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

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Zapoyok\ExtraFormBundle\DependencyInjection\Compiler\SonataCompilerPass;

class ZapoyokExtraFormBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new SonataCompilerPass());
    }
}
