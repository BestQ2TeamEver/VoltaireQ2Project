<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VoltaireEnseignant
 *
 * @ORM\Table(name="voltaire_enseignant", indexes={@ORM\Index(name="fk_loginEnseignant", columns={"login"})})
 * @ORM\Entity
 */
class VoltaireEnseignant
{
    /**
     * @var string
     *
     * @ORM\Column(name="nomEnseignant", type="string", length=255, nullable=false)
     */
    private $nomenseignant;

    /**
     * @var string
     *
     * @ORM\Column(name="prenomEnseignant", type="string", length=255, nullable=false)
     */
    private $prenomenseignant;

    /**
     * @var string
     *
     * @ORM\Column(name="groupeEnseignant", type="string", length=255, nullable=false)
     */
    private $groupeenseignant;

    /**
     * @var int
     *
     * @ORM\Column(name="idEnseignant", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idenseignant;

    /**
     * @var \VoltaireUser
     *
     * @ORM\ManyToOne(targetEntity="VoltaireUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="login", referencedColumnName="login")
     * })
     */
    private $login;


}
