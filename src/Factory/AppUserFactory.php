<?php

namespace App\Factory;


use App\Entity\User\Interfaces\AppCustomerInterface;
use App\Entity\User\Interfaces\AppUserInterface;
use Faker\Factory;
use Faker\Generator;
use Sylius\Bundle\CoreBundle\Fixture\Factory\ExampleFactoryInterface;
use Sylius\Bundle\CoreBundle\Fixture\Factory\AbstractExampleFactory;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AppUserFactory extends AbstractExampleFactory implements ExampleFactoryInterface
{
    private Generator $faker;
    private OptionsResolver $optionsResolver;

    public function __construct(
        private readonly FactoryInterface $appUserFactory,
        private readonly FactoryInterface $appCustomerFactory
    )
    {
        $this->faker = Factory::create();
        $this->optionsResolver = new OptionsResolver();

        $this->configureOptions($this->optionsResolver);
    }

    public function create(array $options = []): object
    {

        $options = $this->optionsResolver->resolve($options);

        /** @var AppCustomerInterface $customer */
        $customer = $this->appCustomerFactory->createNew();
        $customer->setEmailCanonical($options['email']);
        $customer->setEmail($options['email']);
        $customer->setFirstName($options['first_name']);
        $customer->setLastName($options['last_name']);

        /** @var AppUserInterface $user */
        $user = $this->appUserFactory->createNew();
        $user->setUsername($options['username']);
        $user->setPlainPassword($options['password']);
        $user->setEnabled($options['enabled']);
        $user->addRole($options['role']);
        $user->setCustomer($customer);

        return $user;
    }

    protected function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefault('username', fn(Options $options) => $this->faker->userName)
            ->setDefault('email', fn(Options $options) => $this->faker->email)
            ->setDefault('first_name', fn(Options $options) => $this->faker->firstName)
            ->setDefault('last_name', fn(Options $options) => $this->faker->lastName)
            ->setDefault('enabled', true)
            ->setAllowedTypes('enabled', 'bool')
            ->setDefault('password', 'password123')
            ->setDefault('role', 'ROLE_USER')
            ->setAllowedTypes('role', 'string');
    }
}
