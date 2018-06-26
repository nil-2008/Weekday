<?php
namespace PhalApi\Weekday;

/**
 * PhalApi2-Weekday 拓展类
 * @author: 连友 <ofzt@qq.com> 2018-06-26
 */

define("SUCCESS", 0); //正常工作日
define("HOLIDAY", 1); //节假日
define("WEEKEND", 2); //周末
define("OFF_HOUR", 3); //上班时间之外

class Lite {
    private $list;

    /**
     * Lite 构造方法初始化配置
     *
     * @param $config array 配置文件
     */
    public function __construct($config = null) {
        $this->list = $config;
    }

    /**
     * 是否是工作日
     * @return boolean code 0:否 1：是
     */
    public function isWeekday() {
        $isWeekday = $this->isWeekend();

        if ($isWeekday == WEEKEND) {
            return WEEKEND;
        }

        $isHoliday = $this->isHoliday();

        if ($isHoliday == HOLIDAY) {
            return HOLIDAY;
        }

        $isOffhour = $this->isOffhour();

        return ($isOffhour == OFF_HOUR) ? OFF_HOUR : SUCCESS;
    }

    /**
     * 是否是工作之外的时间 8:30~ 17：30
     * @return boolean code 0:否 2：是
     */
    public function isOffhour() {
        return (date("His") < 83000 && date("His") > 173000) ? OFF_HOUR : SUCCESS;
    }

    /**
     * 是否是周末
     * @return boolean code 0:否 2：是
     */
    protected function isWeekend() {
        $w = date('w');
        return ($w == 0 || $w == 6) ? WEEKEND : SUCCESS;
    }

    /**
     * 是否是节假日
     * @return boolean code 0:否 1：是
     */
    protected function isHoliday() {
        return in_array(strtotime(date("Y-m-d")), $this->list) ? HOLIDAY : SUCCESS;
    }
}