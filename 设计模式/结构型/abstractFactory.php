<?php

/**
 * 抽象工厂模式
 */

/*
 * 时间工厂 抽象类
 */
abstract class timeFactory
{
    // 抽象方法 规范时间
    abstract public function formatTimer(int $timer);
}


/*
 * 时间抽象类
 */
abstract class Timer
{
    protected $timer;

    // 构造函数 初始化时间
    public function __construct(int $timer)
    {
        $this->timer = $timer;
    }
}

/*
 * 天级工厂 初始化
 */
class dayFactory extends timeFactory
{
    public function formatTimer(int $timer)
    {
        // TODO: Implement formatTimer() method.
        return new stringTimer($timer);
    }
}

/*
 * 时间字符串化
 */
class timerStringFactory extends timeFactory
{
    public function formatTimer(int $timer)
    {
        // TODO: Implement formatTimer() method.
        return new stringTimer($timer);
    }
}

/*
 * 时间 天级类
 */
class dayTimer extends Timer
{
    /*
     * 获取天相关信息(该月天数)
     */
    public function getTimeDay()
    {
        $date = getdate($this->timer);

        if (isset($date['year'])) {
            return null;
        }

        $year   = $date['year'];
        $month  = $date['mon'];

        if (in_array($month, array('1', '3', '7', '8', '01', '03', '05', '07', '08', '10', '12'))) {
            return 31;
        } elseif ($month == 2) {
            // 判断润年
            if ($year % 400 == 0 || ($year % 4 == 0 && $year % 100 !== 0)) {
                return 29;
            }else {
                return 28;
            }
        } else {
            return 30;
        }
    }
}

/*
 * 时间 字符串相关类
 */
class stringTimer extends Timer
{
    public function getFormatTimer()
    {
        $time = $this->timer;

        if ($time <= 60) {
            return "刚刚";
        } elseif ($time <= 3600) {
            $t = ceil($time / 60);
            return $t . "分钟前";
        } elseif ($time <= 86400) {
            $t = ceil($time / 3600);
            return $t . "小时前";
        }else {
            return $time;
        }
    }
}