<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Order;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 100; $i++) {
            Order::create([
                'quantity' => $faker->numberBetween(1, 10),
                'sub_total'=>$faker->numberBetween(1, 10000),
                'total_discount' => $faker->numberBetween(1, 100),
                'total_tax'=>$faker->numberBetween(1, 500),
                'grand_total'=>$faker->numberBetween(1, 10000),
                'unique_id' =>$faker->numberBetween(1, 1000000),
                'created_at' =>$faker->dateTime()->format('Y-m-d H:i:s')
            ]);
        }

    }
}
