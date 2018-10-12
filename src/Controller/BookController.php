<?php

namespace App\Controller;

use App\Repository\BookRepository;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

class BookController extends FOSRestController
{
    /**
     * @Rest\Get("/books")
     */
    public function getAction()
    {
        $books = $this->getDoctrine()->getRepository('App\Entity\Book')->findAll();

        return $books;
    }

    /**
     * @Rest\Get("/book/{id}")
     * @param $id
     * @return null|object
     */
    public function getSingleAction($id)
    {
        $book = $this->getDoctrine()->getRepository('App\Entity\Book')->find($id);

        return $book;
    }

    /**
     * @Rest\Get("/books/search/{search}/{offset}/{limit}", defaults={"offset"=0,"limit"=50})
     * @param string $search
     * @param int $offset
     * @param int $limit
     * @return null|object
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function searchAction(string $search, int $offset, int $limit)
    {
        /** @var BookRepository $repo */
        $repo = $this->getDoctrine()->getRepository('App\Entity\Book');
        $books = $repo->search($search, $offset, $limit);

        return $books;
    }
}
