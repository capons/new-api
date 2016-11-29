<?php
namespace AppBundle\Repository;

use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Product;


class ProductRepository extends EntityRepository
{

    public function findAllProduct()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p.id,p.name, c.name as cat_name FROM AppBundle:Product p LEFT JOIN AppBundle:Category c WITH c.id = p.category  '
            )
            ->getResult();
    }

    public function findByProductId($id)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p.id,p.name, c.name as cat_name FROM AppBundle:Product p LEFT JOIN AppBundle:Category c WITH c.id = p.category WHERE p.id = '.$id.'  '
            )
            ->getResult();
    }

}