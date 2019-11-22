<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VoltaireModules
 *
 * @ORM\Table(name="voltaire_modules")
 * @ORM\Entity
 */
class VoltaireModules
{
    /**
     * @var int
     *
     * @ORM\Column(name="idModule", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idmodule;

    /**
     * @var string
     *
     * @ORM\Column(name="nomModule", type="string", length=255, nullable=false)
     */
    private $nommodule;

    /**
     * @var int
     *
     * @ORM\Column(name="nbReglesModule", type="integer", nullable=false)
     */
    private $nbreglesmodule;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="VoltaireEtudiant", mappedBy="idmodule")
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
