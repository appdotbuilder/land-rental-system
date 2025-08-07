<?php

namespace Database\Seeders;

use App\Models\ExpenseRecord;
use App\Models\IncomeRecord;
use App\Models\Land;
use App\Models\RentalContract;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;

class LandRentalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);

        // Create tenant users
        $tenantUsers = User::factory(3)->create([
            'role' => 'tenant',
        ]);

        // Create lands
        $lands = Land::factory(15)->create();
        
        // Create some additional rented lands
        $rentedLands = Land::factory(8)->create(['status' => 'rented']);
        
        // Combine all lands
        $allLands = $lands->concat($rentedLands);

        // Create tenants
        $tenants = Tenant::factory(12)->create();

        // Create rental contracts for rented lands
        $rentedLands->each(function ($land) use ($tenants) {
            $tenant = $tenants->random();
            
            // Active contracts
            if (random_int(1, 10) <= 7) {
                RentalContract::factory()->active()->create([
                    'tenant_id' => $tenant->id,
                    'land_id' => $land->id,
                ]);
            }
            
            // Some expiring soon
            if (random_int(1, 10) <= 3) {
                RentalContract::factory()->expiringSoon()->create([
                    'tenant_id' => $tenant->id,
                    'land_id' => $land->id,
                ]);
            }
        });

        // Create some additional historical contracts
        RentalContract::factory(8)->create();

        // Create income records
        $contracts = RentalContract::all();
        $contracts->each(function ($contract) {
            // Create 1-3 income records per contract
            IncomeRecord::factory(random_int(1, 3))->create([
                'rental_contract_id' => $contract->id,
                'amount' => $contract->payment_amount,
                'description' => 'Annual Rental Payment - ' . $contract->land->name,
            ]);
        });

        // Create some standalone income records
        IncomeRecord::factory(15)->create([
            'rental_contract_id' => null,
        ]);

        // Create expense records
        ExpenseRecord::factory(40)->create();

        // Create some expenses linked to specific lands
        $allLands->random(10)->each(function ($land) {
            ExpenseRecord::factory(random_int(1, 4))->create([
                'land_id' => $land->id,
            ]);
        });
    }
}