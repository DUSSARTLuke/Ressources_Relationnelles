<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints\Date;

class UserPersister implements ContextAwareDataPersisterInterface
{

    private $uRepo;

    public function __construct(UserRepository $uRepo)
    {
        $this->uRepo = $uRepo;
    }


    public function supports($data, array $context = []): bool
    {
        return $data instanceof User;
    }

    /**
     * @param User $data
     * @param array $context
     * @return User|string
     */
    public function persist($data, array $context = [])
    {
        return $this->uRepo->persist($data);
//            if ($data->getPassword()) {
//                $data->setPassword(
//                    $this->userPasswordEncoder->encodePassword($data, $data->getPassword()));
//                $data->eraseCredentials();
//            }
//            $data->setRoles(["ROLE_USER"]);
//            $data->setCreatedAt(new \DateTime());
//
//            $this->entityManager->persist($data);
//            $this->entityManager->flush();
//            return 'ok';
    }

    public function remove($data, array $context = [])
    {
        // TODO: Implement remove() method.
    }
}