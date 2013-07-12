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
use Symfony\Component\Form\Exception\UnexpectedTypeException;

/**
 * Eo\WidgetBundle\Controller\WidgetController
 */
class WidgetController extends Controller
{
	/**
	 * @var array
	 */
	protected $validFormats = array(
		"json" => "application/json", 
		"xml"  => "application/xml"
	);

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
	 * Render widget
	 * 
	 * @param  string   $name
	 * @param  string   $format
	 * @return Response
	 */
    public function dataAction($name, $format = "json")
    {
    	if (!isset($this->validFormats[$format])) {
    		throw new UnexpectedTypeException(sprintf("Invalid format given: %s", $format));
    	}
        $wm = $this->container->get('eo_widget.manager');

        // Serialize widget data
        $data = $this->container->get('jms_serializer')->serialize($wm->data($name, array(), true), $format);

        // Create response
        $response = new Response($data);
        $response->headers->set('Content-Type', $this->validFormats[$format]);
        return $response;
    }

    /**
	 * Save form options
	 * 
	 * @param  string   $name
	 * @return Response
	 */
    public function saveFormAction($name)
    {
        $wm = $this->container->get('eo_widget.manager');
        $widget = $wm->getWidget($name);
        $request = $this->getRequest();
        
        // Create form
        $form = $wm->getOptionsForm($widget);
        $form->bind($request);

        // Validate form
	    if ($form->isValid()) {
	        $storage = $wm->getStorage($widget->getStorage());
	        $storage->save($widget, $form->getData());
	        $this->get('session')->getFlashBag()->add('success', $this->get('translator')->trans("action.widget.options.success", array(), $this->container->getParameter('eo_widget.i18n_catalog')));
	    } else {
	    	$this->get('session')->getFlashBag()->add('error', $this->get('translator')->trans("action.widget.options.error", array(), $this->container->getParameter('eo_widget.i18n_catalog')));
	    }

	    // Create redirect response
	    $url = $this->getRequest()->headers->get("referer");
	    return new RedirectResponse($url);
    }
}
