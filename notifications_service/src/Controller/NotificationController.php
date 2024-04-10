<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class NotificationController extends AbstractController
{
    #[Route(path: '/', name: 'notifications', methods: ['GET'])]
    public function notifications(): JsonResponse
    {
        return $this->json(["service" => "Notifications", "version" => "0.0.1", "author" => "Ali Naqi Al-Musawi"]);
    }
}
