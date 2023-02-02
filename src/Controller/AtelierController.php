<?php

namespace App\Controller;

use App\Entity\Atelier;
use App\Entity\Participation;
use App\Form\AtelierFormType;
use App\Form\ParticiperFormType;
use App\Repository\AtelierRepository;
use App\Repository\LyceenRepository;
use App\Repository\ParticipationRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AtelierController extends AbstractController
{

    #[Route('/list_atelier', name: 'app_list_atelier')]
    public function listAteliers(AtelierRepository $atelierRepository): Response
    {
        $ateliers = $atelierRepository->findAll();
       //dd($ateliers);
        return $this->render('atelier/list.html.twig', [
            'ateliers' => $ateliers, 
        ]);
    }


    #[Route('/detail_atelier/{id}', name: 'app_detail_atelier')]
    public function detailAtelier(Request $request,$id, AtelierRepository $atelierRepository, EntityManagerInterface $entityManager){
        $atelier = $atelierRepository->find($id);

        //traitement avec le bouton participation
        $participe = new Participation();
        $form = $this->createForm(ParticiperFormType::class, $participe);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $participe->setAtelier($atelier);
            $participe->setUser($this->getUser());

            $entityManager->persist($participe);
            $entityManager->flush();
            

            $this->addFlash('success', 'Inscription effectué avec succès');           
        }

        return $this->render('atelier/detail.html.twig', [
            'atelier' => $atelier,
            'form' => $form->createView(),
        ]);
    }


   
}
