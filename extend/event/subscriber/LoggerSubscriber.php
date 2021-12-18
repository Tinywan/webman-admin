<?php
/**
 * @desc 日志订阅器
 * @author Tinywan(ShaoBo Wan)
 * @date 2021/12/16 20:26
 */

declare(strict_types=1);

namespace extend\event\subscriber;

use extend\event\LogErrorWriteEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class LoggerSubscriber implements EventSubscriberInterface
{
    /**
     * @desc: 方法描述
     * @return array|string[]
     */
    public static function getSubscribedEvents()
    {
        return [
            LogErrorWriteEvent::NAME => 'onLogErrorWrite',
        ];
    }

    /**
     * @desc: 触发事件
     * @param LogErrorWriteEvent $event
     */
    public function onLogErrorWrite(LogErrorWriteEvent $event)
    {
        // 一些具体的业务逻辑
        var_dump($event->handle());
    }
}