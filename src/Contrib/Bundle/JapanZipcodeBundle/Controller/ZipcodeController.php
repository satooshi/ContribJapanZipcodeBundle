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
     * @Route("/{zipcode}",
     *     name = "zipcode_list",
     *     requirements = { "zipcode": "\d{7}" }
     * )
     * @Method("GET")
     * @Json(serialize = true, serializeGroups = {"list"})
     */
    public function listAction($zipcode)
    {
        return array(
            'home'   => $this->listHomeAction($zipcode),
            'office' => $this->listOfficeZipcodeAction($zipcode),
        );
    }

    /**
     * @Route("/home/{zipcode}",
     *     name = "zipcode_home_list",
     *     requirements = { "zipcode": "\d{7}" }
     * )
     * @Method("GET")
     * @Json(serialize = true, serializeGroups = {"list"})
     */
    public function listHomeAction($zipcode)
    {
        return $this->getHomeZipcodeRepository()->findByZipcode($zipcode);
    }

    /**
     * @Route("/office/{zipcode}",
     *     name = "zipcode_office_list",
     *     requirements = { "zipcode": "\d{7}" }
     * )
     * @Method("GET")
     * @Json(serialize = true, serializeGroups = {"list"})
     */
    public function listOfficeZipcodeAction($zipcode)
    {
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
