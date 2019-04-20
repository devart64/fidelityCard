<?php
/**
 * Created by PhpStorm.
 * User: andredupre
 * Date: 2019-04-08
 * Time: 22:08
 */

namespace App\Controller\security;

use App\Entity\CarteDeFidelite;
use App\Entity\Client;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{

    /**
     * @Route("/", name="admin")
     */
    public function admin()
    {
        $repository = $this->getDoctrine()->getRepository(Client::class);
        $clients = $repository->findAll();
        return $this->render('administration/listeutilisateur.html.twig', ['clients' => $clients]);
    }

    /**
     * @Route("/liste-clients", name="listeclient")
     */
    public function listeClient()
    {
        $repository = $this->getDoctrine()->getRepository(Client::class);
        $clients = $repository->findAll();
        return $this->render('administration/listeutilisateur.html.twig', ['clients' => $clients]);
    }

    /**
     * @Route("/ajout-clients", name="ajoutclient")
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function ajoutClient(Request $request)
    {
        if ($request->getMethod() == "POST") {
            $entityManager = $this->getDoctrine()->getManager();
            $client = new Client();
            $client->setNom($request->get('nom'));
            $client->setPrenom($request->get('prenom'));
            $client->setEmail($request->get('email'));
            $client->setRue($request->get('rue'));
            $client->setCodepostall($request->get('codepostal'));
            $client->setVille($request->get('ville'));
            $client->setTelephone($request->get('telephone'));

            $entityManager->persist($client);
            $entityManager->flush();

            $carteDeFidelite = new CarteDeFidelite();
            $carteDeFidelite->setCreatedAt(new \DateTime());
            $carteDeFidelite->setIdClient($client->getId());

            $entityManager->persist($carteDeFidelite);
            $entityManager->flush();
            return $this->redirectToRoute('compteclient', ['id' => $client->getId()]);
        }

        return $this->render('administration/nouvelutilisateur.html.twig');
    }

    /**
     * @Route("/compte-clients{id}", name="compteclient")
     * @param $id
     * @return Response
     */
    public function compteClient($id) {
        $client = $this->getDoctrine()
            ->getRepository(Client::class)
            ->find($id);

        return $this->render('administration/compteutilisateur.html.twig', ['client' => $client]);
    }



}