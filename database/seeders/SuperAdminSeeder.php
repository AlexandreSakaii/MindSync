<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SuperAdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'email' => 'SuperAdmMindSync@gmail.com',
            'password' => Hash::make('R3$1st3nc14!'),
            'is_superadmin' => true,
            'clinic_name' => 'Default Clinic',
            'cnpj' => '00.000.000/0000-00',
            'phone' => '0000000000',
            'responsible_cpf' => '000.000.000-00',
            'responsible_name' => 'Super Admin Responsible',
            'city' => 'Default City',
            'state' => 'Default State',
            'country' => 'Default Country',
            'cep' => '00000-000',
            'street' => 'Default Street',
            'number' => '000',
            'complement' => 'Default Complement',
            'plan_name' => 'Default Plan',
            'plan_value' => 0.00,
            'quantidadePsicologos' => '100',
        ]);
    }
}
