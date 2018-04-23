<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class UserAdd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tin-pan:user-add {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds a user/customer to the system.';

    protected $user;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(\App\User $user)
    {
        $this->user = $user;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $email       = $this->argument('email');
        $password    = $this->argument('password');

        $class          = get_class($this->user);
        $user           = new $class;
        $user->name     = explode('@', $email)[0];
        $user->email    = $email;
        $user->password = Hash::make($password);
        $user->save();
        $this->info("$email : $password");
    }
}
