<?php

namespace App\Entity\User;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Entity\User\Interfaces\AppCustomerInterface;
use Sylius\Component\Customer\Model\Customer as BaseCustomer;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\OpenApi\Model\Operation as OpenApiOperation;

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
#[ORM\Entity]
#[ORM\Table(name: "app_customer")]
class AppCustomer extends BaseCustomer implements AppCustomerInterface
{

    #[ApiProperty(identifier: true)]
    protected $id;

    #[ORM\OneToOne(mappedBy: "customer", targetEntity: AppUser::class, cascade: ["persist"])]
    protected ?AppUser $user = null;

    public function getUser(): ?AppUser
    {
        return $this->user;
    }

    public function setUser(?AppUser $user): void
    {
        $this->user = $user;
    }
}
