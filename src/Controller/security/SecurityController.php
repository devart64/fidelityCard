<?php

namespace App\Controller\security;

use App\Entity\Client;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/connexion", name="connexion")
     */
    public function login(Request $request, AuthenticationUtils $authUtils)
    {
        // get the mogin efrrir if there is one
        $error = $authUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();
      
        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('connexion');
        }

        return $this->render(
            'security/register.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("/mot-de-passe{id}", defaults={"id"=null}, name="motdepasse")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registerPassword(Request $request, UserPasswordEncoderInterface $passwordEncoder, $id){

        if ($request->getMethod() === "POST") {
            $idUser = $request->request->get('id');

            $user = $this->getDoctrine()->getRepository(User::class)->find($idUser);
            $password = $passwordEncoder->encodePassword($user, $request->request->get('password'));
            $user->setPassword($password);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('connexion');
        } else {
            var_dump("on rentre ne get !!!");
            $user = $this->getDoctrine()->getRepository(User::class)->find($id);
            $username = $user->getUsername();
            $email = $user->getEmail();
            return $this->render('security/enregistrementmdp.html.twig', ['username' => $username, 'email' => $email, 'id' =>$id]);
        }


    }
}
