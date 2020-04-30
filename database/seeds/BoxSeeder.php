<?php

use Illuminate\Database\Seeder;

class BoxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // How many box you need, defaulting to 10
        $count = (int)$this->command->ask('How many Box do you need ?', 2);
        $this->command->info("Creating {$count} Box.");

        // Ask range for recipes per box needed
        $r = 1 . '-' . 4;
        $recipeRange = $this->command->ask("How many recipes per box do you need ? Sample input should look like '1-3'", $r);
        $this->command->info("Creating {$count} boxes each having a recipe range of {$recipeRange}.");

        // Create the Box
        $box = factory(App\Box::class, $count)->create();

        $box->each(function($box) use ($recipeRange){
            factory(App\BoxRecipe::class, $this->count($recipeRange))
                    ->create(['box_id' => $box->id]);
        });
        $this->command->info('Boxes Created!');
    }

    // Return random value in given range
    private function count($range)
    {
        $values = explode('-', $range);
        return rand($values[0], $values[1]);
    }
}
