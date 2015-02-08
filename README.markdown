## aliyun-mqs-lib

阿里云MQS队列服务PHP非官方SDK。

## 安装

使用composer安装

    > "baocaixiong/aliyun-mqs-lib": "dev-master"

## 使用

暂时只针对`laravel4.2`版本，其他环境请自看phpunit测试。

1. 在app/config/queue.php中添加:

```
'mqs' => [
    'driver' => 'mqs',
    'queue' => '<queue name>',
    'host' => '<queue host>',
    'key' => '<access key>',
    'secret' => '<access secret>',
    'keepalive' => 'receive message waitseconds',
]
```

将其中 `default` 键值改为 `mqs`

2. 添加provider, 在 `app/config/app.php`中, `providers`键中添加

    > 'Mqs\Laravel\MqsServiceProvider'