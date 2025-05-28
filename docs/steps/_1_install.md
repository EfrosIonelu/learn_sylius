# Steps
- Install
  - Link to create a new project: https://stack.sylius.com/getting-started
  - `composer create-project symfony/skeleton learn_sylius`

- `composer require -W `
- `composer require doctrine/orm "^2.16" `
- `composer require doctrine/doctrine-bundle  `
- `composer require pagerfanta/doctrine-orm-adapter  `
- `composer require symfony/asset-mapper  `
  - The asset mapper bundle has an issue check:
  - https://stackoverflow.com/questions/77684268/bootstrap-cannot-find-symfony-stimulus-bundle
  - please run:
    - `composer remove symfony/asset-mapper`
    - `composer require symfony/webpack-encore-bundle`
    - `composer require symfony/stimulus-bundle`
    - `composer require symfony/ux-autocomplete`
    - Check `webpack.config.js` `.enableStimulusBridge('./assets/controllers.json')`
    - Later on, you can run:
    - `npm install -f`
    - `npm run build`
- `composer require symfony/webpack-encore-bundle  `
- `composer require sylius/bootstrap-admin-ui `
- `composer require sylius/ui-translations `
- `symfony console importmap:require tom-select/dist/css/tom-select.default.css`
- Start the server
  - `symfony serve -d`

### Add grid
- composer require sylius/resource-bundle
  - https://stack.sylius.com/resource/index/installation
- composer require sylius/grid-bundle
  - https://stack.sylius.com/grid/index/installation
