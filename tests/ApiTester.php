<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Faker\Factory as Faker;

class ApiTester extends TestCase {

	protected $faker;

	protected $times = 1;

	function __construct()
	{
		$this->faker = Faker::create();
	}

	public function setUp()
	{
		parent::setUp();

		Artisan::call('migrate');
	}

	protected function times($count)
    {
        $this->times = $count;

        return $this;
    }

    protected function getJson($uri)
    {
    	return json_decode($this->call('GET', $uri)->getContent());
    }

}