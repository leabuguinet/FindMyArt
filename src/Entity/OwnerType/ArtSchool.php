<?php

namespace App\Entity\OwnerType;

use App\Entity\Owner;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class ArtSchool extends Owner
{
    public function getcategory() {
        return parent::ArtSchool;
    }
}