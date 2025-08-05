<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\Job;

class CompaniesAndJobsSeeder extends Seeder
{
    public function run(): void
    {
        Company::factory(5)->create()->each(function ($company) {
            Job::factory(rand(30, 70))->create([
                'company_id' => $company->id,
                'user_id' => 1,
            ]);
        });
    }
}