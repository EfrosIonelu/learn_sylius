# Steps
- Install
  - ```composer create-project symfony/skeleton learn_sylius```
  - Link: https://stack.sylius.com/getting-started
- composer require -W \
  doctrine/orm "^2.16" \
  doctrine/doctrine-bundle \
  pagerfanta/doctrine-orm-adapter \
  symfony/asset-mapper \
  sylius/bootstrap-admin-ui \
  sylius/ui-translations
- symfony console importmap:require tom-select/dist/css/tom-select.default.css
- symfony serve -d

### Add grid
- composer require sylius/resource-bundle
  - https://stack.sylius.com/resource/index/installation
- composer require sylius/grid-bundle
  - https://stack.sylius.com/grid/index/installation
