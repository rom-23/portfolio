<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Notification\ContactNotif;
use App\Repository\ProfilRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
  /**
   * @Route("/", name="home")
   * @param ProfilRepository $profilRepository
   * @param Request $request
   * @param ContactNotif $notification
   * @return Response
   */
  public function index(ProfilRepository $profilRepository, Request $request, ContactNotif $notification)
  {
    $profils = $profilRepository->findAll();
    $contact = new Contact();
    $form = $this->createForm(ContactType::class, $contact);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $notification->notify($contact);
      mail("romain.laurent23@gmail.com", "Renseignements",$contact->getEmail().":". $contact->getMessage());
      $this -> addFlash( 'success', 'Email envoyé' );
      return $this -> redirectToRoute( 'home', [
        'profils' => $profils
      ] );
    }
    return $this->render('home/index.html.twig', [
      'form' => $form -> createView(),
      'profils' => $profils
    ]);
  }

}
