<?php

/*
 * This file is part of the EoWidgetBundle package.
 *
 * (c) Eymen Gunay <eymen@egunay.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eo\WidgetBundle\Widget;

/**
 * AbstractWidget
 */
abstract class AbstractWidget implements WidgetInterface
{
    /**
     * @const DEFAULT_RENDERER
     */
    const DEFAULT_RENDERER = 'twig-renderer';

	/**
	 * @var string
	 */
	protected $name;

	/**
	 * @var string
	 */
	protected $template;

    /**
     * @var string
     */
    protected $renderer = self::DEFAULT_RENDERER;

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * {@inheritdoc}
     */
    public function getRenderer()
    {
        return $this->renderer;
    }

	/**
	 * {@inheritdoc}
	 */
	public function getRenderParameters()
	{
		return array();
	}
}