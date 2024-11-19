<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'aye',
            'email' => 'aye@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('qwerty12345'),
        ]);

        // $role = Role::create(['name' => 'admin']);

        // $user->assignRole($role);

        $totalUsers = 15;
        $progressBar = $this->command->getOutput()->createProgressBar($totalUsers);
        $progressBar->setFormat("CREATING USER\n %current%/%max% [%bar%] %percent:3s%%");

        $progressBar->start();

        for ($i = 0; $i < $totalUsers; $i++) {
            User::factory()->create();
            $progressBar->advance();
        }

        $progressBar->finish();
        $this->command->line('');
    }
}
