<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CircuitRepository")
 */
class Circuit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code_circuit;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $des_circuit;

    /**
     * @ORM\Column(type="integer")
     */
    private $duree_circuit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeCircuit(): ?string
    {
        return $this->code_circuit;
    }

    public function setCodeCircuit(string $code_circuit): self
    {
        $this->code_circuit = $code_circuit;

        return $this;
    }

    public function getDesCircuit(): ?string
    {
        return $this->des_circuit;
    }

    public function setDesCircuit(string $des_circuit): self
    {
        $this->des_circuit = $des_circuit;

        return $this;
    }

    public function getDureeCircuit(): ?int
    {
        return $this->duree_circuit;
    }

    public function setDureeCircuit(int $duree_circuit): self
    {
        $this->duree_circuit = $duree_circuit;

        return $this;
    }
    public function __toString()
    {
        return (string) $this->getCodeCircuit();
    }
}
