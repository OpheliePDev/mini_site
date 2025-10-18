<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HobbyController extends AbstractController
{
    #[Route('/hobbies', name: 'app_hobbies')]
    public function index(): Response
    {
        $hobbies = ['Informatique', 'Développement Web', 'Formule 1', 'Jeux Vidéos'];

        return $this->render('hobby/index.html.twig', [
            'hobbies' => $hobbies,
        ]);
    }
}
