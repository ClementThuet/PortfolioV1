<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Entity\Ecriture;
use App\Form\EcritureType;
use App\Form\EditEcritureType;
use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Form\EditCategorieType;
use App\Entity\Parametres;

class PortfolioController extends Controller{
    
    public function index()
    {
        return $this->render('index2.html.twig');
    }
    public function comptabilite()
    {
        return $this->render('menuComptabilite.html.twig');
    }
    
    public function menuComptabilite( Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $parametre = $em->getRepository(Parametres::class)->findBy(array('nom' => 'soldeCompte'));
        $soldeCompte=$parametre[0]->getValeur();
        $listEcritures = $em->getRepository(Ecriture::class)->findAll();
        $listCategories = $em->getRepository(Categorie::class)->findAll();
        $sommeEcritures=0;
        for($i=0;$i<count($listEcritures);$i++){
            if($listEcritures[$i]->getSensflux() == 1)
            {
                $sommeEcritures+=$listEcritures[$i]->getMontant();
            }
            elseif ($listEcritures[$i]->getSensflux() == 0)
            {
                $sommeEcritures-=$listEcritures[$i]->getMontant();
            }
        } 
        return $this->render('Comptabilite/menuComptabilite.html.twig', array(
            'soldeCompte'=>$soldeCompte,
            'listEcritures'=>$listEcritures,
            'listCategories'=>$listCategories,
            'sommeEcritures'=>$sommeEcritures));
    }
  
    public function ajouterEcriture(Request $request)
    {
        $ecriture = new Ecriture();
        $form = $this->createForm(EcritureType::class, $ecriture);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ecriture);
            $em->flush();
            
            return $this->redirectToRoute('menu_comptabilite',array('page'=>1));
        }
        return $this->render('Comptabilite/ajouterEcriture.html.twig', array(
          'form' => $form->createView()
        ));
    }
    
    public function editerEcriture($id, Request $request){
        
        $em = $this->getDoctrine()->getManager();
        $ecriture = $em->getRepository(Ecriture::class)->find($id);
        
        if (null === $ecriture) {
            throw new NotFoundHttpException("Le  ecriture d'id ".$id." n'existe pas.");
        }
        $form = $this->get('form.factory')->create(EditEcritureType::class, $ecriture);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) 
        {
            $em->flush();
            return $this->redirectToRoute('menu_comptabilite');
        }
        return $this->render('Comptabilite/editerEcriture.html.twig', array(
            'ecriture' => $ecriture,
            'form'   => $form->createView(),
        )); 
    }
    
    public function supprimerEcriture($id, Request $request ){
        
        $em = $this->getDoctrine()->getManager();
        $ecriture = $em->getRepository(Ecriture::class)->find($id);
        
        if (null === $ecriture) {
            throw new NotFoundHttpException("Le  patient d'id ".$id." n'existe pas.");
        }
        // On crée un formulaire vide, qui ne contiendra que le champ CSRF
        $form = $this->get('form.factory')->create();
       
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
          $em->remove($ecriture);
          $em->flush();
            
          $request->getSession()->getFlashBag()->add('info', "Le ecriture a bien été supprimé.");

          return $this->redirectToRoute('menu_comptabilite');
        }

        return $this->render('Comptabilite/supprimerEcriture.html.twig', array(
          'ecriture' => $ecriture,
          'form'   => $form->createView(),
        ));
    }
    
    public function ajouterCategorie(Request $request)
    {
        
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);
       
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
           
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();
            
            return $this->redirectToRoute('menu_comptabilite',array('page'=>1));
        }
        return $this->render('Comptabilite/ajouterCategorie.html.twig', array(
          'form' => $form->createView()
        ));
    }
    
    public function editerCategorie($id, Request $request){
        
        $em = $this->getDoctrine()->getManager();
        $categorie = $em->getRepository(Categorie::class)->find($id);
        
        if (null === $categorie) {
            throw new NotFoundHttpException("Le  ecriture d'id ".$id." n'existe pas.");
        }
        $form = $this->get('form.factory')->create(EditCategorieType::class, $categorie);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) 
        {
            $em->flush();
            return $this->redirectToRoute('menu_comptabilite');
        }
        return $this->render('Comptabilite/editerCategorie.html.twig', array(
            'categorie' => $categorie,
            'form'   => $form->createView(),
        )); 
    }
    public function supprimerCategorie($id, Request $request ){
        
        $em = $this->getDoctrine()->getManager();
        $categorie = $em->getRepository(Categorie::class)->find($id);
        
        if (null === $categorie) {
            throw new NotFoundHttpException("Le  Categorie d'id ".$id." n'existe pas.");
        }
        // On crée un formulaire vide, qui ne contiendra que le champ CSRF
        $form = $this->get('form.factory')->create();
       
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
          $em->remove($categorie);
          $em->flush();
            
          $request->getSession()->getFlashBag()->add('info', "Le Categorie a bien été supprimé.");

          return $this->redirectToRoute('menu_comptabilite');
        }

        return $this->render('Comptabilite/supprimerCategorie.html.twig', array(
          'categorie' => $categorie,
          'form'   => $form->createView(),
        ));
    }
    
   /* public function rechercheParMois($mois)
    {
        $annee=date('Y');
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository(Ecriture::class)->findByMonth($mois,$annee);
        $query = $qb->getQuery();
        $listEcritures = $query->getResult();
        
        return $this->render('Comptabilite/menuComptabilite.html.twig', array(
            'listEcritures'=>$listEcritures));
    }*/
   
    
    public function rechercheEntreDatesFlux($date1,$date2,$sensflux)
    {
        $date1 = date("Y-m-d", strtotime($date1));
        $date2 = date("Y-m-d", strtotime($date2));
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository(Ecriture::class)->findBetweenTwoDatesFlux($date1,$date2,$sensflux);
        $query = $qb->getQuery();
        $listEcritures = $query->getResult();
        $listCategories = $em->getRepository(Categorie::class)->findAll();
        
        return $this->render('Comptabilite/menuComptabilite.html.twig', array(
            'listEcritures'=>$listEcritures,
            'listCategories'=>$listCategories));
    }
    
    public function rechercheEntreDates($date1,$date2)
    {
        $date1 = date("Y-m-d", strtotime($date1));
        $date2 = date("Y-m-d", strtotime($date2));
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository(Ecriture::class)->findBetweenTwoDates($date1,$date2);
        $query = $qb->getQuery();
        $listEcritures = $query->getResult();
        $listCategories = $em->getRepository(Categorie::class)->findAll();
        
        return $this->render('Comptabilite/menuComptabilite.html.twig', array(
            'listEcritures'=>$listEcritures,
            'listCategories'=>$listCategories));
    }
    
    public function rechercheCategorieEntreDates($date1,$date2,$categorie)
    {
        $date1 = date("Y-m-d", strtotime($date1));
        $date2 = date("Y-m-d", strtotime($date2));
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository(Ecriture::class)->findCategorieBetweenTwoDates($date1,$date2,$categorie);
        $query = $qb->getQuery();
        $listEcritures = $query->getResult();
        $listCategories = $em->getRepository(Categorie::class)->findAll();
        
        return $this->render('Comptabilite/menuComptabilite.html.twig', array(
            'listEcritures'=>$listEcritures,
            'listCategories'=>$listCategories));
    }
}