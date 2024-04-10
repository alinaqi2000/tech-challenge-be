<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Message\SendUserMessage;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Messenger\MessageBusInterface;


class UserController extends AbstractController
{
    #[Route(path: '/', name: 'users', methods: ['GET'])]
    public function users(): JsonResponse
    {
        return $this->json(["service" => "Users", "version" => "0.0.1", "author" => "Ali Naqi Al-Musawi"]);
    }
    #[Route('/list', name: 'users_list', methods: ["GET"])]
    public function list(UserRepository $userRepository): JsonResponse
    {
        return $this->json($userRepository->findAll());
    }
    #[Route('/', name: 'users_add', methods: ["POST"])]
    public function store(UserRepository $userRepository, Request $request, MessageBusInterface $bus): JsonResponse
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->submit($request->toArray());

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);

            $message = new SendUserMessage(json_encode($user));
            $bus->dispatch($message);

            return $this->json(["success" => "User added successfully!", "user" => $user]);
        }
        return $this->json(["error" => "Oops.. Something went wrong, please try later."]);
    }
}
