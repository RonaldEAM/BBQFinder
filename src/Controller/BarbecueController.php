<?php

namespace App\Controller;

use App\Entity\Barbecue;
use App\Form\BarbecueType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BarbecueController extends AbstractController {

    /**
     * @Route("/barbecue/publish", name="barbecue_publish")
     */
    public function publish(Request $request)
    {
        $user = $this->getUser();
        $barbecue = new Barbecue($user);
        $form = $this->createForm(BarbecueType::class, $barbecue);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($barbecue);
            $entityManager->flush();

            $this->addFlash('success', 'Yay, you just registered a new barbecue');
        }

        return $this->render('barbecue-publish.html.twig', [
            'country' => $user->getCountry(),
            'zipCode' => $user->getZipCode(),
        ]);
    }
}