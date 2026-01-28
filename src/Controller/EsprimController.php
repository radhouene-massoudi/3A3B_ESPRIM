<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

//#[Route('/muser')]

final class EsprimController extends AbstractController
{
    #[Route('/add')]
    public function index(): Response
    {
        $users="test";
        return $this->render('esprim/index.html.twig', [
            //'controller_name' => 'EsprimController',
            'u'=>$users
        ]);
    }
     #[Route('/test')]
    public function showMsg(){
        return new Response('<h1>bonjour à tous</h1>');
    }

     #[Route('/html')]
    public function showMsgHtml(){
        return $this->render("myFirstVue/newhtml.html");
    }
     #[Route('/json')]
     public function showMsgjson(){
        return new JsonResponse('test une api');
    }
      #[Route('/twig')]
    public function twig(){
        $author = array(
array('id' => 1, 'picture' => '/images/Victor-Hugo.jpg','username' => 'Victor Hugo', 'email' =>
'victor.hugo@gmail.com ', 'nb_books' => 100),
array('id' => 2, 'picture' => '/images/william-shakespeare.jpg','username' => ' William Shakespeare', 'email' =>
' william.shakespeare@gmail.com', 'nb_books' => 200 ),
array('id' => 3, 'picture' => '/images/Taha_Hussein.jpg','username' => 'Taha Hussein', 'email' =>
'taha.hussein@gmail.com', 'nb_books' => 300),
);
return $this->render('twig/td.html.twig',
[
"authors"=>$author
]);
    }

    #[Route('/detail/{t}',name:'det')]
    public function detail($t): Response
    {
        return  $this->render('twig/test.html.twig',[
            'idOfUser'=>$t
        ]);
    }
}
