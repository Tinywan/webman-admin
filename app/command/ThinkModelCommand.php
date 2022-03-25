<?php

namespace app\command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Webman\Console\Util;

class ThinkModelCommand extends Command
{
    protected static $defaultName = 'think:model';
    protected static $defaultDescription = 'think model';

    /**
     * @return void
     */
    protected function configure()
    {
        $this->addArgument('name', InputArgument::REQUIRED, 'Model name');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $class = $input->getArgument('name');
        $class = Util::nameToClass($class);
        $output->writeln("Make model $class");
        if (!($pos = strrpos($class, '/'))) {
            $file = "app/common/model/".$class."Model.php";
            $namespace = 'app\common\model';
        } else {
            $path = 'app/common/model';
            $class = ucfirst(substr($class, $pos + 1));
            $file = "$path/".$class."Model.php";
            $namespace = str_replace('/', '\\', $path);
        }
        $this->createTpModel($class, $namespace, $file);
        return self::SUCCESS;
    }

    /**
     * @param $class
     * @param $namespace
     * @param $file
     * @return void
     */
    protected function createTpModel($class, $namespace, $file)
    {
        $path = pathinfo($file, PATHINFO_DIRNAME);
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $table = Util::classToName($class);
        $table_val = 'null';
        try {
            $prefix = config('thinkorm.connections.mysql.prefix') ?? '';
            if (\think\facade\Db::query("show tables like '{$prefix}{$table}'")) {
                $table = "{$prefix}{$table}";
                $table_val = "'$table'";
            } else if (\think\facade\Db::query("show tables like '{$prefix}{$table}s'")) {
                $table = "{$prefix}{$table}s";
                $table_val = "'$table'";
            }
        } catch (\Throwable $e) {}
        $modelName = $class . 'Model';
        $current_time = date('Y/m/d H:i');
        $model_content = <<<EOF
<?php
/**
 * @desc $modelName
 * @author Tinywan(ShaoBo Wan)
 * @date $current_time
 */
declare(strict_types=1);

namespace $namespace;

class $modelName extends BaseModel
{
    /**
     * 数据表名称
     * @var string
     */
    protected \$table = $table_val;
    
}
EOF;
        file_put_contents($file, $model_content);
    }

}
