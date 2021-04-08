<?php

namespace App\Entity\PieceType;

use App\Entity\Piece;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class StreetArt extends Piece
{
    public function getstyle() {
        return parent::StreetArt;
    }
}