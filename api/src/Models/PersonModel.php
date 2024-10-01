<?php

namespace App\Models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;

#[ORM\Entity]
#[ORM\Table(name: 'person')]
class PersonModel extends Model
{

    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\Column(type: 'string')]
    private string $name;

    #[ORM\Column(type: 'string')]
    private string $cpf;

    /** @var Collection<int, ContactModel> */
    #[OneToMany(targetEntity: ContactModel::class, mappedBy: 'personModel')]
    private Collection $contactModels;

    public function __construct()
    {
        $this->contactModels = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCpf(): string
    {
        return $this->cpf;
    }

    public function setCpf(string $cpf): void
    {
        $this->cpf = $cpf;
    }

    public function getContactModels(): Collection
    {
        return $this->contactModels;
    }

    public function addContactModel(ContactModel $contactModel): void
    {
        $this->contactModels[] = $contactModel;
        $contactModel->setPersonModel($this);
    }
}
