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
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Eo\WidgetBundle\Storage\SessionStorage
 */
class SessionStorage extends AbstractStorage
{
    /**
     * @var string
     */
    protected $name = 'session';

    /**
     * @var SessionInterface
     */
    protected $session;

    public function __construct(SessionInterface $session)
    {
        parent::__construct();
        $this->session = $session;
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(WidgetInterface $widget)
    {
        return $this->session->get($widget->getName(), array());
    }

    /**
     * {@inheritdoc}
     */
    public function findOne(WidgetInterface $widget, $name)
    {
        $options = $this->session->get($widget->getName(), array());
        if (isset($options[$name])) {
            return $options[$name];
        }
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function save(WidgetInterface $widget, $data)
    {
        $this->session->set($widget->getName(), $data);
    }
}
