<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"consommateur"="Consommateur", "producteur"="Producteur"})
 */
abstract class User
{
    const ROLE_CONSOMMATEUR = 'ROLE_CONSOMMATEUR';
    const ROLE_PRODUCTEUR   = 'ROLE_PRODUCTEUR';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @ORM\OneToOne(targetEntity="Consommateur")
     * @ORM\OneToOne(targetEntity="Producteur")
     */
    private $id;


    public function getId(): ?int
    {
        return $this->id;
    }
}
