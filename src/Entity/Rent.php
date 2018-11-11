<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RentRepository")
 * @UniqueEntity(fields={"barbecue", "date"}, message="Esta fecha ya ha sido reservada.")
 */
class Rent
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @var int
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="rents")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * @var User
     */
    protected $renter;

    /**
     * @ORM\ManyToOne(targetEntity="Barbecue", inversedBy="rents")
     * @ORM\JoinColumn(name="barbecue_id", referencedColumnName="id")
     * @var Barbecue
     */
    protected $barbecue;

    /**
     * @ORM\Column(type="date")
     * @var DateTime
     */
    protected $date;

    public function __construct(User $user, Barbecue $barbecue)
    {
        $this->renter = $user;
        $this->barbecue = $barbecue;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getRenter(): User
    {
        return $this->renter;
    }

    public function setRenter(User $user): self
    {
        $this->renter = $user;

        return $this;
    }

    public function getBarbecue(): Barbecue
    {
        return $this->barbecue;
    }

    public function setBarbecue(Barbecue $barbecue): self
    {
        $this->barbecue = $barbecue;

        return $this;
    }

    public function getDate(): ?DateTime
    {
        return $this->date;
    }

    public function setDate(DateTime $date): self
    {
        $this->date = $date;

        return $this;
    }
}
