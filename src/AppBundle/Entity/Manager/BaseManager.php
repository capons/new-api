<?php

namespace AppBundle\Entity\Manager;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManager;

/**
 * Class BaseManager
 *
 * @package Sonata\CoreBundle\Model
 *
 * @author  Hugo Briand <briand@ekino.com>
 */
class BaseManager implements ManagerInterface
{
    /**
     * @var ManagerRegistry
     */
    protected $registry;

    /**
     * @var string
     */
    protected $class;

    /**
     * @param string          $class
     * @param ManagerRegistry $registry
     */
    public function __construct($class, ManagerRegistry $registry)
    {
        $this->registry = $registry;
        $this->class    = $class;
    }

    /**
     * {@inheritdoc}
     */
    public function getConnection()
    {
        return $this->getEntityManager()->getConnection();
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager()
    {
        return $this->getObjectManager();
    }

    /**
     * @return ObjectManager
     */
    public function getObjectManager()
    {
        $manager = $this->registry->getManagerForClass($this->class);

        if (!$manager) {
            throw new \RuntimeException(sprintf("Unable to find the mapping information for the class %s."
                ." Please check the 'auto_mapping' option (http://symfony.com/doc/current/reference/configuration/doctrine.html#configuration-overview)"
                ." or add the bundle to the 'mappings' section in the doctrine configuration.", $this->class));
        }

        return $manager;
    }

    /**
     * {@inheritdoc}
     */
    public function getClass($type = null)
    {
        if ($type) {
            return $this->getEntityManager()->getClassMetadata($this->class)->discriminatorMap[$type];
        }

        return $this->class;
    }

    /**
     * {@inheritdoc}
     */
    public function findAll()
    {
        return $this->getRepository()->findAll();
    }

    /**
     * {@inheritdoc}
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->getRepository()->findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * {@inheritdoc}
     */
    public function findOneBy(array $criteria, array $orderBy = null)
    {
        return $this->getRepository()->findOneBy($criteria, $orderBy);
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return $this->getRepository()->find($id);
    }

    /**
     * Call repository methods by default
     */
    public function __call($name, $arguments)
    {
        if (method_exists($this->getRepository(), $name)) {
            return call_user_func_array(
                array($this->getRepository(), $name),
                $arguments
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function create($type = null)
    {
        $class = $this->getClass($type);
        return new $class;
    }

    /**
     * {@inheritdoc}
     */
    public function save($entity, $andFlush = true, $andClear = false)
    {
        $this->checkObject($entity);

        $this->getObjectManager()->persist($entity);

        if ($andFlush) {
            $this->getObjectManager()->flush($entity);

            if ($andClear) {
                $this->getObjectManager()->clear($entity);
            }
        }

        return $entity;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($entity, $andFlush = true)
    {
        $this->checkObject($entity);

        $this->getObjectManager()->remove($entity);

        if ($andFlush) {
            $this->getObjectManager()->flush();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getTableName()
    {
        return $this->getObjectManager()->getClassMetadata($this->class)->table['name'];
    }

    /**
     * Returns the related Object Repository.
     *
     * @return ObjectRepository
     */
    protected function getRepository()
    {
        return $this->getObjectManager()->getRepository($this->class);
    }

    /**
     * @param $object
     *
     * @throws \InvalidArgumentException
     */
    protected function checkObject($object)
    {
        if (!$object instanceof $this->class) {
            throw new \InvalidArgumentException(sprintf(
                'Object must be instance of %s, %s given',
                $this->class, is_object($object)? get_class($object) : gettype($object)
            ));
        }
    }
}
