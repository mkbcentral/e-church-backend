<?php

namespace Database\Seeders;

use App\Models\CategoryDeposit;
use App\Models\Currency;
use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        /*
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $roles = [
            ['name' => 'ADMIN'],
            ['name' => 'CREATOR'],
            ['name' => 'MODERATOR'],
            ['name' => 'USER']
        ];

        Role::insert($roles);
        */
        $currencies = [
            ['name' => 'CDF'],
            ['name' => 'USD'],
        ];
        $categories = [
            ['name' => 'Achant instrument', 'church_id' => "9c088906-13d6-4532-93de-c026bf77d16f"],
            ['name' => 'Achat chaise', 'church_id' => "9c088906-13d6-4532-93de-c026bf77d16f"],
            ['name' => 'Paiment loyer', 'church_id' => "9c088906-13d6-4532-93de-c026bf77d16f"],
            ['name' => 'Achat carburant', 'church_id' => "9c088906-13d6-4532-93de-c026bf77d16f"],
        ];
        Currency::insert($currencies);
        CategoryDeposit::insert($categories);
    }
}
