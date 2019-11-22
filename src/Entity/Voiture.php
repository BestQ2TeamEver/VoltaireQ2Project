<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Voiture
 *
 * @ORM\Table(name="voiture")
 * @ORM\Entity
 */
class Voiture
{
    /**
     * @var string
     *
     * @ORM\Column(name="immatriculation", type="string", length=8, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $immatriculation;

    /**
     * @var string
     *
     * @ORM\Column(name="marque", type="string", length=25, nullable=false)
     */
    private $marque;

    /**
     * @var string
     *
     * @ORM\Column(name="couleur", type="string", length=12, nullable=false)
     */
    private $couleur;


}
