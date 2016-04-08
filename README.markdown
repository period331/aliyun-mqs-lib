## aliyun-mqs-lib

阿里云MQS队列服务PHP非官方SDK。

官方已经更新MQS为MNS服务, 更好更快更强, 且发布了最新的官方sdk,地址为: [PHP SDK_SDK使用手册_消息服务-阿里云产品文档](https://help.aliyun.com/document_detail/mns/sdk/php-sdk.html)

## 安装

使用composer安装

    "baocaixiong/aliyun-mqs-lib": "dev-master"

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

```
   'Mqs\Laravel\MqsServiceProvider'
```

3. 使用`Cache::push('', ["x" => ""])` 推送队列数据到mqs

## 单独使用

### 创建Queue

```
$req = new \Mqs\Request\CreateQueue('queue-name');
$req->setDelaySeconds(x);
$req->setMaximumMessageSize(x);
// 如果参数已经组好了数组可以直接通过 $req->params($parameters) 设置属性;
$res = $req->send();
$res->isSuccess(); // => true
```

### 发送消息
```
$req = new \Mqs\Request\SendMessage('queue-name');
$req->setMessageBody(xxx);
$req->setDelaySeconds(xxx);
$res = $req->send();
$res->isSuccess(); // => true 成功
```

### 接受消息

```
$req = new \Mqs\Request\ReceiveMessage('queue-name');
$req->setWaitseconds(30);
$res = $req->send();
if ($res->isSuccess()) {
    $message = $res->getMessage(); // => \Mqs\Message
}
$messageBody = $message->getMessageBody();
// do something
```
