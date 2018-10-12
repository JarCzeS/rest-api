<?php
/**
 * Created by PhpStorm.
 * User: jaroslawjarczewski
 * Date: 12/10/2018
 * Time: 21:58
 */

namespace App\Repository;


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;
use Symfony\Component\Cache\Simple\FilesystemCache;

class CachedRepository extends EntityRepository
{
    public $cache;

    public function __construct($em, Mapping\ClassMetadata $class)
    {
        $this->cache = new FilesystemCache();
        parent::__construct($em, $class);
    }

    /**
     * @return array|mixed|null
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function findAll() {
        $key = str_replace('\\','.',get_class($this));
        if (!$this->cache->has($key)) {
            $data = parent::findAll();
            $this->cache->set($key, $data);
        }

        return $this->cache->get($key);
    }

    /**
     * @param $search
     * @param $offset
     * @param $limit
     * @return array|mixed|null
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function search($search, $offset, $limit) {
        if(method_exists($this, 'fetchSearchResults')) {
            $key = str_replace('\\','.',get_class($this)).'.search.'.$search.'.'.$offset.'.'.$limit;
            if (!$this->cache->has($key)) {
                $data = $this->fetchSearchResults($search, $offset, $limit);
                $this->cache->set($key, $data);
            }

            return $this->cache->get($key);
        }

        return false;
    }

    /**
     * @param mixed $id
     * @param null $lockMode
     * @param null $lockVersion
     * @return mixed|null|object
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function find($id, $lockMode = null, $lockVersion = null)
    {
        $key = str_replace('\\','.',get_class($this)).'.'.$id;
        if (!$this->cache->has($key)) {
            $data = parent::find($id);
            $this->cache->set($key, $data);
        }

        return $this->cache->get($key);
    }
}