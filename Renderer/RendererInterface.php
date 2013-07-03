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

interface RendererInterface
{
    /**
     * Get name
     *
     * @return string
     */
    public function getName();

	/**
	 * Render widget
	 *
	 * @return mixed
	 */
	public function render(WidgetInterface $widget);
}