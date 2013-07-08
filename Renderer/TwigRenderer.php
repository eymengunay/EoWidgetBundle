<?php

/*
 * This file is part of the EoWidgetBundle package.
 *
 * (c) Eymen Gunay <eymen@egunay.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eo\WidgetBundle\Renderer;

use Eo\WidgetBundle\Widget\WidgetInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\FormInterface;

class TwigRenderer extends AbstractRenderer
{
    protected $name = "twig-renderer";

    /**
     * Class constructor
     *
     * @param ContainerInterface
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function render(WidgetInterface $widget, array $options, FormInterface $form = null)
    {
        // Set parameters
        $parameters = $widget->getRenderParameters($options);
        $parameters['options'] = $options; // Reserved name "options"
        $parameters['widget'] = $widget; // Reserved name "widget"
        $parameters['form'] = $form->createView(); // Reserved name "form"
        $parameters['unique'] = 'asssd'; // Reserved name "unique"

        return $this->container->get('templating')->render($widget->getTemplate(), $parameters);
    }
}