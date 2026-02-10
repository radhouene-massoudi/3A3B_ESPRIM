<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use DateTimeImmutable;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }
    
    #[Route('/list', name: 'list')]
    public function list(ProductRepository $repo): Response
    {
        $l=$repo->findAll();
        dd($l);
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }
    #[Route('/l', name: 'l')]
    public function lists(ManagerRegistry $mr): Response
    {

    $em=$mr->getRepository(Product::class);
       
        //dd($em->findAll());
        $result=$em->findAll();
        return $this->render('product/list.html.twig', [
            'results'=>$result
        ]);
    }

    #[Route('/ad', name: 'ad')]
    public function add(ManagerRegistry $mr): Response
    {
$p=new Product();
    $em=$mr->getManager(); 
$p->setName("test");
$p->setDescription("fkgndfklgdfkgfd");
$p->setCreatedAt(new DateTimeImmutable('now'));
        $em->persist($p);
        $em->flush();
        dd('added');

        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }

     #[Route('/d/{r}', name: 'd')]
    public function detail(ProductRepository $repo,$r): Response
    {
$result=$repo->findById($r);
return $this->render('product/detail.html.twig',[
    'd'=>$result[0]
]);

    }
    #[Route('/addp', name: 'addp')]
    public function addProduct(ManagerRegistry $mr,Request $req)
    {
        $p=new Product();
        $form=$this->createForm(ProductType::class,$p);
        $form->handleRequest($req);
        $em=$mr->getManager();
        if($form->isSubmitted()){
$em->persist($p);
        $em->flush();
        return $this->redirectToRoute('l');
        }
        return $this->render('product/addproduct.html.twig',[
          'f'=>$form  
        ]);


    }
}
