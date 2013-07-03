<?php

/*
 * This file is part of the EoWidgetBundle package.
 *
 * (c) Eymen Gunay <eymen@egunay.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eo\WidgetBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class WidgetPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $manager = $container->getDefinition('eo_widget.manager');

        $renderers = $container->findTaggedServiceIds('eo_widget.renderer');
        foreach ($renderers as $id => $attributes) {
            $manager->addMethodCall(
                'addRenderer',
                array(new Reference($id))
            );
        }

        $widgets = $container->findTaggedServiceIds('eo_widget.widget');
        foreach ($widgets as $id => $attributes) {
            $manager->addMethodCall(
                'addWidget',
                array(new Reference($id))
            );
        }
    }
}