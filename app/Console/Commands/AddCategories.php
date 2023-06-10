<?php

namespace App\Console\Commands;

use App\Models\Category;
use Illuminate\Console\Command;

class AddCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert Categories';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $categories = array(
            "Astronomy",
            "Biology",
            "Chemistry",
            "Earth Science",
            "Ecology",
            "Genetics",
            "Mathematics",
            "Medicine",
            "Physics",
            "Psychology",
            "Technology",
            "Nutrition"
        );

        foreach ($categories as $name) {
            $category = new Category;
            $category->name = $name;
            $category->save();
        }

        $this->info('Added Successfully');
    }
}
