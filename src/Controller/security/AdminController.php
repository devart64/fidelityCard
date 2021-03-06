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
use App\Entity\Tampon;
use App\Entity\User;
use App\manager\EmailManager;
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


    /**
     * @Route("tableaudebord/ajout-clients", name="ajoutclient")
     * @param Request $request
     * @param \Swift_Mailer $mailer
     * @param EmailManager $emailManager
     * @return Response
     * @throws \Exception
     */
    public function ajoutClient(Request $request, \Swift_Mailer $mailer, EmailManager $emailManager)
    {
        $entityManager = $this->getDoctrine()->getManager();
        if ($request->getMethod() == "POST") {
            if ($request->get('idClient')) {
                $id = $request->get('idClient');
                $client = $this->getDoctrine()
                    ->getRepository(Client::class)
                    ->find($id);
            }else {
                $client = new Client();
            }
            $client->setNom($request->get('nom'));
            $client->setPrenom($request->get('prenom'));
            $client->setEmail($request->get('email'));
            $client->setRue($request->get('rue'));
            $client->setCodepostall($request->get('codepostal'));
            $client->setVille($request->get('ville'));
            $client->setTelephone($request->get('telephone'));
            // a rendre dynamique une fois le module d'import opérationnel
            $client->setImage("");
            $entityManager->persist($client);
            $entityManager->flush();

            // création du compte utilisateur
            $utilisateur = new User();
            $utilisateur->setEmail($request->get('email'));
            $utilisateur->setUsername($request->get('prenom'). $client->getId() );
            $utilisateur->setPassword("");
            $utilisateur->setIdClient($client->getId());
            $entityManager->persist($utilisateur);
            $entityManager->flush();

            /**
             * mettre en place l'envoi email pour génération du mot de passe utiiisateur
             */

            if (!$request->get('idClient')) {
                $carteDeFidelite = new CarteDeFidelite();
                $carteDeFidelite->setCreatedAt(new \DateTime());
                $carteDeFidelite->setIdClient($client->getId());
                $carteDeFidelite->setNbTampon(0);
                $carteDeFidelite->setDernierTampon(0);

                $entityManager->persist($carteDeFidelite);
                $entityManager->flush();
                for ($i = 0; $i<10; $i++) {
                    $tampon = new Tampon();
                    $tampon->setImage("");
                    $tampon->setIdCarteFidelite($carteDeFidelite->getId());
                    $tampon->setDateCreation(time());
                    $tampon->setIsCocher(0);

                    $entityManager->persist($tampon);
                    $entityManager->flush();
                }

                /**
                 * envoi d'un mail  à l'adresse renseignée
                 * avec un lien de création de mot de passe afin de valider le compte$
                 * et de pouvoir si connecter
                 * parametre get {idUser}
                 * envoyer un a href="/mot-de-passe6" ou 6 est l'id user
                 */
                $body = $this->render('email/emails/creationcompteemail.html.twig', ['id' => $utilisateur->getId()]);
                $emailManager->envoiEmail($client, 'Création de votre compte client', $body);

            }

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
        $conn = $this->getDoctrine()->getConnection();
        $requete = "SELECT * FROM carte_de_fidelite WHERE id_client = $id";
        $statment= $conn->prepare($requete);
        $statment->execute();
        $statment->setFetchMode(PDO::FETCH_OBJ);

        $carte = $statment->fetch();
        $requete = "SELECT * FROM tampon  where id_carte_fidelite = $carte->id";
        $statment= $conn->prepare($requete);
        $statment->execute();
        $statment->setFetchMode(PDO::FETCH_OBJ);

        $array = array();
        while ($data = $statment->fetch()) {
            $array[] = $data;
        }

        $tampons = $array;

        $requete = "SELECT * FROM imageTampon";
        $statment= $conn->prepare($requete);
        $statment->execute();
        $statment->setFetchMode(PDO::FETCH_OBJ);

        $arrayImageTampon = array();
        while ($data = $statment->fetch()) {
            $arrayImageTampon[] = $data;
        }
        $listeImagesTampon = $arrayImageTampon;
        return $this->render('administration/compteutilisateur.html.twig', [
            'client' => $client,
            'carte' => $carte,
            'tampons'=>$tampons,
            'listeImageTampon' => $listeImagesTampon]);
    }

    /**
     * @Route("tableaudebord/ajout-tampon", name="ajouttampon")
     * @param Request $request
     * @return Response
     */
    public function ajouterTampon(Request $request) {
        // on récupère l'id du tampon
        // on update celui ci is``Cocher = 1
        $conn = $this->getDoctrine()->getConnection();
        $idCarteFidelity = $request->get('idCarteDeFidelite');
        $id = $request->get('idTampon');
        $isCocher = $request->get('isCocher');
        $image = $request->get('image');
        $entityManager = $this->getDoctrine()->getManager();
        $tampon = $this->getDoctrine()
            ->getRepository(Tampon::class)
            ->find($id);
        $tampon->setIdCarteFidelite($idCarteFidelity);
       $tampon->setIsCocher($isCocher);
       $tampon->setDateCreation(time());
       $tampon->setImage($image);
        $entityManager->persist($tampon);
        $entityManager->flush();
       /* if ($nbTampon == 10) {

            // si envoi mail prochaine pizza gratuite
            // si checkbox pizza gruite checjked
            // on archive la carte et en créé une  ouvelle

            $idClient = $carte->getIdClient();
            $client = $this->getDoctrine()->getRepository(Client::class)->find($idClient);
            $emailManager->emailPizzaGratuite($client);
        }*/
        return new Response("");
    }

    /**
     * @Route("tableaudebord/recherche-client", name="rechercheclient")
     * @param Request $request
     * @return Response
     */
    public function rechercheClient(Request $request) {
        $texteRecherche = $request->get('texteArechercher');
        $conn = $this->getDoctrine()->getConnection();
       // $requete = "SELECT * FROM client  where nom LIKE '%".$texteRecherche."%' OR prenom LIKE  '%".$texteRecherche."%' OR telephone LIKE '%".$texteRecherche."%'";
        $requete = "SELECT * FROM client  where telephone LIKE '%".$texteRecherche."%' OR nom LIKE '%".$texteRecherche."%' OR prenom LIKE  '%".$texteRecherche."%' OR email LIKE '%".$texteRecherche."%'";
        $statment= $conn->prepare($requete);
        $statment->execute();
        $statment->setFetchMode(PDO::FETCH_OBJ);

        $array = array();
        while ($data = $statment->fetch()) {
            $array[] = $data;
        }

        $clients = $array;
       return $this->render('administration/listeclientload.html.twig', [
            'clients' => $clients
        ]);
    }

    /**
     * @Route("tableaudebord/interface-email", name="interfaceemail")
     * @return Response
     */
    public function interfaceEmail() {
        return $this->render('email/email_compose.html.twig');
    }

    /**
     * @Route("tableaudebord/verif-email", name="verifemail")
     * @return Response
     * fonciton de vérifaction de duplication du  mail
     */
    public function verifEmail(Request $request) {
        $adressMail = $request->get('mail');
        $conn = $this->getDoctrine()->getConnection();
        $requete = "SELECT * FROM client  where email = '".$adressMail."'";
        $statment= $conn->prepare($requete);

        $statment->execute();
       $nb = $statment->rowCount();
       $result = 'true';
       if ($nb != 0) {
           $result = 'false';
       }
        return new Response($result);
    }

}