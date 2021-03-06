<?php
/**
 * Tests the LotController functions that store, edit and delete lot infomation 
 * @author  (c) @iLabAfrica, Emmanuel Kitsao, Brian Kiprop, Thomas Mapesa, Anthony Ereng, Lucy Mbugua , Pius mathii
 */
class LotControllerTest extends TestCase 
{
	
	public function setup()
	{
		parent::setUp();
		Artisan::call('migrate');
		Artisan::call('db:seed');
		$this->setVariables();
	}

	/**
	 * Contains the testing sample data for the LotController.
	 *
	 * @return void
	 */
	private function setVariables(){
		//Setting the current user
		$this->be(User::find(4));

		$this->input = array(
			'lot_no'=>'2015',
			'description' => 'kenya yao',
			'expiry' => '12-12-2015',
			);

		$this->inputUpdate = array(
			'lot_no'=>'2015',
			'description' => 'Kenya yetu',
			'expiry' => '12-05-2020',
			);
	}
	/**
	* Testing Lot Index page
	*/
	public function testIndex()
	{
		$response = $this->action('GET', 'LotController@index');
		$this->assertTrue($response->isOk());
		$this->assertViewHas('lots');
	}
	/**
	* Testing Lot create method
	*/
	public function testCreate()
	{
		$response = $this->action('GET', 'LotController@create');
		$this->assertTrue($response->isOk());
	}
	/**
	* Testing Lot store function
	*/
	public function testStore()
	{
		echo "\n\nLOT CONTROLLER TEST\n\n";

		$response = $this->action('POST', 'LotController@store', $this->input);
		$this->assertTrue($response->isRedirection());
		
		$testLot = Lot::orderBy('id', 'DESC')->first();
		$this->assertEquals($testLot->lot_no, $this->input['lot_no']);
		$this->assertEquals($testLot->description, $this->input['description']);
		$this->assertEquals($testLot->expiry, $this->input['expiry']);
		
	}
	/**
	* Testing Lot Update function
	*/
	public function testUpdate()
	{
		$response = $this->action('POST', 'LotController@store', $this->inputUpdate);
		$this->assertTrue($response->isRedirection());

		$testLot = Lot::orderBy('id', 'DESC')->first();
		$this->assertEquals($testLot->lot_no, $this->inputUpdate['lot_no']);
		$this->assertEquals($testLot->description, $this->inputUpdate['description']);
		$this->assertEquals($testLot->expiry, $this->inputUpdate['expiry']);
	}

	/**
	* Testing Lot destroy funciton
	*/
	public function testDelete()
	{
		$this->be(User::first());
		$this->runStore($this->input);
		$lot = new LotController;
		$lot->delete(1);
		$lotDeleted = Lot::withTrashed()->find(1);
		$this->assertNotNull($lotDeleted->deleted_at);
	}
	/**
	 *Executes the store function in the LotController
	 * @param  array $input Lot details
	* @return void
	 */
	public function runStore($input)
	{
		Input::replace($input);
		$lot = new LotController;
		$lot->store();
	}

	 /**
  	 * Executes the update function in the LotController
  	 * @param  array $input Lot details, int $id ID of the Lot stored
	 * @return void
  	 */
	public function runUpdate($input, $id)
	{
		Input::replace($input);
		$lot = new LotController;
		$lot->update($id);
	}
}