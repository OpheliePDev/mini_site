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
            
            // L'adresse d'expédition DOIT correspondre à l'adresse de connexion du MAILER_DSN
            $senderEmail = 'ophelie.pereira.dev@gmail.com'; 

            $email = (new Email())
                // Expéditeur (technique) : Votre adresse Gmail
                ->from($senderEmail) 
                
                // Destinataire (vous)
                ->to('ophelie.pereira.dev@gmail.com')
                
                // Ajout du ReplyTo pour la réponse rapide à l'utilisateur
                ->replyTo($data['email']) 
                
                ->subject('📩 Nouveau message depuis le formulaire de contact')
                // Utilisez $data['name'] dans le corps du message pour savoir qui a contacté
                ->text("Nom: {$data['name']}\nEmail : {$data['email']}\nMessage : {$data['message']}");
            
            try {
                $mailer->send($email);
                $this->addFlash('success', 'Merci ! Votre message a été envoyé.');
            } catch (\Exception $e) {
                // Gestion d'erreur en cas de problème de connexion (DSN incorrect)
                $this->addFlash('error', 'Une erreur est survenue lors de l\'envoi du message. Veuillez vérifier votre configuration.');
            }

            return $this->redirectToRoute('contact');
        }

        return $this->render('home/contact.html.twig', [
            'title' => 'Contact',
            'form' => $form->createView(),
        ]);
    }
}