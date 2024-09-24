<?php

namespace Database\Seeders;

use App\Enums\UserRoleEnum;
use App\Models\Invoice;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
                        CustomerSeeder::class
                    ]);


        $admin = User::factory()->create([
                                             'name'              => 'Amin User',
                                             'email'             => 'admin@example.com',
                                             'password'          => Hash::make('password'),
                                             'role'              => UserRoleEnum::ADMIN->value,
                                             'email_verified_at' => now(),
                                         ]);

        $employee = User::factory()->create([
                                                'name'              => 'Employee User',
                                                'email'             => 'employee@example.com',
                                                'password'          => Hash::make('password'),
                                                'role'              => UserRoleEnum::EMPLOYEE->value,
                                                'email_verified_at' => now(),
                                            ]);

        $employee->invoices()->createMany(Invoice::factory()->count(10)->make()->toArray());

        User::factory()
            ->has(Invoice::factory()->count(10))
            ->count(10)
            ->create();
    }
}
