<?php


namespace App\manager;

use App\Entity\Client;
use Twig\Environment;

class EmailManager
{
    /**
     * @var $connexion;
     */
    private $connexion;
    /**
     * @var \Swift_Mailer
     */
    private $mailer;
    /**
     * @var Environment
     */
    private $renderer;

    public function __construct( \Swift_Mailer $mailer, Environment $renderer)
    {


        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }

    /**
     * @param Client $client
     * @param $subject
     * @param $body
     */
    public function envoiEmail(Client $client, $subject, $body) {
        $emailClient = $client->getEmail();
        $message = (new \Swift_Message($subject))
            ->setFrom($emailClient)
            ->setTo('stephendupre64@gmail.com')
            ->setReplyTo($emailClient)
            ->setBody($body, ' text/html');
        $this->mailer->send($message);
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