<?php

namespace App\Controller;
use App\Entity\Restaurant;
use App\Entity\Review;
use App\Form\RestaurantType;
use App\Entity\City;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class RestaurantController extends AbstractController
{
    /**
     * @Route("/", name="list_restaurant")
     */
    public function restaurants(Request $request): Response
    {
        $data = $this->getDoctrine()->getRepository(Restaurant::class)->findAll();
        return $this->render('restaurant/restaurants.html.twig', [
            'restaurants' => $data,
        ]);
    }

    /**
     * @Route("/restaurant/create", name="restaurant_new")
     */
    public function create(Request $request)
    {
        $restaurant = new Restaurant();
        $form = $this->createForm(RestaurantType::class,$restaurant);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($restaurant);
            $em->flush();
            $this->addFlash('notice','Submitted Successfully');
            return $this->redirectToRoute('list_restaurant');
        }
        return $this->render('restaurant/create.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/find")
     */
    public function afficherRest()
    {
        return $this->render('restaurant/restaurants.html.twig', [
            'restaurants' => $this->getDoctrine()->getRepository(Restaurant::class)->findLastSElements(),
        ]);
    }

    /**
    * @Route("/meilleur", name="app_index", methods={"GET"})
    */
    public function Meilleur()
    {
        $tenBestRestaurantsId = $this->getDoctrine()->getRepository(Review::class)->findBestTenRatings();

        $tenBestRestaurants = array_map(function($data) {
            return $this->getDoctrine()->getRepository(Restaurant::class)->find($data['restaurantId']);
        }, $tenBestRestaurantsId);
        $tenBestRestaurants = [];
        foreach($tenBestRestaurantsId as $data) {
            $tenBestRestaurants[] = $this->getDoctrine()->getRepository(Restaurant::class)->find($data['restaurantId']);
        }
        return $this->render('restaurant/index.html.twig', [
            'restaurants' => $tenBestRestaurants,
        ]);
    }




}
