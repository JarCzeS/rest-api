<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Mapping;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Cache\Simple\FilesystemCache;

/**
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends CachedRepository
{
    public function __construct($em, Mapping\ClassMetadata $class)
    {
        parent::__construct($em, $class);
    }

    public function fetchSearchResults($search, $offset, $limit) {
        $query = $this->createQueryBuilder('o')
            ->where('o.title LIKE :search')
            ->orWhere('o.description LIKE :search')
            ->setParameter('search', '%'.$search.'%')
            ->getQuery();

        $result = $query->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getResult();

        return $result;
    }
}
