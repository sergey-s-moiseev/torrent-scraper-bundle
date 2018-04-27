<?php
namespace SergeySMoiseev\TorrentScraperBundle;

class Constant
{
    const EZTV = 'ezTv';
    const KICKASS = 'kickassTorrents';
    const THEPIRATEBAY = 'thePirateBay';
    const TORRENTZ2 = 'torrentz2';
    const EXTRATORRENT = 'extratorrent';

    public static function torrentScrapers()
    {
        return [
            self::TORRENTZ2,
            self::THEPIRATEBAY,
            self::KICKASS,
            self::EZTV,
            self::EXTRATORRENT
        ];
    }
}
