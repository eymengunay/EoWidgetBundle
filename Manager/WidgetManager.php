<?php

/*
 * This file is part of the EoWidgetBundle package.
 *
 * (c) Eymen Gunay <eymen@egunay.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eo\WidgetBundle\Manager;

use Eo\WidgetBundle\Widget\WidgetInterface;
use Eo\WidgetBundle\Renderer\RendererInterface;
use Eo\WidgetBundle\Exception\WidgetNotFoundException;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Eo\WidgetBundle\Manager\WidgetManager
 */
class WidgetManager
{
	/**
	 * @var ContainerInterface
	 */
	protected $container;

    /**
     * @var array
     */
    protected $widgets;

    /**
     * @var array
     */
    protected $renderers;

	/**
	 * Class constructor
	 *
	 * @param ContainerInterface
	 */
	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
        $this->widgets = new ArrayCollection();
        $this->renderers = new ArrayCollection();
	}

    /**
     * Add widget
     *
     * @param  string $name
     * @param  WidgetInterface $widget
     * @return self
     */
    public function addWidget(WidgetInterface $widget)
    {
        $this->widgets->set($widget->getName(), $widget);
        return $this;
    }

    /**
     * Get widget
     *
     * @param  string $name
     * @throws WidgetNotFoundException If widget not found
     * @return WidgetInterface
     */
    public function getWidget($name)
    {
        if ($widget = $this->widgets->get($name)) {
            return $widget;
        } else {
            throw new WidgetNotFoundException(sprintf("Widget %s not found!", $name));
        }
    }

    /**
     * Add renderer
     *
     * @param  string $name
     * @param  RendererInterface $renderer
     * @return self
     */
    public function addRenderer(RendererInterface $renderer)
    {
        $this->renderers->set($renderer->getName(), $renderer);
        return $this;
    }

    /**
     * Get renderer
     *
     * @param  string $name
     * @throws RendererNotFoundException If renderer not found
     * @return RendererInterface
     */
    public function getRenderer($name)
    {
        if ($renderer = $this->renderers->get($name)) {
            return $renderer;
        } else {
            throw new RendererNotFoundException(sprintf("Renderer %s not found!", $name));
        }
    }

    /**
     * Render widget
     *
     * @param  string $name
     * @return mixed
     */
    public function render($name)
    {
        $widget = $this->getWidget($name);
        $renderer = $this->getRenderer($widget->getRenderer());

        return $renderer->render($widget);
    }
}
