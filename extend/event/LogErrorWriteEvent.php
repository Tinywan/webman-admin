<?php
/**
 * @desc 日志写入事件
 * @author Tinywan(ShaoBo Wan)
 * @date 2021/12/18 9:24
 */

declare(strict_types=1);

namespace extend\event;


use Symfony\Contracts\EventDispatcher\Event;

class LogErrorWriteEvent extends Event
{
    const NAME = 'log.error.write';  // 事件名，事件的唯一标识

    /** @var array */
    public array $log;

    public function __construct(array $log)
    {
        $this->log = $log;
    }

    public function handle()
    {
        return $this->log;
    }
}