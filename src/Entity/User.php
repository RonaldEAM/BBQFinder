<?php
// src/AppBundle/Entity/User.php

namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    protected $phone;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    protected $country;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    protected $zipCode;

    /**
     * @ORM\OneToMany(targetEntity="Barbecue", mappedBy="owner")
     * @var ArrayCollection
     */
    protected $ownedBarbecues;

    /**
     * @ORM\OneToMany(targetEntity="Rent", mappedBy="renter")
     * @var ArrayCollection
     */
    protected $rents;

    public function __construct()
    {
        parent::__construct();
        $this->ownedBarbecues = new ArrayCollection();
        $this->rents = new ArrayCollection();
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }
}