<?php

namespace App\Entity\OwnerType;

use App\Entity\Owner;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class FindMyArt extends Owner
{
    public function getcategory() {
        return parent::FindMyArt;
    }
}