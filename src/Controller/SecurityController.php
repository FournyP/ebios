<?php

namespace App\Controller;

use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

class SecurityController extends AbstractController
{
    #[Route(path: '/api/login', name: 'api_login', methods: ['POST'])]
    public function index(): Response
    {
        $user = $this->getUser();

        return $this->json([
            'username' => $user->getUsername(),
            'roles' => $user->getRoles()
        ]);
    }

    #[Route(path: "/api/logout", name: 'api_logout', methods: ['POST'])]
    public function logout() 
    {

    }

    #[Route(path: "/api/register", name: "api_register", methods: ['POST'])]
    public function register(Request $request, ValidatorInterface $validator, UserPasswordHasherInterface $hasher, EntityManagerInterface $entityManager): Response 
    {
        if ($this->getUser() === null) 
        {
            $user = new User();

            $email = $request->get('username');
            $password = $request->get('password');

            if ($email != null && $password != null)
            {
                $user->setEmail($email)
                    ->setPassword($hasher->hashPassword($user, $password));

                $validation = $validator->validate($user);

                if ($validation->count() != 0)
                {
                    $entityManager->persist($user);
                    $entityManager->flush();

                    return new Response('', 201);
                }

                return $this->json($validation, 400);
            }
        }

        return new Response('', 401);
    }
}
