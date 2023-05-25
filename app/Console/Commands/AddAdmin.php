<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class AddAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //

        $username = "azizcruzadmin";
        $email = env('USER_EMAIL');
        $password = Hash::make(env('USER_PASSWORD'));

        try {
            $user = User::create([
                'name' => $username,
                'email' => $email,
                'password' => Hash::make($password),
                'isAdmin' => 1
            ]);
            $this->info('User created successfully');
        } catch (\Throwable $th) {
            $this->error('User exists');
        }
    }
}
