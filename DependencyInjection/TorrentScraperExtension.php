<?php
namespace SergeySMoiseev\TorrentScraperBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use SergeySMoiseev\TorrentScraperBundle\Constant;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Reference;

class TorrentScraperExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(dirname(__DIR__).'/Resources/config'));
        $loader->load('services.yml');
    
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('torrent_scraper.scraper_service.script', $config['scraper_script']);
        $container->setParameter('torrent_scraper.service', $config['service']);
        $scrapers = array_map(['Doctrine\Common\Util\Inflector', 'tableize'], Constant::torrentScrapers());
        foreach($scrapers as $_adapter) {
            $definitionId = "torrent_scraper.scraper_adapter.{$_adapter}";
            if(!in_array($_adapter, $config['available_list'])) {
                $container->removeDefinition($definitionId);
            }
            elseif(array_key_exists($_adapter, $config)) {
                $def = $container->getDefinition($definitionId);
                $def->replaceArgument(0, $config[$_adapter]);
                if(null !== $config['logger']) {
                    $def->addMethodCall('setLogger', [new Reference($config['logger'])]);
                }
            }
    }
    }
}
