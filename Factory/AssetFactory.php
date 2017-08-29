<?php

namespace Hshn\AngularBundle\Factory;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Bundle\AsseticBundle\Factory\AssetFactory as BaseAssetFactory;
use Assetic\Asset\AssetInterface;

class AssetFactory extends BaseAssetFactory
{
    private $container;

    /**
     * @inheritdoc
     */
    public function __construct(KernelInterface $kernel, ContainerInterface $container, ParameterBagInterface $parameterBag, $baseDir, $debug = false)
    {
        parent::__construct($kernel, $container, $parameterBag, $baseDir, $debug);
        $this->container = $container;
    }

    /**
     * @inheritdoc
     */
    protected function parseInput($input, array $options = array())
    {
        if (0 === strpos($input, '@ng_template_cache_')) {
            return $this->createTemplateCacheAsset(str_replace('@ng_template_cache_', '', $input));
        }
        return parent::parseInput($input, $options);
    }
    
    /**
     * @param $name
     * @return object
     */
    protected function createTemplateCacheAsset($name)
    {
        return $this->container->get(sprintf('hshn_angular.asset.template_cache.%s', $name));
    }
}
