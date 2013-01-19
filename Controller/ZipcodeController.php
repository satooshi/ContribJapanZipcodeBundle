<?php

namespace Contrib\JapanZipcodeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Contrib\HttpFoundationExtraBundle\Configuration\Json;

/**
 * Zipcode API controller.
 *
 * @author Kitamura Satoshi <with.no.parachute@gmail.com>
 */
class ZipcodeController extends Controller
{
    // action

    /**
     * @Route(
     *     "/{zipcode}",
     *     name = "zipcode_list",
     *     requirements = { "zipcode": "\d{7}" }
     * )
     * @Method("GET")
     * @Json(serialize = true, serializeGroups = {"list"})
     */
    public function listAction($zipcode)
    {
        $repository = $this->getHomeZipcodeRepository();
        $entities = $repository->findByZipcode($zipcode);

        return $entities;
    }

    /**
     * @Route(
     *     "/home/{zipcode}",
     *     name = "zipcode_home_list",
     *     requirements = { "zipcode": "\d{7}" }
     * )
     * @Method("GET")
     * @Json(serialize = true, serializeGroups = {"list"})
     */
    public function listHomeAction($zipcode)
    {
        $repository = $this->getHomeZipcodeRepository();
        $entities = $repository->findByZipcode($zipcode);

        return $entities;
    }

    /**
     * @Route(
     *     "/office/{zipcode}",
     *     name = "zipcode_office_list",
     *     requirements = { "zipcode": "\d{7}" }
     * )
     * @Method("GET")
     * @Json(serialize = true, serializeGroups = {"list"})
     */
    public function listOfficeZipcodeAction()
    {

    }

    // internal method

    /**
     * @param string $name The object manager name (null for the default one)
     * @return \Contrib\JapanZipcodeBundle\Repository\HomeZipcodeRepository
     */
    protected function getHomeZipcodeRepository($name = null)
    {
        return $this->getDoctrine()->getManager($name)->getRepository('ContribJapanZipcodeBundle:HomeZipcode');
    }
}
