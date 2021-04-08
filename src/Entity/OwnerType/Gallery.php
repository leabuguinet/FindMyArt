<?php

namespace App\Entity\OwnerType;

use App\Entity\Owner;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Gallery extends Owner
{
    public function getcategory() {
        return parent::Gallery;
    }
}