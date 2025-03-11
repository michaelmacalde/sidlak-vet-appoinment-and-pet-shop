<?php

namespace Database\Factories\Ecommerce;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ecommerce\ProductCategory>
 */
class ProductCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected static $prod_cat_nameIndex = 0;

    protected static $prod_cat_names = [
        'Dog Food',
        'Cat Food',
        'Dog Treats',
        'Cat Treats',
        'Dog Collars',
        'Cat Collars',
        'Dog Leashes',
        'Cat Leashes',
        'Dog Toys',
        'Cat Toys',
        'Dog Clothes',
        'Cat Clothes',
     ];
    public function definition(): array
    {
        if(self::$prod_cat_nameIndex >= count(self::$prod_cat_names)){
            throw new \Exception("No Product category available.");
        
        }

        $prod_cat_name = self::$prod_cat_names[self::$prod_cat_nameIndex];
            self::$prod_cat_nameIndex++;

        $prod_desc = [];
        for ($i = 0; $i < 3; $i++) {
            $text = $this->faker->paragraph(2,true); // Generate 2 paragraphs of lorem
            $words = array_slice(explode(' ', $text), 0, 170); // Get first 170 words
            $paragraphText = implode(' ',$words);

            $prod_desc[] = "<p>$paragraphText</p>";
           
        }
        $prod_desc_content = implode(' ', $prod_desc);

        return [
            'prod_cat_name' => $prod_cat_name,
            'prod_cat_description' => $prod_desc_content,
            'prod_cat_slug' => Str::slug($prod_cat_name),
        ];

    }


}
