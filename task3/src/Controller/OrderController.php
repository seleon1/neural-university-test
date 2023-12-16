<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use App\Entity\Order;

class OrderController extends AbstractController
{
    #[Route('/orders', name: 'app_orders')]
    public function index(Request $request, PaginatorInterface $paginator, EntityManagerInterface $entityManager): Response
    {
        $query = $entityManager->getRepository(Order::class)->findAll();

        $orders = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10 // Количество записей на странице
        );

        return $this->render('order/index.html.twig', [
            'orders' => $orders,
        ]);
    }
}
