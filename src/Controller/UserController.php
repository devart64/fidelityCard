<?php


namespace App\Controller;


use App\Entity\Client;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class UserController extends AbstractController
{
    /**
     * @Route("profil", name="profil")
     * @return Response
     */
    public function admin()
    {
       $user = $this->getUser();
       $client = $this->getDoctrine()->getRepository(Client::class)->findBy(['email' =>$user->getEmail()]);

        return $this->render('utilisateur/profil.html.twig', ['client' => $client['0']]);
    }
}