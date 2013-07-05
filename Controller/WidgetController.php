<?php

/*
 * This file is part of the EoWidgetBundle package.
 *
 * (c) Eymen Gunay <eymen@egunay.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eo\WidgetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class WidgetController extends Controller
{
    public function renderAction($name)
    {
        $wm = $this->container->get('eo_widget.manager');
        return new Response($wm->render($name));
    }
}
