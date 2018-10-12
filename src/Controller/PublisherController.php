<?php

namespace App\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;

class PublisherController extends FOSRestController
{
    /**
     * @Rest\Get("/publishers")
     */
    public function getAction()
    {
        $object = $this->getDoctrine()->getRepository('App\Entity\Publisher')->findAll();
        return $object;
    }

    /**
     * @Rest\Get("/publisher/{id}")
     * @param $id
     * @return null|object
     */
    public function getSingleAction($id)
    {
        $object = $this->getDoctrine()->getRepository('App\Entity\Publisher')->find($id);
        return $object;
    }
}
