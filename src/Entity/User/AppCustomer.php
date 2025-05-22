<?php

namespace App\Entity\User;

use App\Entity\User\Interfaces\AppCustomerInterface;
use Sylius\Component\Customer\Model\Customer as BaseCustomer;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "app_customer")]
class AppCustomer extends BaseCustomer implements AppCustomerInterface
{
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
