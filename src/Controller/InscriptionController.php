<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\CreationCompteType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Repository\LicencieRepository;
use App\Service\GestionContact;

/**
 * @Route("/inscription/", name="creation_")
 */
class InscriptionController extends AbstractController
{
    /**
     * @Route("compte", name="compte")
     * @throws \Exception
     */
    public function index(Request $request, EntityManagerInterface $manager, UserRepository $uRepo, UserPasswordEncoderInterface $encoder): Response
    {
        $compte = new User();
        $form = $this->createForm(CreationCompteType::class, $compte);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $username = $form->get('username')->getData();
            if ($uRepo->isUsernameExist($username) === 'ok') {
//                dd('ok');
                $this->addFlash('warning', 'Un compte est déjà créé avec ce pseudo');
            }
            else if ($uRepo->isMailExist($form->get('email')->getData()) === 'ok') {

                $this->addFlash('warning', 'Un compte est déjà créé avec cette adresse mail');
            }
            else {
                $mdp = $form->get('password')->getData();
                $vmdp = $form->get('confPassword')->getData();
                if ($mdp === $vmdp) {
                    $encoder = $encoder->encodePassword($compte, $mdp);
                    $compte->setPassword($encoder);
                    $compte->setconfPassword($encoder);
                    $compte->setBirthday(new \DateTime($_POST['birthday']));
                    isset($_POST['rgpd']) ? $compte->setIsRGPD(true) : $compte->setIsRGPD(false);
                    $compte->setRoles(["ROLE_USER"]);
//
//                    $compte->setActivationToken(md5(uniqid()));
//
//                    $token = $compte->getActivationToken();

                    $url = $this->generateUrl('home');
                    $url = 'https://localhost:8000' . $url;
                    GestionContact::send($compte->getEmail(), $compte->getUsername(), 'Activation de votre compte', '<p> Bonjour, </p>
                    <p>Vous vous êtes inscrit sur notre site, veuillez cliquer sur le lien ci-dessous pour l\'activer : </p>
                    <a href=' . $url . '> Activer votre compte </a>' , 'text/html');

                    $manager->persist($compte);
                    $manager->flush();




                    $this->addFlash('success', " Votre demande a bien été prise en compte ! Veuillez la valider par mail ! ");
                    return $this->redirectToRoute('home');

                } else {
                    $this->addFlash('warning', " Les mots de passes doivent êtres identiques !");
                };
            }
        }
        return $this->render('pages/Inscription/creationCompte.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("activation/{token}", name="activation")
     */
    public function activation($token, UserRepository $usersRepo)
    {
        $user = $usersRepo->findOneBy((['activation_token' => $token]));

        if (!$user) {
            throw $this->createNotFoundException('Cet utilisateur n\'existe pas');
        }

        $user->setActivationToken(null);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        $this->addFlash('success', 'Vous avez bien activé votre compte');

        return $this->redirectToRoute('app_login');
    }
}