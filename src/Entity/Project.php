<?php

// src/Entity/Project.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: 'App\Repository\ProjectRepository')]
#[ORM\Table(name: 'projects')] // Explicitly set the table name to 'projects'
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 512, nullable: true)]
    private $name;

    #[ORM\Column(type: 'string', length: 512, nullable: true)]
    private $description;

    #[ORM\Column(type: 'string', length: 512, nullable: true, name: 'imageUrl')]
    private $imageUrl;

    #[ORM\Column(type: 'integer', nullable: true, name: 'contractTypeId')]
    private $contractTypeId;

    #[ORM\Column(type: 'string', length: 512, nullable: true, name: 'contractSignedOn')]
    private $contractSignedOn;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $budget;

    #[ORM\Column(type: 'boolean', nullable: true, name: 'isActive')]
    private $isActive;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(?string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;
        return $this;
    }

    public function getContractTypeId(): ?int
    {
        return $this->contractTypeId;
    }

    public function setContractTypeId(?int $contractTypeId): self
    {
        $this->contractTypeId = $contractTypeId;
        return $this;
    }

    public function getContractSignedOn(): ?string
    {
        return $this->contractSignedOn;
    }

    public function setContractSignedOn(?string $contractSignedOn): self
    {
        $this->contractSignedOn = $contractSignedOn;
        return $this;
    }

    public function getBudget(): ?int
    {
        return $this->budget;
    }

    public function setBudget(?int $budget): self
    {
        $this->budget = $budget;
        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(?bool $isActive): self
    {
        $this->isActive = $isActive;
        return $this;
    }
}
