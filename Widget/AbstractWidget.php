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

use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormInterface;

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
     * @const DEFAULT_STORAGE
     */
    const DEFAULT_STORAGE = 'session';

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
     * @var string
     */
    protected $storage = self::DEFAULT_STORAGE;

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
    public function getStorage()
    {
        return $this->storage;
    }

    /**
     * {@inheritdoc}
     */
    public function buildOptionsForm(FormBuilder $builder)
    {
    }

	/**
	 * {@inheritdoc}
	 */
	public function getRenderParameters($options = array())
	{
		return array();
	}
}