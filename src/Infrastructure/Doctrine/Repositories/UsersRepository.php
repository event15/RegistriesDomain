<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 29.07.15
 * Time: 09:55
 */

namespace Infrastructure\Doctrine\Repositories;



use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Models\Users\UserRepositoryInterface;
use Models\Users\Users;

class UsersRepository implements UserRepositoryInterface
{
    private $em;
    const MODEL = "\\Models\\Users\\Users";

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function save(Users $user)
    {
        try {
            $this->em->persist($user);
            $this->em->flush();
        } catch (ORMInvalidArgumentException $e) {
            throw $e;
        } catch (ORMException $e) {
            throw $e;
        }
    }
    public function find($id)
    {
        return $this->em->getRepository(self::MODEL)->find($id);
    }


}