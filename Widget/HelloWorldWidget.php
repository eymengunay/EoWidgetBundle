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
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormInterface;

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
    public function buildOptionsForm(FormBuilder $builder)
    {
    	$builder
    		->add('name', 'text', array(
    			'required' => false,
    			'empty_data' => 'John'
    		))
    	;
    }

	/**
	 * {@inheritdoc}
	 */
	public function getRenderParameters($options = array())
	{
		return array();
	}
}