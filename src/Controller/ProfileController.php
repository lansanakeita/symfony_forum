<?php

namespace App\Controller;

use App\Repository\AtelierRepository;
use App\Repository\ParticipationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'profile')]
    public function index(): Response
    {
        return $this->render('profile/index.html.twig', [
            //'participations' => $participations
        ]);
    }

    #[Route('/profileAdmin', name: 'profileAdmin')]
    public function profileAdmin(): Response
    {
        return $this->render('profile/profileAdmin.html.twig', [
        ]);
    }
}
