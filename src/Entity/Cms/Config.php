<?php

namespace App\Entity\Cms;

use App\Grid\Cms\ConfigGrid;
use App\Repository\ConfigRepository;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Resource\Metadata\AsResource;
use Sylius\Resource\Metadata\BulkDelete;
use Sylius\Resource\Metadata\Create;
use Sylius\Resource\Metadata\Delete;
use Sylius\Resource\Metadata\Index;
use Sylius\Resource\Metadata\Show;
use Sylius\Resource\Metadata\Update;

#[AsResource(
    section: 'admin',
    templatesDir: '@SyliusAdminUi/crud',
    routePrefix: '/admin',
    operations: [
        new Index(
            grid: ConfigGrid::class
        ),
        new Create(),
        new Update(),
        new Delete(),
        new BulkDelete(),
    ],
)]
#[ORM\Entity(repositoryClass: ConfigRepository::class)]
class Config implements ResourceInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $keyword = null;

    #[ORM\Column(length: 255)]
    private ?string $value = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKeyword(): ?string
    {
        return $this->keyword;
    }

    public function setKeyword(string $keyword): static
    {
        $this->keyword = $keyword;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): static
    {
        $this->value = $value;

        return $this;
    }
}
