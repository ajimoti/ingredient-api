<?php

use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // How many recipe you need, defaulting to 2
        $count = (int)$this->command->ask('How many recipe do you need ?', 2);
        $this->command->info("Creating {$count} recipe.");

        // Ask range for ingredients per recipe needed
        $r = 1 . '-' . 4;
        $ingredientRange = $this->command->ask("How many ingredients per recipe do you need ? Sample input should look like '1-3'", $r);
        $this->command->info("Creating {$count} recipes each having ingredients range of {$ingredientRange}.");

        // Create the recipe
        $recipe = factory(App\Recipe::class, $count)->create();

        $recipe->each(function($recipe) use ($ingredientRange){
            factory(App\IngredientRecipe::class, $this->count($ingredientRange))
                    ->create(['recipe_id' => $recipe->id]);
        });
        $this->command->info('Recipes Created!');
    }

    // Return random value in given range
    private function count($range)
    {
        $values = explode('-', $range);
        return rand($values[0], $values[1]);
    }
}
