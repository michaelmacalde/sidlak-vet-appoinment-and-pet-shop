<?php

namespace Database\Seeders\Ecommerce;

use App\Models\Ecommerce\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdCatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prod_cats = 12;
        $progeressBar = $this->command->getOutput()->createProgressBar($prod_cats);
        $progeressBar->setFormat("CREATING Product Categories\n %current%/%max% [%bar%] %percent:3s%% ");
        $progeressBar->start();

      
            ProductCategory::factory($prod_cats)->create();
            $progeressBar->advance();
        
        $progeressBar->finish();
        $this->command->line('');
    }
}
