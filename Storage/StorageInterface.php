<?php

/*
 * This file is part of the EoWidgetBundle package.
 *
 * (c) Eymen Gunay <eymen@egunay.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eo\WidgetBundle\Storage;

use Eo\WidgetBundle\Widget\WidgetInterface;

/**
 * Eo\WidgetBundle\Storage\StorageInterface
 */
interface StorageInterface
{
	/**
	 * Set name
	 *
	 * @param string $name
	 */
	public function setName($name);

	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getName();

	/**
	 * Set data
	 *
	 * @param ArrayCollection $data
	 */
	public function setData($data);

	/**
	 * Get data
	 *
	 * @return ArrayCollection
	 */
	public function getData();

	/**
	 * Find all
	 *
	 * @param WidgetInterface $widget
	 */
    public function findAll(WidgetInterface $widget);

    /**
	 * Find one
	 *
	 * @param WidgetInterface $widget
	 * @param string 		  $name
	 */
    public function findOne(WidgetInterface $widget, $name);

	/**
	 * Save method
	 *
	 * @param WidgetInterface $widget
	 * @param mixed 		  $data
	 */
    public function save(WidgetInterface $widget, $data);
}
