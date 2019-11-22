<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VoltaireBareme
 *
 * @ORM\Table(name="voltaire_bareme")
 * @ORM\Entity
 */
class VoltaireBareme
{
    /**
     * @var string
     *
     * @ORM\Column(name="nomBareme", type="string", length=255, nullable=false)
     */
    private $nombareme;

    /**
     * @var int
     *
     * @ORM\Column(name="favoriBareme", type="integer", nullable=false)
     */
    private $favoribareme;

    /**
     * @var int
     *
     * @ORM\Column(name="idBareme", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idbareme;

    /**
     * @var int
     *
     * @ORM\Column(name="idCritere", type="integer", nullable=false)
     */
    private $idcritere;


}
