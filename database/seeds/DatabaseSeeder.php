<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Lesson;
use App\Tag;

class DatabaseSeeder extends Seeder
{
	private $tables = [
		'lessons',
		'tags',
		'lesson_tag'
	];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$this->cleanDatabase();

        $this->call(LessonsTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(LessonTagTableSeeder::class);
    }

    private function cleanDatabase()
    {
    	DB::statement('SET FOREIGN_KEY_CHECKS=0');

    	foreach ($this->tables as $tableName)
    	{
    		DB::table($tableName)->truncate();
    	}
  
    	DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}

class LessonsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 30) as $index)
		{
			Lesson::create([
				'title' => $faker->sentence(5),
				'body' => $faker->paragraph(4),
				'some_bool' => $faker->boolean()
			]);
		}
	}

}

class TagsTableSeeder extends Seeder {
	
	public function run()
	{
		$faker = Faker::create();

		foreach(range(1,10) as $index) 
		{
			Tag::create([
				'name' => $faker->word
			]);
		}
	}
}

class LessonTagTableSeeder extends Seeder {
	public function run()
	{
		$faker = Faker::create();


		foreach(range(1,10) as $index)
		{
			DB::table('lesson_tag')->insert([
				'lesson_id' => $faker->numberBetween(1,30),
				'tag_id' => $faker->numberBetween(1,10)
			]);
		}
	}
}
