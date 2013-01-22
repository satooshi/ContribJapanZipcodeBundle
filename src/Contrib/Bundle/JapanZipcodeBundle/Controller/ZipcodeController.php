<?php

namespace Contrib\Bundle\JapanZipcodeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Contrib\Bundle\HttpFoundationExtraBundle\Configuration\Json;

/**
 * Zipcode API controller.
 *
 * @author Kitamura Satoshi <with.no.parachute@gmail.com>
 */
class ZipcodeController extends Controller
{
    // action

    /**
     * @Route("/", name = "zipcode_list")
     * @Method("GET")
     * @Json(serialize = true, serializeGroups = {"list"})
     */
    public function listAction(Request $request)
    {
        $zipcode = $request->get('zipcode', null);

        if (!is_numeric($zipcode)) {
            throw $this->createNotFoundException('Could not find zip code');
        }

        return array(
            'home'   => $this->listHomeAction($request),
            'office' => $this->listOfficeZipcodeAction($request),
        );
    }

    /**
     * @Route("/home", name = "zipcode_home_list")
     * @Method("GET")
     * @Json(serialize = true, serializeGroups = {"list"})
     */
    public function listHomeAction(Request $request)
    {
        $zipcode = $request->get('zipcode', null);

        if (!is_numeric($zipcode)) {
            throw $this->createNotFoundException('Could not find zip code');
        }

        return $this->getHomeZipcodeRepository()->findByZipcode($zipcode);
    }

    /**
     * @Route("/office", name = "zipcode_office_list")
     * @Method("GET")
     * @Json(serialize = true, serializeGroups = {"list"})
     */
    public function listOfficeZipcodeAction(Request $request)
    {
        $zipcode = $request->get('zipcode', null);

        if (!is_numeric($zipcode)) {
            throw $this->createNotFoundException('Could not find zip code');
        }

        return $this->getOfficeZipcodeRepository()->findByZipcode($zipcode);
    }

    // internal method

    /**
     * @param string $name The object manager name (null for the default one)
     * @return \Contrib\Bundle\JapanZipcodeBundle\Repository\HomeZipcodeRepository
     */
    protected function getHomeZipcodeRepository($name = null)
    {
        return $this->getDoctrine()->getManager($name)->getRepository('ContribJapanZipcodeBundle:HomeZipcode');
    }

    /**
     * @param string $name The object manager name (null for the default one)
     * @return \Contrib\Bundle\JapanZipcodeBundle\Repository\OfficeZipcodeRepository
     */
    protected function getOfficeZipcodeRepository($name = null)
    {
        return $this->getDoctrine()->getManager($name)->getRepository('ContribJapanZipcodeBundle:OfficeZipcode');
    }
}
