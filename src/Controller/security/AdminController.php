<?php
/**
 * Created by PhpStorm.
 * User: andredupre
 * Date: 2019-04-08
 * Time: 22:08
 */

namespace App\Controller\security;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{

    /**
     * @Route("/tableaudebord", name="admin")
     */
    public function admin()
    {
        return $this->render('administration/dashbord.html.twig');
    }

    /**
     * @Route("/liste-clients", name="listeclient")
     */
    public function listeClient()
    {
        return $this->render('administration/listeutilisateur.html.twig');
    }

    /**
     * @Route("/ajout-clients", name="ajoutclient")
     */
    public function ajoutClient()
    {
        return $this->render('administration/nouvelutilisateur.html.twig');
    }

    /**
     * @Route("/compte-clients", name="compteclient")
     */
    public function compteClient() {
        return $this->render('administration/compteutilisateur.html.twig');
    }



}