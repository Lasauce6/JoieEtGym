<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Command\Command as CommandAlias;

class CreateUser extends Command
{
    protected $signature = 'user:create';
    protected $description = 'Créer un nouvel utilisateur via la CLI';

    public function handle()
    {
        $name = $this->ask('Nom de l\'utilisateur');
        $email = $this->ask('Email');
        $password = $this->secret('Mot de passe');

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $this->info("L'utilisateur $email a été créé avec succès !");

        return CommandAlias::SUCCESS;
    }
}
