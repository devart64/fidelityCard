<?php


namespace App\manager;

use App\Entity\Client;

class EmailManager
{
    /**
     * @var $connexion;
     */
    private $connexion;

    public function __construct( $connexion)
    {
        $this->connexion = $connexion;
    }

    /**
     * @param Client $client
     */
    public function envoiEmail(Client $client, $subject, $message) {
        $emailClient = $client->getEmail();
        mail($emailClient, $subject, $message);
        var_dump("email envoyé");
    }

    public function emailPizzaGratuite(Client $client) {
        $subject = "Votre prochaine Pizza sera gratuite !";
        $message = "
            Chèr client, <br/>
            Nous avons le plaisir de vous informer que votre prochaine Pizza chez Entre Nous Comptoir A Pizza
            sera gratuite.
            Alors à très bientôt";
        $this->envoiEmail($client, $subject, $message);
    }
}