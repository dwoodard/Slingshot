<?php

namespace Dwoodard\Slingshot\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

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
    protected $description = 'Command description';

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
            'laradock',
            'composer packages',
            'Package Json files',
            'deploy',
            'Auth',
            'linter',
            'helpers',
        ];

        $slingshot = $this->choice('SLINGSHOT', ['all', ...$installs], 'all');

        if ($slingshot) {
            if ($slingshot == 'all') {
                foreach ($installs as $install) {
                    $this->installSwitch($install);
                }
            } else {
                $this->installSwitch($slingshot);
            }
        }

        chdir(base_path());
        shell_exec("composer dump-autoload");
        chdir(base_path());
        shell_exec("npm i");
        shell_exec("npm run dev");
        return 0;
    }

    /**
     * @param $slingshot
     */
    private function installSwitch($slingshot): void
    {
        $this->line(' ');
        switch ($slingshot) {
            case 'laradock':
                $this->LaradockInstall();
                break;

            case 'composer packages':
                $this->ComposerPackagesInstall();
                break;

            case 'Auth':
                $this->AuthInstall();
                break;

            case 'deploy':
                $this->DeployInstall();
                break;

            default:
                $this->info("Skipping (no case found) for $slingshot");
                break;
        }
    }

    private function dashDivider(): void
    {
        $this->info("-------------------------------------------------------------------------------------------\n\n");
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
            copy('.env.example', '.env',);
        } else {
            $this->info('   - laradock was already cloned');
        }


        //update .env for laradock
        $laradockEnv = file_get_contents(base_path() . '/laradock/.env');
        if (!str_contains($laradockEnv, 'DATA_PATH_HOST=../data')) {
            $laradockEnv = preg_replace("/DATA_PATH_HOST=.*/", "DATA_PATH_HOST=../data", $laradockEnv);
            $php_version = $this->anticipate('What version of php (8.0 - 7.4 - 7.3)', ['8.0', '7.4', '7.3'], '7.4');
            $laradockEnv = preg_replace("/PHP_VERSION=.*/", "PHP_VERSION=" . $php_version, $laradockEnv);
            file_put_contents(base_path() . '/laradock/.env', $laradockEnv);
            $this->info('   - laradock .env was updated');
        } else {
            $this->info('   - laradock .env was already updated');
        }


        //update .env for laravel
        $filename = base_path() . '/.env';
        $env = file_get_contents($filename);
        if (!str_contains($env, 'DB_HOST=mysql')) {
            //Update envs
            $env = preg_replace("/DB_HOST=.*/", "DB_HOST=mysql", $env);
            $env = preg_replace("/REDIS_HOST=.*/", "REDIS_HOST=redis", $env);
            $env = preg_replace("/DB_USERNAME=.*/", "DB_USERNAME=root", $env);
            $env = preg_replace("/DB_PASSWORD=.*/", "DB_PASSWORD=root", $env);
            file_put_contents(base_path() . '/.env', $env);
            $this->info('   - laravel .env has been saved');

            //Add envs
            if (!str_contains($env, 'QUEUE_HOST=beanstalkd')) {
                file_put_contents($filename, 'QUEUE_HOST=beanstalkd' . "\n", FILE_APPEND | LOCK_EX);
            }

        } else {
            $this->info('   - laravel .env was already updated');
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

    private function ComposerPackagesInstall(): void
    {
        $this->info("Composer Packages:");

        if ($this->confirm("https://github.com/Wulfheart/pretty-routes \n\t- Install Pretty Routes?", 'yes')) {
            shell_exec('composer -q require --dev wulfheart/pretty_routes');
            $this->dashDivider();
        } else {
            $this->warn('Skipping' . PHP_EOL);
        }


        if ($this->confirm("https://github.com/spatie/laravel-schemaless-attributes \n\t- Install Laravel Schemaless Attributes?", 'yes')) {
            shell_exec('composer -q require spatie/laravel-schemaless-attributes');
            $this->dashDivider();
        } else {
            $this->warn('Skipping' . PHP_EOL);
        }


        if ($this->confirm("https://spatie.be/docs/laravel-permission/v4/installation-laravel \n\t- Spatie Laravel Permission?", 'yes')) {
            shell_exec('composer -q require spatie/laravel-permission');
            $this->dashDivider();
        } else {
            $this->warn('Skipping' . PHP_EOL);
        }


        if ($this->confirm("https://github.com/VentureCraft/revisionable \n\t- Install Revisionable?", 'yes')) {
            shell_exec('composer -q require venturecraft/revisionable');
            chdir(base_path());
            $this->info(shell_exec('php artisan vendor:publish --provider="Venturecraft\Revisionable\RevisionableServiceProvider"'));
            $this->dashDivider();
        } else {
            $this->warn('Skipping' . PHP_EOL);
        }

        if ($this->confirm("https://github.com/silviolleite/laravel-pwa \n\t- Install Laravel Pwa?", 'yes')) {
            shell_exec('composer -q require silviolleite/laravelpwa --prefer-dist');
            chdir(base_path());
            $this->info(shell_exec('php artisan vendor:publish --provider="LaravelPWA\Providers\LaravelPWAServiceProvider"'));
            $this->dashDivider();
        } else {
            $this->warn('Skipping' . PHP_EOL);
        }


        if ($this->confirm("https://inertiajs.com/ \n\t- Install Inertia Js?", 'yes')) {
            chdir(base_path());
            shell_exec('composer -q require inertiajs/inertia-laravel');
            $this->info('create app.blade.php stub @inertia');
            $this->dashDivider();
        } else {
            $this->warn('Skipping' . PHP_EOL);
        }
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

    private function DeployInstall(): void
    {
        $this->info(__DIR__);
        if (!file_exists(base_path() . '/deploy.sh')) {
            chdir(__DIR__);
            copy('../../stubs/deploy.sh',base_path().'/deploy.sh');
            chmod(base_path().'/deploy.sh',0777);

        }
        else {
            $this->info('   - deploy already exist');
        }
    }


}
