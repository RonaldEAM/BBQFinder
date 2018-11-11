<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Entity\File as EmbeddedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use DateTimeImmutable;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BarbecueRepository")
 * @Vich\Uploadable
 */
class Barbecue
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="array")
     * @var string[]
     */
    protected $properties = [];

    /**
     * @ORM\Embedded(class="Vich\UploaderBundle\Entity\File")
     * @var EmbeddedFile
     */
    protected $picture;

    /**
     * @Vich\UploadableField(mapping="barbecue_picture", fileNameProperty="picture.name", size="picture.size", mimeType="picture.mimeType", originalName="picture.originalName", dimensions="picture.dimensions")
     * @var File
     */
    protected $pictureFile;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    protected $model;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    protected $locationLat;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    protected $locationLng;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    protected $zipCode;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="ownedBarbecues")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * @var User
     */
    protected $owner;

    /**
     * @ORM\OneToMany(targetEntity="Rent", mappedBy="barbecue")
     * @var ArrayCollection
     */
    protected $rents;

    /**
     * @ORM\Column(type="datetime")
     * @var DateTimeImmutable
     */
    protected $updatedAt;

    public function __construct(User $user)
    {
        $this->owner = $user;
        $this->picture = new EmbeddedFile();
        $this->rents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProperties(): ?array
    {
        return $this->properties;
    }

    public function setProperties(array $properties): self
    {
        $this->properties = $properties;

        return $this;
    }

    public function getPictureFile(): ?File
    {
        return $this->pictureFile;
    }

    /**
     * @param File|UploadedFile $picture
     */
    public function setPictureFile(File $picture)
    {
        $this->pictureFile = $picture;

        if (null !== $picture) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getPicture(): ?EmbeddedFile
    {
        return $this->picture;
    }

    public function setPicture(EmbeddedFile $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLocationLat(): ?string
    {
        return $this->locationLat;
    }

    public function setLocationLat(string $locationLat): self
    {
        $this->locationLat = $locationLat;

        return $this;
    }

    public function getLocationLng(): ?string
    {
        return $this->locationLng;
    }

    public function setLocationLng(string $locationLng): self
    {
        $this->locationLng = $locationLng;

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

    public function getOwner(): User
    {
        return $this->owner;
    }

    public function setOwner(User $user): self
    {
        $this->owner = $user;

        return $this;
    }
}
