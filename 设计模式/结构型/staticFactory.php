<?php

/*
 * 静态工厂
 */

final class Cache
{
    /*
     * 文件cache
     */
    const CACHE_TYPE_FILE   = 0;

    /*
     * redis cache
     */
    const CACHE_TYPE_REDIS   = 1;

    /*
     * swoole tabel
     */
    const CACHE_TYPE_SWOOLE_TABLE = 2;

    /*
     * memcache
     */
    const CACHE_TYPE_MEMCACHE   = 3;

    public static function factory($t = self::CACHE_TYPE_FILE, $db = 0)
    {
        /*
         * 初始化不同
         */
    }
}