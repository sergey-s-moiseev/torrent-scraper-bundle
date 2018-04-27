<?php
namespace SergeySMoiseev\TorrentScraperBundle\Twig;

use SergeySMoiseev\TorrentScraper\TorrentScraperService;

class TorrentScraperExtension extends \Twig_Extension
{
    /** @var TorrentScraperService */
    protected $scrapperService;

    public function __construct(TorrentScraperService $scrapperService)
    {
        $this->scrapperService = $scrapperService;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'torrent_scraper.twig_extension';
    }

    /**
     * {@inheritDoc}
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('torrent_scraper_label', [$this, 'getScraperLabel']),
            new \Twig_SimpleFilter('torrent_scraper_url', [$this, 'getScraperUrl'])
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('torrent_scraper_labels', [$this, 'getScraperLabels'])
        ];
    }

    /**
     * @param string $scraper
     * @return string
     */
    public function getScraperLabel($scraper)
    {
        return $this->scrapperService->getAdapterLabel($scraper);
    }

    /**
     * @param string $scraper
     * @return string
     */
    public function getScraperUrl($scraper)
    {
        return $this->scrapperService->getAdapterUrl($scraper);
    }

    /**
     * @return string[]
     */
    public function getScraperLabels()
    {
        return $this->scrapperService->getAdapterLabels();
    }
}