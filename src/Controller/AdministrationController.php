<?php

namespace App\Controller;

use App\Entity\CarteDeFidelite;
use App\Entity\Client;
use App\manager\EmailManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdministrationController extends AbstractController
{
    /**
     * @Route("/administration", name="administration")
     */
    public function index()
    {
        // le nombre de pizza vendu == nombre de tampon
        // nombre de clients
        $conn = $this->getDoctrine()->getConnection();

        $requete = "SELECT COUNT(*) FROM client ";
        $statment= $conn->prepare($requete);
        $statment->execute();
        $nombreClient = $statment->fetch();
        $requete = "SELECT COUNT(*) FROM tampon where is_Cocher = 1";
        $statment= $conn->prepare($requete);
        $statment->execute();
        $nombrePizzaVendues = $statment->fetch();
        return $this->render('administration/index.html.twig', [
            'nombreClient' => $nombreClient['COUNT(*)'],
            'nombrePizza' => $nombrePizzaVendues['COUNT(*)'],
        ]);
    }
}
