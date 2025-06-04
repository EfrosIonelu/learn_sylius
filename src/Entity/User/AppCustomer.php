<?php

namespace App\Entity\User;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Entity\Cms\Media;
use App\Entity\User\Interfaces\AppCustomerInterface;
use App\Grid\Cms\Cms\MediaGrid;
use App\Grid\User\AppCustomerGrid;
use Sylius\Component\Customer\Model\Customer as BaseCustomer;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\OpenApi\Model\Operation as OpenApiOperation;
use Sylius\Resource\Metadata\AsResource;
use Sylius\Resource\Metadata\Delete;
use Sylius\Resource\Metadata\Index;
use Sylius\Resource\Metadata\Update;

#[ApiResource(
    shortName: "AppCustomer",
    description: "App customers",
    operations: [
        new GetCollection(
            openapi: new OpenApiOperation(
                summary : "Get list of all customers"
            ),
            normalizationContext: [
                'groups' => [
                    'customer:list_read'
                ]
            ]

        ),
        new Get(
            openapi: new OpenApiOperation(
                summary : "Get customer by id"
            ),
            normalizationContext: [
                'groups' => [
                    'customer:item_read',
                ]
            ]

        ),

    ],
    paginationClientItemsPerPage: true,
    paginationEnabled: true,
    paginationItemsPerPage: 25,
    security: "is_granted('ROLE_ADMIN')"
)]
#[AsResource(
    section: 'admin',
    templatesDir: '@SyliusAdminUi/crud',
    routePrefix: '/admin',
    operations: [
        new Index(
            grid: AppCustomerGrid::class
        ),
        new Update(),
        new Delete(),
    ],
)]
#[ORM\Entity]
#[ORM\Table(name: "app_customer")]
class AppCustomer extends BaseCustomer implements AppCustomerInterface
{

    #[ApiProperty(identifier: true)]
    protected $id;

    #[ORM\OneToOne(mappedBy: "customer", targetEntity: AppUser::class, cascade: ["persist"])]
    protected ?AppUser $user = null;

    #[ORM\ManyToOne(targetEntity: Media::class)]
    #[ORM\JoinColumn(name: 'media_id', referencedColumnName: 'id', onDelete: 'SET NULL')]
    protected ?Media $avatar = null;

    public function getUser(): ?AppUser
    {
        return $this->user;
    }

    public function setUser(?AppUser $user): void
    {
        $this->user = $user;
    }

    public function getAvatar(): ?Media
    {
        return $this->avatar;
    }

    public function setAvatar(?Media $avatar): void
    {
        $this->avatar = $avatar;
    }
}
