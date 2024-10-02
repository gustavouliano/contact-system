<?php

namespace App\Models;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

#[ORM\Entity]
#[ORM\Table(name: 'contact')]
class ContactModel
{

    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\Column(type: 'boolean')]
    private bool $type;

    #[ORM\Column(type: 'string')]
    private string $description;

    #[ManyToOne(targetEntity: PersonModel::class, inversedBy: 'contactModels')]
    #[JoinColumn(name: 'idPerson', referencedColumnName: 'id')]
    private PersonModel $personModel;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getType(): bool
    {
        return $this->type;
    }

    public function setType(bool $type)
    {
        $this->type = $type;
    }

    public function getDescription(): String
    {
        return $this->description;
    }

    public function setDescription(String $description)
    {
        $this->description = $description;
    }

    public function getPersonModel(): PersonModel
    {
        return $this->personModel;
    }

    public function setPersonModel(PersonModel $personModel): void
    {
        $this->personModel = $personModel;
    }
}
