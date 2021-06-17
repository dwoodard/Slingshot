<?php

namespace Dwoodard\Slingshot\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\Console\Output\NullOutput;

class slingshot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'slingshot';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the Slingshot components and resources';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //check dependencies
        if ($this->output->isVerbose()) {
            $this->info('PHP Version: ' . PHP_VERSION);
            $this->info('Composer: ' . shell_exec('composer -V'));
            $this->info('npm: ' . shell_exec("npm -v || echo 'run: npm install'"));
            $this->info('node: ' . shell_exec("node -v || echo 'run: node install'"));
        }

        $installs = [
            'Setup',
//            'laradock',
//            'Packages composer.json & package.json',
//            'deploy',
//            'Webpack Config',
//            'Auth',
//            'linter',
//            'helpers',
        ];

        $slingshot = 'all' || $this->choice('SLINGSHOT', ['all', ...$installs], 'all');

        if ($slingshot) {
            if ($slingshot == 'all') {
                foreach ($installs as $install) {
                    $this->installSwitch($install);
                }
            } else {
                $this->installSwitch($slingshot);
            }
        }
        return 0;
    }

    /**
     * @param $slingshot
     */
    private function installSwitch($slingshot): void
    {
        $this->line(' ');
        switch ($slingshot) {
            case 'Setup Inertia':
                $this->LaradockInstall();
                $this->installInertiaStack();
                break;



            case 'Packages composer.json & package.json':
                $this->PackagesInstall();
                break;

            case 'Auth':
                $this->AuthInstall();
                break;

            default:
                $this->info("Skipping (no case found) for $slingshot");
                break;
        }
    }

    private function dashDivider(): void
    {
        $this->info("-------------------------------------------------------------------------------------------\n");
    }

    private function LaradockInstall(): void
    {
        $this->info('Installing Laradock');

        $this->info('- Clone laradock');
        if (!file_exists(base_path() . '/laradock')) {
            shell_exec("git clone https://github.com/Laradock/laradock.git");
            shell_exec("rm -rf laradock/.git");
            $this->info('   - removed laradock/.git');
            chdir(base_path() . '/laradock');
            copy('.env.example', '.env');
        } else {
            $this->info('   - laradock was already cloned');
        }


        //update .env for laradock
        $laradockEnv = file_get_contents(base_path() . '/laradock/.env');
        if (!str_contains($laradockEnv, 'DATA_PATH_HOST=../data')) {
            $laradockEnv = preg_replace("/DATA_PATH_HOST=.*/", "DATA_PATH_HOST=../data", $laradockEnv);
            $php_version = '7.4'; # $this->anticipate('What version of php (8.0 - 7.4 - 7.3)', ['8.0', '7.4', '7.3'], '7.4');
            $laradockEnv = preg_replace("/PHP_VERSION=.*/", "PHP_VERSION=" . $php_version, $laradockEnv);
            file_put_contents(base_path() . '/laradock/.env', $laradockEnv);
            $this->info('   - laradock .env was updated');
        } else {
            $this->info('   - laradock .env was already updated');
        }


        //update .env for laravel
        $filename = base_path() . '/.env';
        $env = file_get_contents($filename);
        $this->info("- Checking Laravel .env:");
        if (!str_contains($env, 'DB_HOST=mysql')) {
            $env = preg_replace("/DB_HOST=.*/", "DB_HOST=mysql", $env);
            $this->info('   - DB_HOST has been saved');
        }

        if(!str_contains($env, 'DB_DATABASE=default')){
            $env = preg_replace("/DB_DATABASE=.*/", "DB_DATABASE=default", $env);
            $this->info('   - DB_DATABASE has been saved');

        }

        if(!str_contains($env, 'REDIS_HOST=redis')){
            $env = preg_replace("/REDIS_HOST=.*/", "REDIS_HOST=redis", $env);
            $this->info('   - REDIS_HOST has been saved');

        }

        if(!str_contains($env, 'DB_USERNAME=root')){
            $env = preg_replace("/DB_USERNAME=.*/", "DB_USERNAME=root", $env);
            $this->info('   - DB_USERNAME has been saved');

        }

        if(!str_contains($env, 'DB_PASSWORD=root')){
            $env = preg_replace("/DB_PASSWORD=.*/", "DB_PASSWORD=root", $env);
            $this->info('   - DB_PASSWORD has been saved');

        }

        file_put_contents(base_path() . '/.env', $env);

        //Add envs
        if (!str_contains($env, 'QUEUE_HOST=beanstalkd')) {
            file_put_contents($filename, 'QUEUE_HOST=beanstalkd' . "\n", FILE_APPEND | LOCK_EX);
        }


        //Add data directory
        $filename = base_path() . '/data';
        if (!file_exists($filename)) {
            mkdir($filename, 0777, true);
            $this->info('- data directory added');
        } else {
            $this->info('- data directory exists');
        }

        //add .gitignore items
        $this->info("- Check git " . base_path() . "/.gitignore");
        $gitignore = file_get_contents(base_path() . '/.gitignore');
        $gitignoreChecks = [
            '/data/',
            '!/laradock/.env',
        ];
        foreach ($gitignoreChecks as $check) {
            if (!str_contains($gitignore, $check)) {
                file_put_contents(base_path() . '/.gitignore', $check . "\n", FILE_APPEND | LOCK_EX);
            }
        }
    }

    private function installInertiaStack(): void
    {
        $this->info("installInertiaStack:");
        chdir(base_path());

        recursiveCopy(base_path('vendor/dwoodard/slingshot/src/stubs/app'), app_path());
        $this->info("- copied app");

        recursiveCopy(base_path('vendor/dwoodard/slingshot/src/stubs/root'), base_path());
        $this->info("- copied / (root)");

        recursiveCopy(base_path('vendor/dwoodard/slingshot/src/stubs/resources'), resource_path());
        $this->info("- copied resources");

        recursiveCopy(base_path('vendor/dwoodard/slingshot/src/stubs/routes'), base_path('routes'));
        $this->info("- copied routes");

        recursiveCopy(base_path('vendor/dwoodard/slingshot/src/stubs/database'), base_path('database'));
        $this->info("- copied database");

        recursiveCopy(base_path('vendor/dwoodard/slingshot/src/stubs/public'), base_path('public'));
        $this->info("- copied public");

        $this->dashDivider();

        $this->info('https://github.com/spatie/laravel-schemaless-attributes#installation');
        $this->info('   - $table->schemalessAttributes(\'extra_attributes\');');

        $this->dashDivider();

        $this->info('https://spatie.be/docs/laravel-permission/v4/installation-laravel');

        $this->dashDivider();

        $this->info('https://github.com/VentureCraft/revisionable');

        $this->dashDivider();

        $this->info('https://spatie.be/docs/laravel-permission/v4/installation-laravel');

        $this->dashDivider();

        $this->info('https://github.com/silviolleite/laravel-pwa');
        $this->info(shell_exec('php artisan vendor:publish --provider="LaravelPWA\Providers\LaravelPWAServiceProvider"'));

        $this->dashDivider();

        shell_exec('php artisan ziggy:generate');
        shell_exec('npm i && npm run dev');
    }

    private function PackagesInstall(): void
    {
        $this->info("composer.json & package.json:");
    }

    private function AuthInstall(): void
    {
        if ($this->confirm("Laravel UI vue Auth \n\t- Install (php artisan  ui vue --auth)?", 'yes')) {
            chdir(base_path());
            $output = shell_exec('php artisan ui vue --auth -n');
            $this->info($output);
            $this->dashDivider();
        } else {
            $this->warn('Skipping' . PHP_EOL);
        }
    }




    /**
     * Replace a given string within a given file.
     *
     * @param  string  $search
     * @param  string  $replace
     * @param  string  $path
     * @return void
     */
    protected function replaceInFile($search, $replace, $path)
    {
        file_put_contents($path, str_replace($search, $replace, file_get_contents($path)));
    }



    /**
     * Install the service provider in the application configuration file.
     *
     * @param  string  $after
     * @param  string  $name
     * @return void
     */
    protected function installServiceProviderAfter($after, $name)
    {
        if (! Str::contains($appConfig = file_get_contents(config_path('app.php')), 'App\\Providers\\'.$name.'::class')) {
            file_put_contents(config_path('app.php'), str_replace(
                'App\\Providers\\'.$after.'::class,',
                'App\\Providers\\'.$after.'::class,'.PHP_EOL.'        App\\Providers\\'.$name.'::class,',
                $appConfig
            ));
        }
    }
}
