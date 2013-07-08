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
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Eo\WidgetBundle\Controller\WidgetController
 */
class WidgetController extends Controller
{
	/**
	 * Render widget
	 * 
	 * @param  string   $name
	 * @return Response
	 */
    public function renderAction($name)
    {
        $wm = $this->container->get('eo_widget.manager');
        return new Response($wm->render($name));
    }

    /**
	 * Save form options
	 * 
	 * @param  string   $name
	 * @return Response
	 */
    public function formAction($name)
    {
        $wm = $this->container->get('eo_widget.manager');
        $widget = $wm->getWidget($name);
        $request = $this->getRequest();
        
        // Create form
        $form = $wm->getOptionsForm($widget);
        $form->bind($request);

	    if ($form->isValid()) {
	        $storage = $wm->getStorage($widget->getStorage());
	        $storage->save($widget, $form->getData());
	        $this->get('session')->getFlashBag()->add('success', $this->get('translator')->trans("action.widget.options.success", array(), 'EoWidget'));
	    } else {
	    	$this->get('session')->getFlashBag()->add('error', $this->get('translator')->trans("action.widget.options.error", array(), 'EoWidget'));
	    }

	    $url = $this->getRequest()->headers->get("referer");
	    return new RedirectResponse($url);
    }
}
