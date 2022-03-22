<?php

namespace app\command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;


class MakeCurdCommand extends Command
{
    protected static $defaultName = 'make:curd';
    protected static $defaultDescription = 'make curd';

    /**
     * @return void
     */
    protected function configure()
    {
        $this->setName('make:curd')
            ->addArgument('name', InputArgument::REQUIRED, 'Controller name')
            ->setDescription('Create a new resource curd class. Model name --module name');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        $output->writeln("Make controller $name ");

        $suffix = config('app.controller_suffix', '');

        if ($suffix && !strpos($name, $suffix)) {
            $name .= $suffix;
        }

        if (!($pos = strrpos($name, '/'))) {
            $name = ucfirst($name);
            $file = "app/controller/$name.php";
            $namespace = 'app\controller';
        } else {
            $path = 'app/' . substr($name, 0, $pos) . '/controller';
            $name = ucfirst(substr($name, $pos + 1));
            $file = "$path/$name.php";
            $namespace = str_replace('/', '\\', $path);
        }
        $this->createController($name, $namespace, $file);

        return self::SUCCESS;
    }

    /**
     * 获取文件路径字符串
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . DIRECTORY_SEPARATOR . 'stubs' . DIRECTORY_SEPARATOR . 'curd2.stub';
    }

    /**
     * @param $name
     * @param $namespace
     * @param $file
     * @return void
     */
    protected function createController($name, $namespace, $file)
    {
        $path = pathinfo($file, PATHINFO_DIRNAME);
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        system('./webman think:model common/' . $name);
        $modelName = $name . 'Model';
        $stub = file_get_contents($this->getStub());
        $classname = str_replace(['{%className%}', '{%namespace%}','{%model%}','{%current_time%}'], [
            $name,
            $namespace,
            $modelName,
            date('Y/m/d H:i')
        ], $stub);
        file_put_contents($file, $classname);
    }

}
