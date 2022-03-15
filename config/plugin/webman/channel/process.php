<?php
/**
 * This file is part of webman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link      http://www.workerman.net/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */


use Webman\Channel\Server;

return [
    'server' => [
        'listen'  => 'frame://0.0.0.0:2206',
        'handler' => Server::class,
        'reloadable' => false,
        'count' => 1, // 必须是1
    ]
];
