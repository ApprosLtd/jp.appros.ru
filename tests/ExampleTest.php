<?php

class ExampleTest extends TestCase {

	/**
	 * A basic functional test example.
	 * phpunit --bootstrap vendor/autoload.php tests/ExampleTest.php
	 * @return void
	 */
	public function testBasicExample()
	{
		$response = $this->call('GET', '/');

		$this->assertEquals(200, $response->getStatusCode());
	}

}
