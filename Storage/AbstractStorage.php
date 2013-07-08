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
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Eo\WidgetBundle\Storage\AbstractStorage
 */
abstract class AbstractStorage implements StorageInterface
{
	/**
	 * @var string
	 */
	protected $name;

	/**
	 * @var ArrayCollection
	 */
	protected $data;

	public function __construct()
	{
		$this->data = new ArrayCollection();
	}

	/**
	 * {@inheritdoc}
	 */
	public function toArray()
	{
		return array(
			'name' => $name,
			'data' => $data
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}

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
	public function setData($data)
	{
		$this->data = $data;
		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getData()
	{
		return $this->data;
	}

	/**
     * {@inheritdoc}
     */
    abstract public function findAll(WidgetInterface $widget);

    /**
     * {@inheritdoc}
     */
    abstract public function findOne(WidgetInterface $widget, $name);

	/**
	 * Save method
	 *
	 * @param WidgetInterface $widget
	 * @param mixed 		  $data
	 */
    abstract public function save(WidgetInterface $widget, $data);
}
