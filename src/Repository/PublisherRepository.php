<?php

namespace App\Repository;

use App\Entity\Publisher;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Mapping;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Publisher|null find($id, $lockMode = null, $lockVersion = null)
 * @method Publisher|null findOneBy(array $criteria, array $orderBy = null)
 * @method Publisher[]    findAll()
 * @method Publisher[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PublisherRepository extends CachedRepository
{
    public function __construct($em, Mapping\ClassMetadata $class)
    {
        parent::__construct($em, $class);
    }
}
