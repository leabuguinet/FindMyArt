<?php

namespace App\Entity;

use App\Repository\RentingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RentingRepository::class)
 */
class Renting
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statuts;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="rentings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=RentingDetail::class, mappedBy="renting")
     */
    private $rentingDetails;

    public function __construct()
    {
        $this->rentingDetails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getStatuts(): ?string
    {
        return $this->statuts;
    }

    public function setStatuts(string $statuts): self
    {
        $this->statuts = $statuts;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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
            $rentingDetail->setRenting($this);
        }

        return $this;
    }

    public function removeRentingDetail(RentingDetail $rentingDetail): self
    {
        if ($this->rentingDetails->removeElement($rentingDetail)) {
            // set the owning side to null (unless already changed)
            if ($rentingDetail->getRenting() === $this) {
                $rentingDetail->setRenting(null);
            }
        }

        return $this;
    }
}
