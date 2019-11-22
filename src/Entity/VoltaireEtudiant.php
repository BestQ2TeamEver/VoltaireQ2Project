<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VoltaireEtudiant
 *
 * @ORM\Table(name="voltaire_etudiant", indexes={@ORM\Index(name="fk_loginEtu", columns={"login"}), @ORM\Index(name="fk_idBareme", columns={"idBareme"})})
 * @ORM\Entity
 */
class VoltaireEtudiant
{
    /**
     * @var string
     *
     * @ORM\Column(name="idEtudiant", type="string", length=255, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idetudiant;

    /**
     * @var string
     *
     * @ORM\Column(name="nomEtudiant", type="string", length=255, nullable=false)
     */
    private $nometudiant;

    /**
     * @var string
     *
     * @ORM\Column(name="prenomEtudiant", type="string", length=255, nullable=false)
     */
    private $prenometudiant;

    /**
     * @var \VoltaireBareme
     *
     * @ORM\ManyToOne(targetEntity="VoltaireBareme")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idBareme", referencedColumnName="idBareme")
     * })
     */
    private $idbareme;

    /**
     * @var \VoltaireUser
     *
     * @ORM\ManyToOne(targetEntity="VoltaireUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="login", referencedColumnName="login")
     * })
     */
    private $login;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="VoltaireNiveau", inversedBy="idetudiant")
     * @ORM\JoinTable(name="voltaire_resultat_niveau",
     *   joinColumns={
     *     @ORM\JoinColumn(name="idEtudiant", referencedColumnName="idEtudiant")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="idNiveau", referencedColumnName="idNiveau")
     *   }
     * )
     */
    private $idniveau;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="VoltaireModules", inversedBy="idetudiant")
     * @ORM\JoinTable(name="voltaire_resultats",
     *   joinColumns={
     *     @ORM\JoinColumn(name="idEtudiant", referencedColumnName="idEtudiant")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="idModule", referencedColumnName="idModule")
     *   }
     * )
     */
    private $idmodule;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idniveau = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idmodule = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
