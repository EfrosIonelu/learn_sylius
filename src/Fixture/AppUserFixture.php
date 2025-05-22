<?php

declare(strict_types=1);

namespace App\Fixture;

use Sylius\Bundle\CoreBundle\Fixture\AbstractResourceFixture;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

class AppUserFixture extends AbstractResourceFixture
{
    public function getName(): string
    {
        return 'user_user';
    }

    protected function configureResourceNode(ArrayNodeDefinition $resourceNode): void
    {
        $resourceNode
            ->children()
            ->scalarNode('email')->cannotBeEmpty()->end()
            ->booleanNode('enabled')->end()
            ->scalarNode('password')->cannotBeEmpty()->end()
            ->scalarNode('first_name')->cannotBeEmpty()->end()
            ->scalarNode('last_name')->cannotBeEmpty()->end()
            ->scalarNode('customer')->cannotBeEmpty()->end()
            ->scalarNode('role')->cannotBeEmpty()->end();
    }
}
