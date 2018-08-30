<?php
namespace SergeySMoiseev\TorrentScraperBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use SergeySMoiseev\TorrentScraperBundle\Constant;
use Doctrine\Common\Util\Inflector;

/*
torrent_scraper:
    service: torrent_scraper.scraper_service
    available_list: [ez_tv, kickass_torrents, the_pirate_bay, torrentz2, extratorrent, yts]
    torrentz2:
        node_path: ~
        node_modules_path: ~
    ez_tv:
        seeders: 1
        leechers: 1
*/

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('torrent_scraper');

        $scrapers = array_map(['Doctrine\Common\Util\Inflector', 'tableize'], Constant::torrentScrapers());

        $rootNode
            ->children()
                ->scalarNode('service')
                    ->info('The scrapper service. You can override it here to use your own.')
                    ->defaultValue('torrent_scraper.scraper_service')
                ->end()
                ->arrayNode('available_list')
                    ->info('List of automatically created predefined scrapers.')
                    ->enumPrototype()
                        ->values($scrapers)
                    ->end()
                    ->defaultValue($scrapers)
                ->end()
                ->arrayNode(Inflector::tableize(Constant::TORRENTZ2))
                    ->info('Additional options for Torrentz2.')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('node_path')
                            ->info('Path to node executable. If null, node should be added to the system path list.')
                            ->defaultNull()
                        ->end()
                        ->scalarNode('node_modules_path')
                            ->info('Path to node modules. You should install browser-env and sandbox.js there. If null, modules should be available globally.')
                            ->defaultNull()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode(Inflector::tableize(Constant::EZTV))
                    ->info('Additional options for EzTV.')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->integerNode('seeders')
                            ->defaultValue(1)
                        ->end()
                        ->integerNode('leechers')
                            ->defaultValue(1)
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}