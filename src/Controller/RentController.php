<?php

namespace App\Controller;

use App\Entity\Rent;
use Doctrine\ORM\EntityManagerInterface; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RentController extends AbstractController
{
    /** @var EntityManagerInterface */
    protected $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/rent/history", name="rent_history")
     */
    public function history()
    {
        $rents = $this->getDoctrine()
            ->getRepository(Rent::class)
            ->findBy(['renter' => $this->getUser()->getId()], ['id' => 'DESC']);

        return $this->render('rent-history.html.twig', ['rents' => $rents]);
    }

}