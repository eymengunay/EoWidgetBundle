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
}