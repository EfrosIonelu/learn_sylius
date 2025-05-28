# Steps
- Install
  - ` composer require --dev symfony/web-profiler-bundle `
- Check config/bundles.php
    - `Symfony\Bundle\WebProfilerBundle\WebProfilerBundle::class => ['dev' => true, 'test' => true],`
- Add in config/routes/dev/web_profiler.yaml
  - `bash
    web_profiler_wdt:
        resource: '@WebProfilerBundle/Resources/config/routing/wdt.xml'
        prefix: /_wdt
    web_profiler_profiler:
        resource: '@WebProfilerBundle/Resources/config/routing/profiler.xml'
        prefix: /_profiler

    `
- Check that is working
    - enter /_profiler
- Add `config/packages/dev/web_profiler.yaml`
