<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VoltaireUser
 *
 * @ORM\Table(name="voltaire_user")
 * @ORM\Entity
 */
class VoltaireUser
{
    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=255, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="mdp", type="string", length=255, nullable=false)
     */
    private $mdp;


}
