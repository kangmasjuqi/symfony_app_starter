<?php 

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class CreateProjectDto
{
    #[Assert\NotBlank(message: 'Name cannot be empty')]
    #[Assert\Length(max: 512, maxMessage: 'Name cannot exceed {{ limit }} characters')]
    private ?string $name;

    #[Assert\NotBlank(message: 'Description cannot be empty')]
    #[Assert\Length(max: 512, maxMessage: 'Description cannot exceed {{ limit }} characters')]
    private ?string $description;

    #[Assert\NotBlank(message: 'Contract Type ID cannot be empty')]
    #[Assert\Type(type: 'integer', message: 'Contract Type ID must be an integer')]
    private ?int $contractTypeId;

    #[Assert\NotBlank(message: 'Contract Signed On cannot be empty')]
    #[Assert\Date(message: 'Contract Signed On must be a valid date')]
    private ?string $contractSignedOn;

    #[Assert\NotBlank(message: 'Budget cannot be empty')]
    #[Assert\Type(type: 'integer', message: 'Budget must be an integer')]
    private ?int $budget;

    #[Assert\NotBlank(message: 'Is Active cannot be empty')]
    #[Assert\Type(type: 'bool', message: 'Is Active must be a boolean')]
    private ?bool $isActive;

    // Getters and Setters for each property

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
