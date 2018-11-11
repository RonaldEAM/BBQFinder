<?php

namespace App\Controller;

use App\Entity\Barbecue;
use App\Entity\Rent;
use App\Form\BarbecueType;
use App\Form\RentType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BarbecueController extends AbstractController
{
    /** @var EntityManagerInterface */
    protected $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

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
            $this->entityManager->persist($barbecue);
            $this->entityManager->flush();

            $this->addFlash('success', 'Barbacoa publicada exitosamente.');

            return $this->redirectToRoute('barbecue_find', [
                'country' => $this->getUser()->getCountry(),
                'zipCode' => $this->getUser()->getZipCode(),
            ]);
        }

        return $this->render('barbecue-publish.html.twig', [
            'country' => $user->getCountry(),
            'zipCode' => $user->getZipCode(),
        ]);
    }

    /**
     * @Route("/barbecue/{country}/{zipCode}", name="barbecue_find")
     */
    public function findBarbecues(string $country, string $zipCode)
    {
        $barbecues = $this->getDoctrine()
            ->getRepository(Barbecue::class)
            ->findBy(['zipCode' => $zipCode]);

        return $this->render('barbecue-find.html.twig', [
            'country' => $country,
            'zipCode' => $zipCode,
            'barbecues' => $barbecues,
        ]);
    }

    /**
     * @Route("/barbecues/check", name="barbecue_check")
     */
    public function checkBarbecues(Request $request)
    {
        $country = $request->query->get('country');
        $zipCode = $request->query->get('zipCode');

        return $this->findBarbecues($country, $zipCode);
    }

    /**
     * @Route("/barbecue/{id}", name="barbecue_rent")
     */
    public function rentBarbecue(Request $request, string $id)
    {
        $barbecue = $this->getDoctrine()
            ->getRepository(Barbecue::class)
            ->findOneBy(['id' => $id]);

        $this->denyAccessUnlessGranted('rent', $barbecue);

        $rent = new Rent($this->getUser(), $barbecue);
        $form = $this->createForm(RentType::class, $rent);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($rent);
            $this->entityManager->flush();

            $this->addFlash('success', 'Barbacoa rentada exitosamente.');

            return $this->redirectToRoute('rent_history');
        }

        return $this->render('barbecue-rent.html.twig', [
            'barbecue' => $barbecue,
            'form' => $form->createView(),
        ]);
    }
}