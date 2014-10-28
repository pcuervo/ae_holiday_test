<?php
if(!class_exists('User')){ require('user.php'); }

/**
 * This is an abstract User class
 *
 * @package default
 * @author Pequeño Cuervo
 **/
class Facebook_user extends User {

	private $user_id;
	private $first_name;
	private $last_name;
	private $email;

	/**
	 * Creates a Facebook_user in database
	 *
	 * @param array $user_data 
	 * @return void
	 * @author 
	 **/
	function create_user($user_data = array())
	{

		$user_id = parent::create_user($user_data);

		if($user_id){
			$insert_data = array(
			'user_id' 			=> $user_id,
			'fb_user_id'		=> $user_data['id'],
			'fb_access_token'	=> $user_data['access_token'],
			'gender' 			=> $user_data['gender'],
			'created_at' 		=> date("Y-m-d H:i:s")
			);
			$this->db->insert('Facebook_Users', $insert_data);
		}	
	}// create_user

	/**
	 * Gets user id from database
	 *
	 * @return void
	 * @author 
	 **/
	function get_user_id ()
	{
		return 1;
	}// get_user_id

	/**
	 * Gets user first name
	 *
	 * @return void
	 * @author 
	 **/
	function get_first_name ()
	{
		
	}// get_first_name

	/**
	 * Gets user last name
	 *
	 * @return void
	 * @author 
	 **/
	function get_last_name ()
	{
		
	}// get_last_name

	/**
	 * Gets user last name
	 *
	 * @return void
	 * @author 
	 **/
	function get_email ()
	{
		
	}// get_email
		
}// clase User