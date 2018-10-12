<?php

namespace App\Repository;

use App\Entity\Author;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Mapping;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Cache\Simple\FilesystemCache;

/**
 * @method Author|null findOneBy(array $criteria, array $orderBy = null)
 * @method Author[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuthorRepository extends CachedRepository
{
    public function __construct($em, Mapping\ClassMetadata $class)
    {
        parent::__construct($em, $class);
    }
}
