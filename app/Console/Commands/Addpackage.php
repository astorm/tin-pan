<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Addpackage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tin-pan:add-package {file} {package_name} {version}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds a package to the system';

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
     * @return mixed
     */
    public function handle()
    {
        $movedFile = $this->moveFileToReleases($this->argument('file'));
        if(!$movedFile) { return; }

        $this->generatePackage($this->argument('package_name'),
            $this->argument('version'), $this->argument('file'));
    }

    protected function generatePackage($package_name, $versionString, $file)
    {
        list($vendorName, $packageName) = explode("/", $package_name);

        $package = new \App\Package;
        $package->vendor_name   = $vendorName;
        $package->package_name  = $packageName;
        $package->save();

        $version = new \App\Version;
        $version->version = $versionString;
        $version->filename_on_system = basename($this->argument('file'));

        $package->versions()->save($version);

        $this->info("Done Generating Package Entries");
    }

    protected function moveFileToReleases($file)
    {
        if(!file_exists($file))
        {
            $this->error("Could not find $file");
            return false;
        }

        $finalPath = base_path() . '/releases/' . basename($file);
        if(file_exists($finalPath))
        {
            $this->error("ERROR: File already exists, bailing.");
            $this->error($finalPath);
            return false;
        }

        copy($file, $finalPath);
        $this->info("Copied file");
        $this->info($finalPath);
        return true;
    }

}
