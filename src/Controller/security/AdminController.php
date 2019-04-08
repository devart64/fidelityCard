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
     * @Route("/admin", name="admin")
     */
    public function admin()
    {

        return $this->render('administration/dashbord.html.twig');
    }


}