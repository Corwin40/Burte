<?php

namespace App\Entity\Admin;

use App\Repository\Admin\FooterRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FooterRepository::class)
 */
class Footer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typeContent;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTypeContent(): ?string
    {
        return $this->typeContent;
    }

    public function setTypeContent(string $typeContent): self
    {
        $this->typeContent = $typeContent;

        return $this;
    }
}
