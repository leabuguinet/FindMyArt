<?php

namespace App\Entity;

use App\Repository\PieceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=PieceRepository::class)
 * @Vich\Uploadable
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="style", type="string")
 * @ORM\DiscriminatorMap(
 *      {
 *          "contemporaryart" = "App\Entity\PieceType\ContemporaryArt",
 *          "digitalart" = "App\Entity\PieceType\DigitalArt",
 *          "streetart" = "App\Entity\PieceType\StreetArt",
 *          "photography" = "App\Entity\PieceType\Photography"
 *      })
 */
abstract class Piece
{
    const ContemporaryArt = "ContemporaryArt";
    const DigitalArt  = "DigitalArt";
    const Photography = "Photography";
    const StreetArt  = "StreetArt";
    abstract public function getstyle();
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $artist;



    /**
     * @ORM\Column(type="boolean")
     */
    private $availability;

    /**
     * @ORM\ManyToOne(targetEntity=Owner::class, inversedBy="pieces")
     * @ORM\JoinColumn(nullable=false)
     */
    private $owner;

    /**
     * @ORM\ManyToMany(targetEntity=RentingDetail::class, mappedBy="piece")
     */
    private $rentingDetails;



    ///UPLOAD images des oeuvres

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="pieces_images", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    ///UPLOAD updated at

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    public $updatedAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $size;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $materialsTechnique;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $creationDate;



    public function __construct()
    {
        $this->rentingDetails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getArtist(): ?string
    {
        return $this->artist;
    }

    public function setArtist(string $artist): self
    {
        $this->artist = $artist;

        return $this;
    }



    public function getAvailability(): ?bool
    {
        return $this->availability;
    }

    public function setAvailability(bool $availability): self
    {
        $this->availability = $availability;

        return $this;
    }

    public function getOwner(): ?Owner
    {
        return $this->owner;
    }

    public function setOwner(?Owner $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return Collection|RentingDetail[]
     */
    public function getRentingDetails(): Collection
    {
        return $this->rentingDetails;
    }

    public function addRentingDetail(RentingDetail $rentingDetail): self
    {
        if (!$this->rentingDetails->contains($rentingDetail)) {
            $this->rentingDetails[] = $rentingDetail;
            $rentingDetail->addPiece($this);
        }

        return $this;
    }

    public function removeRentingDetail(RentingDetail $rentingDetail): self
    {
        if ($this->rentingDetails->removeElement($rentingDetail)) {
            $rentingDetail->removePiece($this);
        }

        return $this;
    }
//////


    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(string $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getMaterialsTechnique(): ?string
    {
        return $this->materialsTechnique;
    }

    public function setMaterialsTechnique(?string $materialsTechnique): self
    {
        $this->materialsTechnique = $materialsTechnique;

        return $this;
    }

    public function getCreationDate(): ?int
    {
        return $this->creationDate;
    }

    public function setCreationDate(?int $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }


    public function formatedForView()
    {
        return [
            "title" => $this->getTitle(),
            "id" => $this->getId(),
            "image" => $this->getImage(),
            "description" => $this->getDescription(),
            "artist" => $this->getArtist(),
            "style" => $this->getStyle(),
            "size" => $this->getSize(),
            "creationDate" => $this->getCreationDate(),
            "materialsTechnique" => $this->getMaterialsTechnique(),
            "owner" => $this->getOwner(),
            


        ];
    }
}
