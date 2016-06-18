<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Lesson;


class LessonsTest extends ApiTester
{
    /** @test **/
    public function it_fetches_lessons()
    {
        // arrange
        $this->times(5)->makeLesson();

        // act
        $this->getJson('api/v1/lessons');
        // assert
        $this->assertResponseOk();
    }

    /** @test **/
    public function it_fetches_a_single_lesson()
    {
        $this->makeLesson();
        $lesson = $this->getJson('api/v1/lessons/1')->data;

        $this->assertResponseOk();
        $this->assertObjectHasAttributes($lesson, 'body', 'active');
    }

    private function makeLesson($lessonFields = [])
    {
        $lesson = array_merge([
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraph,
            'some_bool' => $this->faker->boolean
        ], $lessonFields);

        while($this->times--) Lesson::create($lesson);
    }

    private function assertObjectHasAttributes()
    {
        $args = func_get_args();
        $object = arrray_shift($args);

        foreach($args as $attribute)
        {
            $this->assertObjectHasAttribute($attribute, $object);
        }
    }
    
}
