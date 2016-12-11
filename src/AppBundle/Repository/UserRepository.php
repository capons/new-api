<?php

namespace AppBundle\Repository;

use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Doctrine\ORM\EntityRepository;



class UserRepository extends EntityRepository implements UserLoaderInterface
{
    public function loadUserByUsername($username)
    {
        return $this->createQueryBuilder('u')
            ->select('u, g')            // for user permision group (Entity Group)
            ->leftJoin('u.groups', 'g') // for user permission group (Entity Group)
            ->where('u.username = :username OR u.email = :email')
            ->setParameter('username', $username)
            ->setParameter('email', $username)
            ->getQuery()
            ->getOneOrNullResult();
    }

    //rewrite doctrine method with sort parameter
    public function findAll()
    {
        return $this->findBy(array(), array('id' => 'DESC'));
    }
    /*
    public function loadUserData()
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
               'SELECT p.id,p.username
                FROM AppBundle:User p
                LEFT JOIN  AppBundle:Country c ON c.id = p.country
                '
        );

        return $all_country = $query->getResult();
    }
    */


}