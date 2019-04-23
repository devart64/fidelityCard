<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
/**
 * @Route("/", name="accueil")
 */
public function accueil() {
    return $this->render('accueil.html.twig');
}}