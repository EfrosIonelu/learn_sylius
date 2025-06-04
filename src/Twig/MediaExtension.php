<?php

namespace App\Twig;

use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Liip\ImagineBundle\Imagine\Filter\FilterConfiguration;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class MediaExtension extends AbstractExtension
{
    public function __construct(
        private readonly UploaderHelper      $uploader,
        private readonly CacheManager        $cacheManager,
        private readonly FilterConfiguration $filterConfig
    )
    {
    }

    public function getFunctions()
    {
        $names = array(
            'media' => 'getMedia',
            'media_url' => 'getMediaUrl',
        );

        $functions = [];
        foreach ($names as $twig => $local) {
            $functions[] = new TwigFunction($twig, array($this, $local), array('is_safe' => array('html')));
        }

        return $functions;
    }

    public function getMedia($obj, $fieldName, array $attributes = [], $filter = 'avatar', array $runtimeConfig = [], $className = null): string
    {
        if (null === $obj)
            return '';

        $url = $this->getMediaUrl($obj, $fieldName, $filter, $runtimeConfig, $className);
        if (null == $url)
            return '';

        $filters = null !== $filter ? $this->filterConfig->get($filter)['filters'] : [];
        foreach ($filters as $filter) {
            if (isset($filter['width'])) {
                $attributes['width'] = $filter['width'];
            }
            if (isset($filter['height'])) {
                $attributes['height'] = $filter['height'];
            }
        }

        $attr = '';
        foreach ($attributes as $attribute => $value) {
            $attr .= ' ' . $attribute . '="' . $value . '"';
        }


        return '<img src="' . $url . '"' . $attr . '/>';
    }

    public function getMediaUrl($obj, $fieldName, $filter = 'cache', $runtimeConfig = array(), $className = null): ?string
    {
        $path = $this->uploader->asset($obj, $fieldName, $className);
        if (null === $path) {
            return null;
        }

        if (null === $filter) {
            return $path;
        }

        return $this->cacheManager->getBrowserPath($path, $filter, $runtimeConfig);
    }
}
