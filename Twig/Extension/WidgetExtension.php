<?php

/*
 * This file is part of the EoWidgetBundle package.
 *
 * (c) Eymen Gunay <eymen@egunay.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eo\WidgetBundle\Twig\Extension;

use Eo\WidgetBundle\Manager\WidgetManager;
use Eo\WidgetBundle\Exception\WidgetNotFoundException;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * Widget extension
 */
class WidgetExtension extends \Twig_Extension
{
    /**
     * @var array $options Array of default options that can be overriden with getters and in the construct.
     */
    protected $options = array();

    /**
     * @var WidgetManager
     */
    protected $wm;

    /**
     * Class constructor
     *
     * @param WidgetManager $wm
     */
    public function __construct(WidgetManager $wm)
    {
        $this->wm = $wm;
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return array(
            'eo_widget' => new \Twig_Function_Method($this, 'renderWidget', array(
                'is_safe' => array('html'),
                'needs_environment' => true,
                'needs_context' => true,
            ))
        );
    }

    /**
     * Render widget
     *
     * @param  string $name
     * @return string
     */
    public function renderWidget(\Twig_Environment $env, $context, $name, $options = array())
    {
        $options = array_merge($this->options, $options);
        return $this->wm->render($name);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'eo_widget_extension';
    }
}