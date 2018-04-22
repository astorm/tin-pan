<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Exception;
use Illuminate\Database\QueryException;

class ManageUserPackages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tin-pan:manage-user-package {package_name} ' .
        '{user_id} {--remove}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add or remove a user from a package';

    protected $package;
    protected $user;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(\App\Package $package, \App\User $user)
    {
        $this->package  = $package;
        $this->user     = $user;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if($this->option('remove'))
        {
            return $this->handleRemove();
        }
        else
        {
            return $this->handleAdd();
        }
    }

    protected function handleRemove()
    {
        $user    = $this->getUser();
        $package = $this->getPackage();

        try
        {
            $package->users()->detach([$user->id]);
        }
        catch (QueryException $e)
        {
            $this->error($e->getMessage());
        }

        $this->info("Removed {$user->id} :: {$package->id}");
    }

    protected function handleAdd()
    {
        $user    = $this->getUser();
        $package = $this->getPackage();

        try
        {
            $package->users()->attach([$user->id]);
        }
        catch (QueryException $e)
        {
            $this->error($e->getMessage());
        }

        $this->info("Added {$user->id} :: {$package->id}");
    }

    protected function getPackage()
    {
        $full_name  = $this->argument('package_name');
        $parts      = explode('/', $full_name);

        $package = $this->package->where('vendor_name', '=', array_shift($parts))
            ->where('package_name', '=', array_shift($parts))
            ->get()->first();

        if(!$package)
        {
            throw new Exception("Unknown Package: $full_name");
        }
        return $package;
    }

    protected function getUser()
    {
        $user_id = $this->argument('user_id');
        if(!is_numeric($user_id))
        {
            $user = $this->user->where('email', '=', $user_id)
                ->get()->first();
            if($user)
            {
                $user_id = $user->id;
            }
        }
        $user = $this->user->find($user_id);
        if(!$user)
        {
            throw new Exception("Unknown User ID: $user_id");
        }
        return $user;
    }
}
