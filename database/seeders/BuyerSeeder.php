<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Buyer;
use App\Models\BuyerCriteria;
use Faker\Factory as Faker;

class BuyerSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $fields = ['location', 'price', 'property_type', 'bedrooms', 'bathrooms', 'square_footage'];
        $operators = ['>=', '<=', '=', 'IN'];

        for ($i = 0; $i < 10; $i++) {
            $buyer = Buyer::create([
                'name'   => $faker->name,
                'email'  => $faker->unique()->safeEmail,
                'phone'  => $faker->optional()->phoneNumber,
                'notes'  => $faker->optional()->sentence,
            ]);

            $criteriaCount = rand(1, 5);
            for ($j = 0; $j < $criteriaCount; $j++) {
                $field    = $faker->randomElement($fields);
                $operator = $faker->randomElement($operators);

                // pick an appropriate random value for the chosen field
                switch ($field) {
                    case 'location':
                        $value = $faker->city;
                        break;
                    case 'price':
                        $value = (string) $faker->numberBetween(100_000, 1_000_000);
                        break;
                    case 'property_type':
                        $value = $faker->randomElement(['Single Family','Condo','Townhouse','Multi-Family','Land']);
                        break;
                    case 'bedrooms':
                        $value = (string) $faker->numberBetween(1, 5);
                        break;
                    case 'bathrooms':
                        $value = (string) $faker->randomFloat(1, 1, 4);
                        break;
                    case 'square_footage':
                        $value = (string) $faker->numberBetween(500, 5_000);
                        break;
                }

                BuyerCriteria::create([
                    'buyer_id' => $buyer->id,
                    'field'    => $field,
                    'operator' => $operator,
                    'value'    => $value,
                    'weight'   => rand(1, 10),
                ]);
            }
        }
    }
}
