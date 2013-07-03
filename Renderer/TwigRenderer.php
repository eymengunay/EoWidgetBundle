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
	public function render(WidgetInterface $widget)
	{
        $template = $widget->getTemplate();
        $options  = array();
        return $this->container->get('templating.engine.twig')->render($template, $options);
	}
}