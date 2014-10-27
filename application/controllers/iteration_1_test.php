<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Iteration_1_test extends CI_Controller {

	function __construct(){
		$this->load->library('unit_test');
	}
	/**
	 */
	public function index()
	{
		// simple unit test
		$test = 1 + 1;
		$expected_result = 2;
		$test_name = 'Adds one plus one';
		$this->unit->run($test, $expected_result, $test_name);
	}

	/**
	 * Tests to save a Facebook user into DB
	 *
	 * @return void
	 * @author 
	 **/
	function save_fb_user($fb_user_data)
	{
	}

}// Iteration_1_test
