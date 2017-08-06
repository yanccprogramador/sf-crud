<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Frases;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

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
        $frases->setFrase($request->get('fraseSalvar'));
        $em->persist($frases);

        $em->flush();
        // replace this example code with whatever you need
        return $this->redirectToRoute('homepage');
    }
    /**
     * @Route("/apagar/{id}", name="apagando")
     */
    public function apagar($id){
        $em=$this->getDoctrine()->getManager();
        $frase=new Frases();
        $em2= $this->getDoctrine()
            ->getRepository(Frases::class);
        $frase=$em2->find($id);
        $em->remove($frase);
        $em->flush();

        return $this->redirectToRoute('homepage');
    }

}
