<?php
namespace SergeySMoiseev\TorrentScraperBundle;

use SergeySMoiseev\TorrentScraper\Adapter;

class Constant
{
    const EZTV = Adapter\EzTvAdapter::ADAPTER_NAME; // 'ezTv';
    const KICKASS = Adapter\KickassTorrentsAdapter::ADAPTER_NAME; // 'kickassTorrents';
    const THEPIRATEBAY = Adapter\ThePirateBayAdapter::ADAPTER_NAME; // 'thePirateBay';
    const TORRENTZ2 = Adapter\Torrentz2Adapter::ADAPTER_NAME; // 'torrentz2';
    const EXTRATORRENT = Adapter\ExtratorrentAdapter::ADAPTER_NAME; // 'extratorrent';

    public static function torrentScrapers()
    {
        return [
            self::EZTV,
            self::KICKASS,
            self::THEPIRATEBAY,
            self::TORRENTZ2,
            self::EXTRATORRENT
        ];
    }
}
