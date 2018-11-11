<?php

namespace App\Repository;

use App\Entity\Barbecue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Barbecue|null find($id, $lockMode = null, $lockVersion = null)
 * @method Barbecue|null findOneBy(array $criteria, array $orderBy = null)
 * @method Barbecue[]    findAll()
 * @method Barbecue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BarbecueRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Barbecue::class);
    }
}
