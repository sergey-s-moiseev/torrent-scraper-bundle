<?php
namespace SergeySMoiseev\TorrentScraperBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use SergeySMoiseev\TorrentScraperBundle\DependencyInjection\Compiler\TorrentScraperAdapterPass;

class TorrentScraperBundle extends Bundle
{
    /**
     * {@inheritDoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new TorrentScraperAdapterPass());
    }
}
