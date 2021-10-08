<?php

namespace App\Controller;

// use App\Entity\User;
use App\Entity\Consommateur;
use App\Entity\Producteur;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{

    /**
     * @Route("/{userType}/register/", name="app_register")
     */
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasherInterface, string $userType): Response
    {

        if($userType == 'consommateur'){
            $user = new Consommateur();
            $user->setRoles(["ROLE_CONSOMMATEUR"]);
        }
        else
        {
            $user = new Producteur();
            $user->setRoles(["ROLE_PRODUCTEUR"]);
        }

        dump($user);

        $userType = ucfirst($userType);
      
        $form = $this->createForm(RegistrationFormType::class, $user, ['data_class' => "App\Entity"."\\".$userType]);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            // encode the plain password
            $user->setPassword(
            $userPasswordHasherInterface->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
