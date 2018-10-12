<?php

namespace App\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;

class AuthorController extends FOSRestController
{
    /**
     * @Rest\Get("/authors")
     */
    public function getAction()
    {
        $object = $this->getDoctrine()->getRepository('App\Entity\Author')->findAll();
        return $object;
    }

    /**
     * @Rest\Get("/author/{id}")
     * @param $id
     * @return null|object
     */
    public function getSingleAction($id)
    {
        $object = $this->getDoctrine()->getRepository('App\Entity\Author')->find($id);
        return $object;
    }
}
