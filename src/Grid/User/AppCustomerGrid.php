<?php

namespace App\Grid\User;

use App\Entity\User\AppCustomer;
use Sylius\Bundle\GridBundle\Builder\Action\DeleteAction;
use Sylius\Bundle\GridBundle\Builder\Action\UpdateAction;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\ItemActionGroup;
use Sylius\Bundle\GridBundle\Builder\Field\StringField;
use Sylius\Bundle\GridBundle\Builder\Field\TwigField;
use Sylius\Bundle\GridBundle\Builder\GridBuilderInterface;
use Sylius\Bundle\GridBundle\Grid\AbstractGrid;
use Sylius\Bundle\GridBundle\Grid\ResourceAwareGridInterface;

final class AppCustomerGrid extends AbstractGrid implements ResourceAwareGridInterface
{
    public function __construct()
    {
        // TODO inject services if required
    }

    public static function getName(): string
    {
        return 'app_customer';
    }

    public function buildGrid(GridBuilderInterface $gridBuilder): void
    {
        $gridBuilder
            ->setLimits([10, 20, 50])
            ->addField(
                TwigField::create('avatar.filePath', 'admin/grid/field/media_file.html.twig')
                    ->setPath("avatar")
                    ->setLabel('File')
                    ->setSortable(false)
            )
            ->addField(
                StringField::create('fullName')
                    ->setLabel('fullName')
                    ->setSortable(true)
            )
            ->addActionGroup(
                ItemActionGroup::create(
                // ShowAction::create(),
                    UpdateAction::create(),
                    DeleteAction::create()
                )
            )
        ;
    }

    public function getResourceClass(): string
    {
        return AppCustomer::class;
    }
}
