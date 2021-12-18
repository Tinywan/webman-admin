<?php
/**
 * @desc 描述
 * @author Tinywan(ShaoBo Wan)
 * @date 2021/12/18 17:30
 */

return [
    // 事件监听
    'listener'    => [
        \extend\event\LogErrorWriteEvent::NAME  => \extend\event\LogErrorWriteEvent::class,
    ],

    // 事件订阅
    'subscriber' => [
        \extend\event\subscriber\LoggerSubscriber::class,
    ],
];