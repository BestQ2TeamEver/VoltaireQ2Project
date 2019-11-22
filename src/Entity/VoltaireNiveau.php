<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VoltaireNiveau
 *
 * @ORM\Table(name="voltaire_niveau")
 * @ORM\Entity
 */
class VoltaireNiveau
{
    /**
     * @var int
     *
     * @ORM\Column(name="idNiveau", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idniveau;

    /**
     * @var string
     *
     * @ORM\Column(name="nomNiveau", type="string", length=255, nullable=false)
     */
    private $nomniveau;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="VoltaireEtudiant", mappedBy="idniveau")
     */
    private $idetudiant;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idetudiant = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
