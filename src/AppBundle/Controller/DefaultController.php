<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use AppBundle\Entity\Tapa;
use AppBundle\Entity\Categoria;
use AppBundle\Entity\Ingrediente;

class DefaultController extends Controller
{
    /**
     * @Route("/{pagina}", name="homepage")
     */
    public function homeAction(Request $request,$pagina=1)
    {
       
        //Capturar el repositorio de la TAbla contra la DB
        $tapaRepository = $this->getDoctrine()->getRepository(Tapa::class);
        //$tapas = $tapaRepository->findByTop(1);
        /*$query = $this->createQueryBuilder('t')
        ->where('t.top = 1')
        ->setFirstResult($numTapas*($pagina-1))
        ->setMaxResults($numTapas)
        ->getQuery();*/
        //$tapas=$query->getResult();
        $tapas = $tapaRepository -> paginaTapas($pagina);
        // replace this example code with whatever you need
        return $this->render('frontal/index.html.twig',array('tapas'=>$tapas,'paginaActual'=>$pagina)
        );
    }

     /**
     * @Route("/nosotros", name="nosotros")
     */
    public function nosotrosAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('frontal/nosotros.html.twig'
        );
    }
     /**
     * @Route("/contactar/{sitio}", name="contactar")
     */
    public function contactarAction(Request $request,$sitio="todos")
    {
        // replace this example code with whatever you need
        return $this->render('frontal/bares.html.twig',array("sitio"=>$sitio)
        );
    }
      /**
     * @Route("/tapa/{id}", name="tapa")
     */
    public function tapaAction(Request $request,$id=null)
    {
        
        if($id!=null){
            $tapaRepository = $this->getDoctrine()->getRepository(Tapa::class);
            //nos devuelve un objeto con el id que le pasemos por la uri
            $tapa = $tapaRepository->find($id);
            // replace this example code with whatever you need
            return $this->render('frontal/tapa.html.twig',array("tapa"=>$tapa)
        );

        }else{
            return $this->redirectToRoute('homepage');
        }
        
    }
     /**
     * @Route("/categoria/{id}", name="categoria")
     */
    public function categoriaAction(Request $request,$id=null)
    {
        
        if($id!=null){
            $categoriaRepository = $this->getDoctrine()->getRepository(Categoria::class);
            //nos devuelve un objeto con el id que le pasemos por la uri
            $categoria = $categoriaRepository->find($id);
            // replace this example code with whatever you need
            return $this->render('frontal/categoria.html.twig',array("categoria"=>$categoria)
        );

        }else{
            return $this->redirectToRoute('homepage');
        }
        
    }
     /**
     * @Route("/ingrediente/{id}", name="ingrediente")
     */
    public function ingredienteAction(Request $request,$id=null)
    {
        
        if($id!=null){
            $ingredienteRepository = $this->getDoctrine()->getRepository(Ingrediente::class);
            //nos devuelve un objeto con el id que le pasemos por la uri
            $ingrediente = $ingredienteRepository->find($id);
            // replace this example code with whatever you need
            return $this->render('frontal/ingrediente.html.twig',array("ingrediente"=>$ingrediente)
        );

        }else{
            return $this->redirectToRoute('homepage');
        }
        
    }
          /**
     * @Route("/nuevaUsuario", name="registro")
     */
    public function registroAction(Request $request,UserPasswordEncoderInterface $passwordEncoder)
    {
       
        $usuario=new Usuario();
        //Construyendo el formulario
        $form = $this->createForm(UsuarioType::class, $usuario);
        //Recogemos la informacion y almacena el formulario 
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
          $password=$passwordEncoder->encodePassword($usuario,$usuario->getPlainPassword());
          $usuario->setPassword($password);
          //igualar username a email
          $usuario=setUsername($usuario->getEmail());

            $entityManager = $this->getDoctrine()->getManager();//coger el manager de doctrine que me permitira hacer cosas contra la DB
            $entityManager->persist($tapa);//decir al entity manager cual es el objeto que vamos a almacenar
            $entityManager->flush();//cerrar la conexion de la base de datos
            return $this->redirectToRoute('tapa',['id'=>$tapa->getId()]);
        }
        //Capturar el repositorio de la TAbla contra la DB
        //$tapaRepository = $this->getDoctrine()->getRepository(Tapa::class);
        //$tapas = $tapaRepository->findAll();
        

        // replace this example code with whatever you need
        return $this->render('gestionTapas/nuevaTapa.html.twig',array('form' => $form->createView())
        );
    }


    

}
