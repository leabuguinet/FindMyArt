<?php

namespace App\Entity\PieceType;

use App\Entity\Piece;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Photography extends Piece
{
    public function getstyle() {
        return parent::Photography;
    }
}