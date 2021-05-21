<?php

namespace App\Controller;

use App\Entity\Brands\Farmitoo;
use App\Entity\Brands\Gallagher;
use App\Entity\Country;
use App\Entity\Item;
use App\Entity\Order;
use App\Entity\Product;
use App\Entity\Promotion;
use App\Entity\Rules\QuantityRule;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CartController
 * @package App\Controller
 */
class CartController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"})
     */
    public function show(): Response
    {
        // Je passe une commande avec
        // Cuve à gasoil x1
        // Nettoyant pour cuve x3
        // Piquet de clôture x5
        $order = new Order();
        $country = new Country('fr');
        $brand1 = new Farmitoo(1, 'Farmitoo', $country);
        $brand2 = new Gallagher(2, 'Gallagher', $country);

        $product1 = new Product(1, 'Cuve à gasoil', 2500, $brand1);
        $item1 = new Item($product1);
        $order->addItem($item1);

        $product2 = new Product(2, 'Nettoyant pour cuve', 50, $brand1);
        $promotion1 = new Promotion(1, 8);
        $promotion1->addRule(new QuantityRule(1, 3));
        $product2->setPromotion($promotion1);
        $item2 = new Item($product2);
        $item2->addQuantity(2);
        $order->addItem($item2);

        $product3 = new Product(3, 'Piquet de clôture', 10, $brand2);
        $promotion2 = new Promotion(2, 25);
        $promotion2->addRule(new QuantityRule(2, 5));
        $product3->setPromotion($promotion2);
        $item3 = new Item($product3);
        $item3->addQuantity(4);
        $order->addItem($item3);

        return $this->render('cart/show.html.twig', [
            'order' => $order,
        ]);
    }
}
