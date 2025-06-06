<?php declare(strict_types=1);

namespace App\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Sylius\AdminUi\Knp\Menu\MenuBuilderInterface;
use Symfony\Component\DependencyInjection\Attribute\AsDecorator;

#[AsDecorator(decorates: 'sylius_admin_ui.knp.menu_builder')]
final readonly class AdminMenuBuilder implements MenuBuilderInterface
{
    public function __construct(
        private readonly FactoryInterface $factory,
    ) {
    }

    public function createMenu(array $options): ItemInterface
    {
        $menu = $this->factory->createItem('root');

        $menu
            ->addChild('dashboard', [
                'route' => 'sylius_admin_ui_dashboard',
            ])
            ->setLabel('sylius.ui.dashboard')
            ->setLabelAttribute('icon', 'tabler:dashboard')
        ;

        $this->addCmsSubMenu($menu);

        return $menu;
    }

    private function addCmsSubMenu(ItemInterface $menu): void
    {
        $library = $menu
            ->addChild('library')
            ->setLabel('app.ui.cms')
            ->setLabelAttribute('icon', 'tabler:books')
        ;

        $library->addChild('configs', ['route' => 'app_admin_config_index'])
            ->setLabel('app.ui.configs')
            ->setLabelAttribute('icon', 'book')
        ;

        $library->addChild('media', ['route' => 'app_admin_media_index'])
            ->setLabel('app.ui.media')
            ->setLabelAttribute('icon', 'book')
        ;

        $library->addChild('customer', ['route' => 'app_admin_app_customer_index'])
            ->setLabel('app.ui.customer')
            ->setLabelAttribute('icon', 'book')
        ;
    }
}
