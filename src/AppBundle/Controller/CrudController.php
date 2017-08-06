<?php

namespace AppBundle\Controller;

use Doctrine\Bundle\DoctrineBundle\Entity\Frases;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CrudController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request){
        $em = $this->getDoctrine()
            ->getRepository(Frases::class);
        $frases=$em->findAll();

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'frases' =>$frases
        ]);
    }
    /**
     * @Route("/salvar", name="salvando")
     */
    public function salvar(Request $request){
        $em=$this->getDoctrine()->getManager();
        $frases=new Frases();
        $frases=$request;
        $em->persist($frases);

        $em->flush();
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig');
    }

}
