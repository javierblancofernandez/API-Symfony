<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Tapa;
use AppBundle\Entity\Categoria;
use AppBundle\Entity\Ingrediente;
use AppBundle\Form\TapaType;
use AppBundle\Form\CategoriaType;
use AppBundle\Form\IngredienteType;

    /**
     * @Route("/gestionTapas")
     */
class GestionTapasController extends Controller
{

       /**
     * @Route("/nuevaTapa", name="nuevaTapa")
     */
    public function nuevaTapaAction(Request $request)
    {
       
        $tapa=new Tapa();
        //Construyendo el formulario
        $form = $this->createForm(TapaType::class, $tapa);
        //Recogemos la informacion y almacena el formulario 
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //Rellenar el Entity tapa
           
            $tapa = $form->getData();
            $fotoFile=$tapa->getFoto();
            $fileName = $this->generateUniqueFileName().'.'.$fotoFile->guessExtension();
            $fotoFile->move($this->getparameter('tapaImg_directory'),$fileName);
            //var_dump($fileName);
            $tapa->setFoto($fileName);
            $tapa->setFechaCreacion(new \DateTime());

            //Almacenar nueva tapa
            $entityManager = $this->getDoctrine()->getManager();//coger el manager de doctrine que me permitira hacer cosas contra la DB
            $entityManager->persist($tapa);//decir al entity manager cual es el objeto que vamos a almacenar
            $entityManager->flush();//cerrar la conexion de la base de datos
            //return $this->render('test/test.html.twig'); 
            return $this->redirectToRoute('tapa',['id'=>$tapa->getId()]);
        }
        //Capturar el repositorio de la TAbla contra la DB
        //$tapaRepository = $this->getDoctrine()->getRepository(Tapa::class);
        //$tapas = $tapaRepository->findAll();
        

        // replace this example code with whatever you need
        return $this->render('gestionTapas/nuevaTapa.html.twig',array('form' => $form->createView())
        );
    }

       /**
     * @Route("/nuevaCategoria", name="nuevaCategoria")
     */
    public function nuevaCatAction(Request $request)
    {
        $categoria=new Categoria();
        //Construyendo el formulario
        $form = $this->createForm(CategoriaType::class,$categoria);
        //Recogemos la informacion y almacena el formulario 
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //Rellenar el Entity tapa
           
            $categoria = $form->getData();
            $fotoFile=$categoria->getFoto();
            $fileName = $this->generateUniqueFileName().'.'.$fotoFile->guessExtension();
            $fotoFile->move($this->getparameter('tapaImg_directory'),$fileName);
            //var_dump($fileName);
            $categoria->setFoto($fileName);
            

            //Almacenar nueva categoria
            $entityManager = $this->getDoctrine()->getManager();//coger el manager de doctrine que me permitira hacer cosas contra la DB
            $entityManager->persist($categoria);//decir al entity manager cual es el objeto que vamos a almacenar
            $entityManager->flush();//cerrar la conexion de la base de datos
            //return $this->render('test/test.html.twig'); 
            return $this->redirectToRoute('categoria',['id'=>$categoria->getId()]);
        }
        //Capturar el repositorio de la TAbla contra la DB
        //$tapaRepository = $this->getDoctrine()->getRepository(Tapa::class);
        //$tapas = $tapaRepository->findAll();
        

        // replace this example code with whatever you need
        return $this->render('gestionTapas/nuevaCategoria.html.twig',array('form' => $form->createView())
        );
    }
       /**
     * @Route("/nuevoIngrediente", name="nuevoIngrediente")
     */
    public function nuevaIngrAction(Request $request)
    {
        $ingrediente=new Ingrediente();
        //Construyendo el formulario
        $form = $this->createForm(IngredienteType::class,$ingrediente);
        //Recogemos la informacion y almacena el formulario 
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //Rellenar el Entity tapa
           
            $ingrediente = $form->getData();         

            //Almacenar nueva categoria
            $entityManager = $this->getDoctrine()->getManager();//coger el manager de doctrine que me permitira hacer cosas contra la DB
            $entityManager->persist($ingrediente);//decir al entity manager cual es el objeto que vamos a almacenar
            $entityManager->flush();//cerrar la conexion de la base de datos
            //return $this->render('test/test.html.twig'); 
            return $this->redirectToRoute('ingrediente',['id'=>$ingrediente->getId()]);
        }
       
        // replace this example code with whatever you need
        return $this->render('gestionTapas/nuevoIngrediente.html.twig',array('form' => $form->createView())
        );
    }

    /**
     * @return string
     */
    private function generateUniqueFileName(){
        
        return md5(uniqid());
    }

    

}