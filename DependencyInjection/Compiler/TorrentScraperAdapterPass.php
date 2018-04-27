<?php
namespace SergeySMoiseev\TorrentScraperBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class TorrentScraperAdapterPass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        $serviceId = $container->getParameter('torrent_scraper.service');
        if(!$container->has($serviceId)) {
            return;
        }

        $definition = $container->findDefinition($serviceId);
        $adapters = $container->findTaggedServiceIds('torrent_scraper.scraper_adapter');

        foreach($adapters as $_id => $_tags) {
            foreach($_tags as $_tag) {
                $definition->addMethodCall('addAdapter', [$_tag['label'], new Reference($_id)]);
            }
        }
    }
}