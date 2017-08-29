<?php

namespace Hshn\AngularBundle\Tests\Factory;

use Hshn\AngularBundle\Factory\AssetFactory;

class AssetFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function testParseInputForTemplateCacheAsset()
    {
        $kernel = $this->getMockBuilder('Symfony\Component\HttpKernel\KernelInterface')->disableOriginalConstructor()->getMock();
        $container = $this->getMockBuilder('Symfony\Component\DependencyInjection\ContainerInterface')->disableOriginalConstructor()->getMock();
        $container
            ->expects($this->once())
            ->method('get')
            ->with($this->equalTo('hshn_angular.asset.template_cache.foo'))
            ->willReturn('ng_template_cache_foo');
        $parameterBag = $this->getMockBuilder('Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface')->disableOriginalConstructor()->getMock();

        $factory = new AssetFactory($kernel, $container, $parameterBag, 'path/to/');
        $parseInput = new \ReflectionMethod($factory, 'parseInput');
        $parseInput->setAccessible(true);

        $this->assertEquals('ng_template_cache_foo', $parseInput->invoke($factory, '@ng_template_cache_foo', array()));
    }
}

