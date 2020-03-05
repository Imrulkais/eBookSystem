<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\Type\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/registration")
     */
    public function registration(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = new User();
            $email = $form["email"]->getData();
            $userPassword = $form["password"]->getData();
            $encodedPassword = $encoder->encodePassword($user, $userPassword);
            $entityManager = $this->getDoctrine()->getManager();
            $user->setEmail($email);
            $user->setPassword($encodedPassword);
            $user->setRoles($form["roles"]->getData());
            // tell Doctrine you want to (eventually) save the User (no queries yet)
            $entityManager->persist($user);
            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();
            return $this->redirectToRoute('registrationUser');
        }
        return $this->render('registration.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
