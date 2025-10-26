<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/about', name: 'about')]
    public function about(): Response
    {
        return $this->render('home/about.html.twig', [
            'title' => 'À propos de moi',
        ]);
    }
    #[Route('/contact', name: 'contact')]
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $email = (new Email())
                ->from($data['email'])
                ->to('ophelie.pereira.dev@gmail.com')
                ->subject('📩 Nouveau message depuis le formulaire de contact')
                ->text("Nom: {$data['name']}\nEmail : {$data['email']}\nMessage : {$data['message']}");
            
                $mailer->send($email);

                $this->addFlash('success', 'Merci ! Votre message a été envoyé.');

                return $this->redirectToRoute('contact');
        }

        return $this->render('home/contact.html.twig', [
            'title' => 'Contact',
            'form' => $form->createView(),
        ]);
    }
}
