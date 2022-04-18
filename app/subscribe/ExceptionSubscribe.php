<?php
/**
 * @desc ExceptionSubscribe.php 描述信息
 * @author Tinywan(ShaoBo Wan)
 * @date 2022/4/18 17:13
 */
declare(strict_types=1);

namespace app\subscribe;


use app\listener\LoggerListener;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Contracts\EventDispatcher\Event;

class ExceptionSubscribe implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        // 监听的不同事件，当事件触发时，会调用 onResponse 方法
        return [
            LoggerListener::NAME => 'onExceptionHandle',
        ];
    }

    public function onExceptionHandle(Event $event)
    {
        // 一些具体的业务逻辑
        var_dump($event->handle());
    }
}