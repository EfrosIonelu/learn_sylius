<?php

namespace App\Entity\User;

use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Customer\Model\CustomerGroup as BaseCustomerGroup;

#[ORM\Table(name: 'app_customer_group')]
#[ORM\Entity]
class AppCustomerGroup extends BaseCustomerGroup
{

}
