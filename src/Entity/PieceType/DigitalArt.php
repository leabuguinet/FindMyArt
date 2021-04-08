<?php

namespace App\Entity\PieceType;

use App\Entity\Piece;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class DigitalArt extends Piece
{
    public function getstyle() {
        return parent::DigitalArt;
    }
}