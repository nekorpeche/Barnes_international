<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\Type\FiType;
use App\Entity\Bien;


use Symfony\Component\HttpFoundation\Request;

class DefaultController extends AbstractController
{

    public function index(Request $request): Response
    {
        $type = null;
  
        
        $biens = $this->getDoctrine()
                -> getRepository(Bien::class)
                ->findAll();
        
        $form = $this->createForm(FiType::class);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

        $type = $form->get('types')->getData();
        $id = $type->getId();
        
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Bien::class);
        $biens = $repository->createQueryBuilder('u')
            ->innerJoin('u.types', 't')
            ->where('t.id = :type_id')
            ->setParameter('type_id', $id)
            ->getQuery()->getResult();
        }
        
        return $this->render('index.html.twig', [
            'type'=>$type,'biens' => $biens,'form' =>$form->createView(),
        ]);
    }
}