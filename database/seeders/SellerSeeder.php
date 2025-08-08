<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seller;
use Faker\Factory as Faker;

class SellerSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $dealTypes = ['Cash','Subject-To','Seller-Finance','Hybrid'];

        for ($i = 0; $i < 10; $i++) {
            // pick a random deal type
            $type = $faker->randomElement($dealTypes);

            Seller::create([
                'name'                          => $faker->name,
                'email'                         => $faker->unique()->safeEmail,
                'phone'                         => $faker->optional()->phoneNumber,
                'property_address'              => $faker->streetAddress,
                'property_city'                 => $faker->city,
                'property_state'                => $faker->stateAbbr,
                'property_zip'                  => $faker->postcode,
                'deal_type'                     => $type,
                'asking_price'                  => $faker->numberBetween(50_000, 1_500_000),
                'bedrooms'                      => $faker->numberBetween(1, 6),
                'bathrooms'                     => $faker->randomFloat(1, 1, 4),
                'square_footage'                => $faker->numberBetween(500, 5_000),
                'arv'                           => $faker->numberBetween(100_000, 2_000_000),
                'estimated_repairs'             => $faker->numberBetween(0, 50_000),
                'back_taxes'                    => $faker->numberBetween(0, 10_000),
                'title_liens'                   => $faker->numberBetween(0, 10_000),
                // creative & cash fields
                'mortgage_balance'              => $type !== 'Cash' ? $faker->numberBetween(50_000, 300_000) : null,
                'monthly_piti'                  => $type !== 'Cash' ? $faker->numberBetween(500, 3_000) : null,
                'arrears'                       => $type !== 'Cash' ? $faker->numberBetween(0, 5_000) : null,
                'cash_to_seller'                => in_array($type, ['Subject-To','Hybrid']) ? $faker->numberBetween(1_000, 50_000) : null,
                'down_payment'                  => $type === 'Seller-Finance' ? $faker->numberBetween(5_000, 100_000) : null,
                'monthly_payment_to_seller'     => $type === 'Hybrid' ? $faker->numberBetween(500, 3_000) : null,
                'interest_rate'                 => $type !== 'Cash' ? $faker->randomFloat(2, 0, 10) : null,
                'term_length'                   => $type !== 'Cash' ? $faker->numberBetween(6, 360) : null,
                'balloon'                       => $type !== 'Cash' ? $faker->boolean(50) : false,
                // **only ever 0–10 years** so it fits
                'balloon_years'                 => $type !== 'Cash' && $faker->boolean(50)
                                                    ? $faker->numberBetween(1, 10)
                                                    : null,
                'closing_costs'                 => $faker->numberBetween(500, 5_000),
                'transaction_coordinator_fees'  => $faker->numberBetween(200, 2_000),
                'additional_details'            => $faker->optional()->sentence,
            ]);
        }
    }
}
