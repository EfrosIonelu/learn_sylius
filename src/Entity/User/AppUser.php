<?php

namespace App\Entity\User;

use App\Entity\User\Interfaces\AppUserInterface;
use App\Repository\User\AppUserRepository;
use Odiseo\SyliusRbacPlugin\Entity\AdministrationRoleAwareInterface;
use Odiseo\SyliusRbacPlugin\Entity\AdministrationRoleAwareTrait;
use Sylius\Component\User\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AppUserRepository::class)]
#[ORM\Table(name: "app_user")]
class AppUser extends BaseUser implements AdministrationRoleAwareInterface, AppUserInterface
{
    use AdministrationRoleAwareTrait;

    #[ORM\OneToOne(inversedBy: "user", targetEntity: AppCustomer::class, cascade: ["persist"])]
    #[ORM\JoinColumn(name: "customer_id", referencedColumnName: "id", nullable: true, onDelete: "SET NULL")]
    protected ?AppCustomer $customer = null;

    public function getCustomer(): ?AppCustomer
    {
        return $this->customer;
    }

    public function setCustomer(?AppCustomer $customer): void
    {
        $this->customer = $customer;
    }
}
