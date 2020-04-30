<?php

use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // How many ingredients you need, defaulting to 2
        $count = (int)$this->command->ask('How many ingredients do you need ?', 2);
        $this->command->info("Creating {$count} ingredients.");

        $ingredients = factory(App\Ingredient::class, $count)->create();
        $this->command->info('Ingredients Created!');

    }
}
