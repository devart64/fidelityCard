<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\RedirectController;

class DefaultController extends AbstractController
{
/**
 * @Route("/", name="accueil")
 */
public function accueil() {
   if($this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY')){
       return new $this->redirectToRoute('tableaudebord');
   } else {
    return $this->render('accueil.html.twig');
   }
    
}}