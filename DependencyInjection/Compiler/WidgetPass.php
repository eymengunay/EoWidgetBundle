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

        // Add renderers
        $renderers = $container->findTaggedServiceIds('eo_widget.renderer');
        foreach ($renderers as $id => $attributes) {
            $manager->addMethodCall(
                'addRenderer',
                array(new Reference($id))
            );
        }

        // Add widgets
        $widgets = $container->findTaggedServiceIds('eo_widget.widget');
        foreach ($widgets as $id => $attributes) {
            $manager->addMethodCall(
                'addWidget',
                array(new Reference($id))
            );
        }

        // Add storages
        $storages = $container->findTaggedServiceIds('eo_widget.storage');
        foreach ($storages as $id => $attributes) {
            $manager->addMethodCall(
                'addStorage',
                array(new Reference($id))
            );
        }
    }
}