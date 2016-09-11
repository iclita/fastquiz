<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $categories = [
     	  ['name' => 'Art', 'icon' => 'art.png'],
     		['name' => 'Biology', 'icon' => 'biology.png'],
     		['name' => 'Classical Music', 'icon' => 'classical_music.png'],
        ['name' => 'Discovery and Exploration', 'icon' => 'discovery_exploration.png'],
        ['name' => 'Fashion', 'icon' => 'fashion.png'],
        ['name' => 'Film', 'icon' => 'film.png'],
        ['name' => 'Finance', 'icon' => 'finance.png'],
        ['name' => 'Games', 'icon' => 'games.png'],
     		['name' => 'Gastronomy', 'icon' => 'gastronomy.png'],
     		['name' => 'General Science', 'icon' => 'general_science.png'],
     		['name' => 'Geography', 'icon' => 'geography.png'],
     		['name' => 'History', 'icon' => 'history.png'],
     		['name' => 'History of Science', 'icon' => 'history_science.png'],
     		['name' => 'Literature', 'icon' => 'literature.png'],
     		['name' => 'Medicine', 'icon' => 'medicine.png'],
        ['name' => 'Music', 'icon' => 'music.png'],
     		['name' => 'Mythology', 'icon' => 'mythology.png'],
     		['name' => 'Politics', 'icon' => 'politics.png'],
     		['name' => 'Sport', 'icon' => 'sport.png'],
     		['name' => 'Television', 'icon' => 'television.png'],
     		['name' => 'Miscellaneous', 'icon' => 'miscellaneous.png'],
      ];

      foreach ($categories as $category) {
     		DB::table('categories')->insert([
     			'name' => $category['name'],
     			'icon' => $category['icon'],
     		]);
      }

      DB::table('users')->insert([
        'name' => env('ADMIN_NAME'),
        'type' => 'admin',
      ]);
    }
}
