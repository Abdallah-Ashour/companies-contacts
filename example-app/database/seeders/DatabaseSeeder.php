<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Company::factory(10)->create();
        // Contact::factory(100)->create();
       User::factory(10)->has(
        Company::factory(10)->has(
            Contact::factory(10)->state(function($attributs, Company $company){
                  return [
                      'user_id' => $company->user_id
                  ];
            })
        )
       )->create();
        // $this->call(
        //     [companySeeder::class,
        //     ContactSeeder::class]
        // );

    }
}
