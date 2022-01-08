<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FormationRepository::class)
 */
class Formation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nomCourt;

    /**
     * @ORM\Column(type="string", length=300)
     */
    private $nomLong;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getNomCourt(): ?string
    {
        return $this->nomCourt;
    }

    public function setNomCourt(string $nomCourt): self
    {
        $this->nomCourt = $nomCourt;

        return $this;
    }

    public function getNomLong(): ?string
    {
        return $this->nomLong;
    }

    public function setNomLong(string $nomLong): self
    {
        $this->nomLong = $nomLong;

        return $this;
    }
}
