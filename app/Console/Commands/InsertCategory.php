<?php

namespace App\Console\Commands;

use App\Models\Category;
use Illuminate\Console\Command;

class InsertCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:insert-category';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $category = new Category;
        $category->name = "Nutrition";
        $category->save();

        $this->info('Added Successfully');
    }
}
