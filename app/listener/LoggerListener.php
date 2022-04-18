<?php
/**
 * @desc LoggerListener.php 描述信息
 * @author Tinywan(ShaoBo Wan)
 * @date 2022/4/18 17:15
 */
declare(strict_types=1);

namespace app\listener;


use Symfony\Contracts\EventDispatcher\Event;

class LoggerListener extends Event
{
    const NAME = 'log.error.write';  // 事件名，事件的唯一标识

    public array $log;

    /**
     * LoggerListener constructor.
     * @param array $log
     */
    public function __construct(array $log)
    {
        $this->log = $log;
    }

    /**
     * @desc: handle 描述
     * @return array
     */
    public function handle(): array
    {
        return $this->log;
    }
}