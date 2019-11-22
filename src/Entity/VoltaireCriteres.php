<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VoltaireCriteres
 *
 * @ORM\Table(name="voltaire_criteres")
 * @ORM\Entity
 */
class VoltaireCriteres
{
    /**
     * @var int
     *
     * @ORM\Column(name="progression", type="integer", nullable=false)
     */
    private $progression;

    /**
     * @var int
     *
     * @ORM\Column(name="tpsUtilisation", type="integer", nullable=false)
     */
    private $tpsutilisation;

    /**
     * @var int
     *
     * @ORM\Column(name="niveauInitial", type="integer", nullable=false)
     */
    private $niveauinitial;

    /**
     * @var int
     *
     * @ORM\Column(name="evaluationFinale", type="integer", nullable=false)
     */
    private $evaluationfinale;

    /**
     * @var int
     *
     * @ORM\Column(name="param5", type="integer", nullable=false)
     */
    private $param5;

    /**
     * @var int
     *
     * @ORM\Column(name="idCritere", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcritere;


}
