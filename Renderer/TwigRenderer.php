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
        $parameters = array(
            'data'      => $widget->getData($options, false),
            'options'   => $options,
            'widget'    => $widget,
            'form'      => $form->createView(),
            // You can use this variable (eg. in your js) if you need to 
            // render the same widget multiple times.
            // It has a non-numerical prefix just to make sure 
            // that the value always starts with a letter. 
            // Might be useful if you need to use it as HTML id attribute
            'unique'    => "w".uniqid(),
        );

        return $this->container->get('templating')->render($widget->getTemplate(), $parameters);
    }
}