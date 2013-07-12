<?php

/*
 * This file is part of the EoWidgetBundle package.
 *
 * (c) Eymen Gunay <eymen@egunay.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eo\WidgetBundle\Manager;

use Eo\WidgetBundle\Widget\WidgetInterface;
use Eo\WidgetBundle\Storage\StorageInterface;
use Eo\WidgetBundle\Renderer\RendererInterface;
use Eo\WidgetBundle\Exception\WidgetNotFoundException;
use Eo\WidgetBundle\Exception\StorageNotFoundException;
use Eo\WidgetBundle\Exception\RendererNotFoundException;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\FormInterface;

/**
 * Eo\WidgetBundle\Manager\WidgetManager
 */
class WidgetManager
{
	/**
	 * @var ContainerInterface
	 */
	protected $container;

    /**
     * @var array
     */
    protected $widgets;

    /**
     * @var array
     */
    protected $renderers;

    /**
     * @var array
     */
    protected $storages;

	/**
	 * Class constructor
	 *
	 * @param ContainerInterface
	 */
	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
        $this->widgets = new ArrayCollection();
        $this->renderers = new ArrayCollection();
        $this->storages = new ArrayCollection();
	}

    /**
     * Add widget
     *
     * @param  WidgetInterface $widget
     * @return self
     */
    public function addWidget(WidgetInterface $widget)
    {
        $this->widgets->set($widget->getName(), $widget);
        return $this;
    }

    /**
     * Get widget
     *
     * @param  string $name
     * @throws WidgetNotFoundException If widget not found
     * @return WidgetInterface
     */
    public function getWidget($name)
    {
        if ($widget = $this->widgets->get($name)) {
            return $widget;
        } else {
            throw new WidgetNotFoundException(sprintf("Widget %s not found!", $name));
        }
    }

    /**
     * Add renderer
     *
     * @param  RendererInterface $renderer
     * @return self
     */
    public function addRenderer(RendererInterface $renderer)
    {
        $this->renderers->set($renderer->getName(), $renderer);
        return $this;
    }

    /**
     * Get renderer
     *
     * @param  string $name
     * @throws RendererNotFoundException If renderer not found
     * @return RendererInterface
     */
    public function getRenderer($name)
    {
        if ($renderer = $this->renderers->get($name)) {
            return $renderer;
        } else {
            throw new RendererNotFoundException(sprintf("Renderer %s not found!", $name));
        }
    }

    /**
     * Add storage
     *
     * @param  StorageInterface $storage
     * @return self
     */
    public function addStorage(StorageInterface $storage)
    {
        $this->storages->set($storage->getName(), $storage);
        return $this;
    }

    /**
     * Get storage
     *
     * @param  string $name
     * @throws RendererNotFoundException If renderer not found
     * @return RendererInterface
     */
    public function getStorage($name)
    {
        if ($renderer = $this->storages->get($name)) {
            return $renderer;
        } else {
            throw new StorageNotFoundException(sprintf("Storage %s not found!", $name));
        }
    }

    /**
     * Creates and returns a form builder instance
     *
     * @param mixed $data    The initial data for the form
     * @param array $options Options for the form
     *
     * @return FormBuilder
     */
    public function createFormBuilder($data = null, array $options = array())
    {
        return $this->container->get('form.factory')->createNamedBuilder('widget', 'form', $data, $options);
    }

    /**
     * Returns an array of options form data
     *
     * @param FormInterface   $form     Form instance
     * @todo  Add recursive form child support
     *
     * @return FormBuilder
     */
    public function getOptionsData(FormInterface $form)
    {
        // Iterate through form children to get data
        $options = array();
        foreach ($form->getIterator() as $key => $val) {
            $options[$key] = $val->getData();
        }
        return $options;
    }

    /**
     * Get options form
     *
     * @param  WidgetInterface $widget Widget instance
     * @param  mixed           $formData The initial data for the form
     * @return FormInterface
     */
    public function getOptionsForm(WidgetInterface $widget, $formData = null)
    {
        // Create form builder for options form
        $builder = $this->createFormBuilder($formData);
        $widget->buildOptionsForm($builder);
        $form = $builder->getForm();
        return $form;
    }

    /**
     * Prepare widget options and form
     * 
     * @param  string $name
     * @param  array  $options
     * @return mixed
     */
    private function prepare($name, $options = array())
    {
        $widget = $this->getWidget($name);
        $storage = $this->getStorage($widget->getStorage());
        $form = $this->getOptionsForm($widget, $storage->findAll($widget));
        $options = array_merge($this->getOptionsData($form), $options);
        return array($widget, $storage, $form, $options);
    }

    /**
     * Render widget
     *
     * @param  string $name
     * @param  array  $options
     * @return mixed
     */
    public function render($name, $options = array())
    {
        list($widget, $storage, $form, $options) = $this->prepare($name, $options);
        $renderer = $this->getRenderer($widget->getRenderer());
        return $renderer->render($widget, $options, $form);
    }

    /**
     * Load widget data
     *
     * @param  string $name
     * @param  array  $options
     * @param  bool   $async
     * @return mixed
     */
    public function data($name, $options = array(), $async = false)
    {
        list($widget, $storage, $form, $options) = $this->prepare($name, $options);
        return $widget->getData($options, $async);
    }
}
