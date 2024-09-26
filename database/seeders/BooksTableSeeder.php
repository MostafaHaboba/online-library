<?php

namespace Database\Seeders;
use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        // Create 100 random books
        for ($i = 0; $i < 100; $i++) {
            Book::create([
                'title' => $faker->sentence(3), // Random 3-word title
                'author' => $faker->name, // Random author name
                'quantity' => $faker->optional()->numberBetween(0, 20), // Nullable quantity between 0 and 20
            ]);
        }
    }
}
