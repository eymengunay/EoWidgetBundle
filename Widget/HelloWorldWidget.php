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

use Eo\WidgetBundle\Annotation\Widget;
use Eo\WidgetBundle\Renderer\SimpleWidgetRenderer;

/**
 * HelloWorldWidget
 */
class HelloWorldWidget extends AbstractWidget
{
    protected $name = "hello-world";

    protected $template = "EoWidgetBundle:WidgetHelloWorld:index.html.twig";

	/**
	 * {@inheritdoc}
	 */
	public function getRenderParameters()
	{
		return array();
	}
}