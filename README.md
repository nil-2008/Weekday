
# 基于PhalApi2的工作日是否上班判断拓展

![](http://webtools.qiniudn.com/master-LOGO-20150410_50.jpg)

## 前言

节假日判断在PHP开发中运用场景已经无处不在,本扩展就是为了解决此问题而生的.

附上:

官网地址:[http://www.phalapi.net/](http://www.phalapi.net/ "PhalApi官网")

项目GitHub地址:[https://github.com/nil-2008/weekday](https://github.com/nil-2008/weekday "项目Git地址")

## 安装PhalApi2-Weekday

在项目的composer.json文件中，添加：

```
{
    "require": {
        "nil-2008/phalapi-weekday": "dev-master"
     }
}
```

配置好后，执行composer update更新操作即可。

## 配置文件
我们需要在 **./config/app.php** 配置文件中追加以下配置：

```
/**
 * 请在下面放置任何您需要的应用配置
 */

return array(

    'on_holidays_list' => array(
        //中秋
        mktime(0, 0, 0, 9, 24, 2018),
        //国庆
        mktime(0, 0, 0, 10, 1, 2018),
        mktime(0, 0, 0, 10, 2, 2018),
        mktime(0, 0, 0, 10, 3, 2018),
        mktime(0, 0, 0, 10, 4, 2018),
        mktime(0, 0, 0, 10, 5, 2018),
    ),

);
```

## 入门使用

初始化PhalApi2-Weekday,入口文件index.php加入如下代码

```

// 惰性加载Weekday
$di->weekday = function () {
    return new \PhalApi\Weekday\Lite(\PhalApi\DI()->config->get("app.on_holidays_list"));
}

```

常用基础操作(具体API可以查阅代码中src/Lite.php)

```
echo  \PhalApi\DI()->weekday->isWeekday();
```