<?php

namespace App\Entity;

use App\Repository\RentingDetailRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RentingDetailRepository::class)
 */
class RentingDetail
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $priceOption;

    /**
     * @ORM\ManyToMany(targetEntity=Piece::class, inversedBy="rentingDetails")
     */
    private $piece;

    /**
     * @ORM\ManyToOne(targetEntity=Renting::class, inversedBy="rentingDetails")
     * @ORM\JoinColumn(nullable=false)
     */
    private $renting;

    public function __construct()
    {
        $this->piece = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPriceOption(): ?string
    {
        return $this->priceOption;
    }

    public function setPriceOption(string $priceOption): self
    {
        $this->priceOption = $priceOption;

        return $this;
    }

    /**
     * @return Collection|Piece[]
     */
    public function getPiece(): Collection
    {
        return $this->piece;
    }

    public function addPiece(Piece $piece): self
    {
        if (!$this->piece->contains($piece)) {
            $this->piece[] = $piece;
        }

        return $this;
    }

    public function removePiece(Piece $piece): self
    {
        $this->piece->removeElement($piece);

        return $this;
    }

    public function getRenting(): ?Renting
    {
        return $this->renting;
    }

    public function setRenting(?Renting $renting): self
    {
        $this->renting = $renting;

        return $this;
    }
}
