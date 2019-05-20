<?php

/**
 * 工厂方法模式
 */
/*
 * cache 接口
 */
interface cache
{
    public function setValue($key, $val);
    public function getValue($key);
}

/*
 * 文件缓存 实现接口
 */
class fileCache implements cache
{
    private $_filePath = '/tmp/';

    public function setValue($key, $val)
    {
        // TODO: Implement setValue() method.
        $key    = $this->_filePath . $key . '.php';
        $value  = "<?php\n" . date('//Y-m-d H:i:s') . "\n return " . var_export($val, true) . ";\n";

        return file_put_contents($key, $value);
    }

    public function getValue($key)
    {
        // TODO: Implement getValue() method.
        $key    = $this->_filePath . $key . '.php';
        if (is_file($key)) {
            return include($key);
        }
        return null;
    }
}

/*
 * redis 缓存
 */
class redisCache implements cache
{
    protected $_mc = null;

    public function __construct($ip, $port)
    {
        $this->_mc = new Redis();
        $this->_mc->connect($ip, $port);
    }

    public function getValue($key)
    {
        // TODO: Implement getValue() method.
        $val = $this->_mc->get($key);
        return !empty($val) ? unserialize($val) : null;
    }

    public function setValue($key, $val)
    {
        // TODO: Implement setValue() method.
        $val = serialize($val);
        return $this->_mc->set($key, $val);
    }
}


/**
 * 调用示例
 */

$cache = new redisCache('127.0.0.1', 6379);
$cache->setValue('aa','test');
$return = $cache->getValue('aa');

$cache = new fileCache();
$cache->setValue('aa', 'test');
$return = $cache->getValue('aaa');