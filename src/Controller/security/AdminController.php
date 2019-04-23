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
use Doctrine\ORM\QueryBuilder;
use PDO;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{

    /**
     * @Route("tableaudebord", name="admin")
     */
    public function admin()
    {

        $repository = $this->getDoctrine()->getRepository(Client::class);
        $clients = $repository->findBy([
            'nom' => 'asc'
        ]);

        $alphabet = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
        return $this->render('administration/listeutilisateur.html.twig', ['clients' => $clients, 'alphabet' => $alphabet]);
    }

    /**
     * @Route("tableaudebord/liste-clients", name="listeclient")
     */
    public function listeClient()
    {
        $conn = $this->getDoctrine()->getConnection();
        $requete = "SELECT * FROM client order by client.nom ASC";
        $statment= $conn->prepare($requete);
        $statment->execute();
        $statment->setFetchMode(PDO::FETCH_OBJ);

        $array = array();
        while ($data = $statment->fetch()) {


            $array[] = $data;
        }

$clients = $array;


        $alphabet = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
        return $this->render('administration/listeutilisateur.html.twig', ['clients' => $clients, 'alphabet' => $alphabet]);
    }
    public  function comparer($a, $b) {
        return strcmp($a->nom, $b->nom);
    }



    /**
     * @Route("tableaudebord/ajout-clients", name="ajoutclient")
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
     * @Route("tableaudebord/compte-clients{id}", name="compteclient")
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