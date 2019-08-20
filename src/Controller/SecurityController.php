<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Twig\Environment;

class SecurityController
{
    /** @var Environment */
    private $environement;

    /** @var FormFactory */
    private $formFactory;

    /** @var UrlGeneratorInterface */
    private $generator;

    /** @var FlashBagInterface */
    private $bag;

    public function __construct(
        Environment $environment,
        FormFactoryInterface $formFactory,
        UrlGeneratorInterface $generator,
        FlashBagInterface $bag
    ) {
        $this->environement = $environment;
        $this->formFactory = $formFactory;
        $this->generator = $generator;
        $this->bag = $bag;
    }

    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return new Response($this->environement->render('security/login.html.twig',
            ['last_username' => $lastUsername, 'error' => $error]));
    }

    /**
     * @Route("/inscription", name="registration")
     */
    public function registration(ObjectManager $manager, Request $request, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        $form = $this->formFactory->create(RegistrationType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if (!$user->getId()) {
                $user->setDatesub(new \DateTime());
            }
            $user->setGrade(1);
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);

            $manager->persist($user);
            $manager->flush();
            $this->bag->add('success', 'Votre inscription est ok');
            return new RedirectResponse($this->generator->generate('app_login'));

        }
        return new Response($this->environement->render('security/registration.html.twig', [
            'form' => $form->createView()
        ]));
    }

    /**
     * @Route("/logout", name="app_logout", methods={"GET"})
     */
    public function logout()
    {
        // controller can be blank: it will  never be executed!
        return new RedirectResponse($this->environement->render('home'));
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }

}
