<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AddUserToPackage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tin-pan:add-user-to-package {user} {package}';

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
    public function __construct(
        \App\Helper\LoadUser $userLoader,
        \App\Helper\LoadPackage $packageLoader)
    {
        parent::__construct();
        $this->userLoader = $userLoader;
        $this->packageLoader = $packageLoader;
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user       = $this->userLoader->load($this->argument('user'));
        $package    = $this->packageLoader->load($this->argument('package'));

        $package->users()->save($user);
    }
}
