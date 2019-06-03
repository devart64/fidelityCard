<?php


namespace App\Controller;


use App\Entity\CarteDeFidelite;
use App\Entity\Client;
use App\Entity\User;
use PDO;
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
    public function profil()
    {
        $conn = $this->getDoctrine()->getConnection();
       $user = $this->getUser();
       $id = $user->getIdClient();
       $client = $this->getDoctrine()->getRepository(Client::class)->find($id);
       $carte = $this->getDoctrine()->getRepository(CarteDeFidelite::class)->findBy(['id_client' =>$id]);
       $IDcarte = $carte[0]->getId();
        $requete = "SELECT * FROM tampon  where id_carte_fidelite = ".$IDcarte;
        $statment= $conn->prepare($requete);
        $statment->execute();
        $statment->setFetchMode(PDO::FETCH_OBJ);

        $array = array();
        while ($data = $statment->fetch()) {
            $array[] = $data;
        }

        $tampons = $array;

        return $this->render('utilisateur/profil.html.twig', ['client' => $client, 'carte' => $carte, 'tampons' => $tampons]);
    }
}