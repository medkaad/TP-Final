<?php

namespace App\Controller;

use App\Entity\Review;
use App\Form\ReviewType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ReviewController extends AbstractController
{
    /**
     * @Route("/review", name="list_review")
     */
    public function index(): Response
    {
        $data = $this->getDoctrine()->getRepository(Review::class)->findAll();
        return $this->render('review/index.html.twig', [
            'review' => $data,
        ]);
    }

    /**
     * @Route("/review/create", name="review_new")
     */
    public function create(Request $request)
    {
        $review = new Review();
        $form = $this->createForm(ReviewType::class,$review);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($review);
            $em->flush();
            $this->addFlash('notice','Submitted Successfully');
            return $this->redirectToRoute('list_review');
        }
        return $this->render('review/create.html.twig',[
            'form' => $form->createView()
        ]);
    }
}
