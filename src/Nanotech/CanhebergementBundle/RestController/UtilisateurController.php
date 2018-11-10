<?php

namespace Nanotech\CanhebergementBundle\RestController;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nanotech\CanhebergementBundle\Entity\Utilisateur;
use Nanotech\CanhebergementBundle\Form\UtilisateurType;


/**
 * Utilisateur controller.
 *
 */
class UtilisateurController extends Controller
{
    /**
     * @Rest\View()
     * @Rest\Get("/")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb->select('s')
            ->from('DigitPressBundle:Article', 's');
        $qb->orderBy('s.page', 'desc');

        $entities = $qb->getQuery()->getResult();
        return $entities;
    }


    /**
     * @Rest\View()
     * @Rest\Get("/{username}")
     */
    public function findAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $utilisateur = $em->getRepository('DigitPressBundle:Utilisateur')->findOneByUsername($request->get('username'));
        if (empty($utilisateur)) {
            $reponse = new JsonResponse(array('message' => "contenu introuvable"), Response::HTTP_INTERNAL_SERVER_ERROR);
            $reponse->setEncodingOptions(JSON_UNESCAPED_UNICODE);
            return $reponse;
        }
        return $utilisateur;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/create")
     */
    public function createAction(Request $request)
    {
         
        //ecrire la creation d'un utilisateur
        $data = json_decode($request->getContent(), true);
        $email = $request->request->get('email'); 
        $nom = $request->request->get('nom');
        $prenom = $request->request->get('prenom');
        $password = $request->request->get('password');      
        $pseudo = $request->request->get('pseudo');
        $telephone = $request->request->get('telephone');
        $succesfullyRegistered = $this->register($email,$pseudo,$password,$nom,$prenom,$telephone);

        return $succesfullyRegistered;

    }
	
private function register($email,$username,$password,$nom,$prenom,$telephone){    
	$em = $this->getDoctrine()->getManager();
	$usersRepository = $em->getRepository("DigitPressBundle:Utilisateur");        
	

	// or use directly the namespace and the name of the class 
	// $usersRepository = $em->getRepository("mybundle\userBundle\Entity\User");
	$email_exist = $usersRepository->findOneBy(array('email' => $email));
	$username_exist = $usersRepository->findOneBy(array('username' => $username)); 


	// Check if the user exists to prevent Integrity constraint violation error in the insertion
	if($email_exist){
		 $result = new JsonResponse(array('code' => "Email déjà utilisé"), Response::HTTP_INTERNAL_SERVER_ERROR);
		 $result->setEncodingOptions(JSON_UNESCAPED_UNICODE);
		 return $result;
	}
	if($username_exist){
		 $result = new JsonResponse(array('code' => "Pseudo déjà utilisé"), Response::HTTP_INTERNAL_SERVER_ERROR);
		 $result->setEncodingOptions(JSON_UNESCAPED_UNICODE);
		 return $result;
	}
	$userManager = $this->get('fos_user.user_manager');
	$user = $userManager->createUser();
	//$user = new Utilisateur();
	$user->setTelephone($telephone);
	$user->setNom($nom);
	$user->setPrenom($prenom);
	$user->setUsername($username);
	$user->setEmail($email);
	$user->setEmailCanonical($email);
	$user->setEnabled(1); // enable the user or enable it later with a confirmation token in the email
	$user->setPlainPassword($password); // this method will encrypt the password with the default settings :)
	$userManager->updateUser($user);
	
	$result = new JsonResponse(array('code' => 0), Response::HTTP_CREATED);
	$result->setEncodingOptions(JSON_UNESCAPED_UNICODE);
	return $result;
}

    

       /* $entity = new Article();
        $form = $this->createForm(ArticleType::class, $entity);

        $data = json_decode($request->getContent(), true);
        $form->submit($data, true); // Validation des données
        //$form->handleRequest($this->getRequest());
        $parutionId = $data['parution']['id'];

        $em = $this->getDoctrine()->getManager();
        $parution = $em->getRepository('EpresseBundle:Parution')->find($parutionId);

        if (empty($parution)) {
            $reponse = new JsonResponse(array('message' => "la parution est obligatoire"), Response::HTTP_INTERNAL_SERVER_ERROR);
            $reponse->setEncodingOptions(JSON_UNESCAPED_UNICODE);
            return $reponse;
        }
        try {
            $rubriqueId = $data['rubrique']['id'];
            $rubrique = $em->getRepository('EpresseBundle:Rubrique')->find($rubriqueId);

            $entity->setRubrique($rubrique);


        } catch (\Exception $e) {
        }

        $entity->setParution($parution);
        $em->persist($entity);
        $em->flush();
        return $entity;*/


    

    /**
     * @Rest\View()
     * @Rest\Put("/update/{id}")
     */
    public function updateAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('EpresseBundle:Parution')->find($request->get('id'));
        if (empty($entity)) {
            $reponse = new JsonResponse(array('message' => "contenu introuvable"), Response::HTTP_INTERNAL_SERVER_ERROR);
            $reponse->setEncodingOptions(JSON_UNESCAPED_UNICODE);
            return $reponse;
        }
        $form = $this->createForm(ParutionType::class, $entity);
        $data = json_decode($request->getContent(), true);
        $form->submit($data, true); // Validation des données
        $presseId = $data['presse']['id'];

        $photo = $entity->getFichier();

        try {
            if ($photo) {
                $photo = explode(',', $photo);
                $extension = str_replace('data:application/', '', $photo[0]);
                $extension = str_replace(';base64', '', $extension);
                $sourcename = $this->getParameter('web_dir') . '/document/parution/' . uniqid() . '.' . $extension;
                $file = fopen($sourcename, 'w+');
                fwrite($file, base64_decode($photo[1]));
                fclose($file);
                $entity->setFichier($sourcename);
            }
        } catch (Exception $e) {
            $reponse = new JsonResponse(array('message' => "2"), Response::HTTP_INTERNAL_SERVER_ERROR);
            $reponse->setEncodingOptions(JSON_UNESCAPED_UNICODE);
            return $reponse;
        }

        try {
            $em = $this->getDoctrine()->getManager();
            $presse = $em->getRepository('EpresseBundle:Presse')->find($presseId);

            if (empty($presse)) {
                $reponse = new JsonResponse(array('message' => "la presse est obligatoire"), Response::HTTP_INTERNAL_SERVER_ERROR);
                $reponse->setEncodingOptions(JSON_UNESCAPED_UNICODE);
                return $reponse;
            }
            $entity->setDateParution(new \DateTime($data['dateParution']));
            $entity->setPresse($presse);
            $em->merge($entity);
            $em->flush();
            return $entity;
        } catch (\Doctrine\DBAL\Exception\NotNullConstraintViolationException $e) {
            $reponse = new JsonResponse(array('message' => "certains champs ne sont pas corrects ou sont vides"), Response::HTTP_INTERNAL_SERVER_ERROR);
            $reponse->setEncodingOptions(JSON_UNESCAPED_UNICODE);
            return $reponse;
        }
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/delete/{id}")
     */
    public function removeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('EpresseBundle:Article')
            ->find($request->get('id'));

        if ($entity) {
            try {
                $em->remove($entity);
                $em->flush();
            } catch (\Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException $e) {
                $reponse = new JsonResponse(array('message' => "ce contenu est utilisé ailleurs"), Response::HTTP_INTERNAL_SERVER_ERROR);
                $reponse->setEncodingOptions(JSON_UNESCAPED_UNICODE);
                return $reponse;
            }
        }
    }




   

}
