<?php

namespace App\Entity;

use App\Repository\RentingDetailRepository;
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
}
