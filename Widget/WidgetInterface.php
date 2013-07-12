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

/**
 * WidgetInterface
 */
interface WidgetInterface
{
    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Get async
     *
     * @return bool
     */
    public function getIsAsync();

    /**
     * Get template
     *
     * @return string
     */
    public function getTemplate();

    /**
     * Get renderer
     *
     * @return string
     */
    public function getRenderer();

    /**
     * Build options form
     *
     * @param FormBuilder $builder
     */
    public function buildOptionsForm(FormBuilder $builder);

    /**
     * Get data
     *
     * @return mixed
     */
    public function getData($options = array(), $isAsync = false);
}