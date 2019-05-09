<?php


namespace App\Controller\email;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmailController extends AbstractController
{
    /**
     * @Route("/tableaudebord", name="envoiemail")
     * @param Request $request
     * @return Response
     */
    public function envoiEmail(Request $request){
        return new Response("");
    }
}