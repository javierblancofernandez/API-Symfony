<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Form\ReservaType;

use AppBundle\Entity\Reserva;
use AppBundle\Entity\Usuario;


    /**
     * @Route("/reservas")
     */
class GestionReservasController extends Controller
{

    /**
     * @Route("/nueva", name="nuevaReserva")
     */
    public function nuevaReservaAction(Request $request)
    {
       
        $reserva=new Reserva();
        //Construyendo el formulario
        $form = $this->createForm(ReservaType::class, $reserva);
        //Recogemos la informacion y almacena el formulario 
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //Rellenar el Entity tapa
           
            $usuario = $this->getUser();
            $reserva->setUsuario($usuario);
            
            $entityManager = $this->getDoctrine()->getManager();//coger el manager de doctrine que me permitira hacer cosas contra la DB
            $entityManager->persist($reserva);//decir al entity manager cual es el objeto que vamos a almacenar
            $entityManager->flush();//cerrar la conexion de la base de datos
            //return $this->render('test/test.html.twig'); 
            return $this->redirectToRoute('reservas');
        }
        //Capturar el repositorio de la TAbla contra la DB
        //$tapaRepository = $this->getDoctrine()->getRepository(Tapa::class);
        //$tapas = $tapaRepository->findAll();
        

        // replace this example code with whatever you need
        return $this->render('gestionTapas/nuevaReserva.html.twig',array('form' => $form->createView())
        );
    }

     /**
     * @Route("/reservas", name="reservas")
     */
    public function reservasAction(Request $request)
    {
        $repository =$this->getDoctrine()->getRepository(Reserva::class);
        $reservas =$repository->findAll();
        return $this->render('gestionTapas/reservas.html.twig',["reservas"=>$reservas]);
    }
}