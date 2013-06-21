<?php
use Orm\Model;

class Model_Customer extends Model
{
	protected static $_properties = array(
		'id',
		'company_name',
		'first_name',
		'last_name',
		'email',
		'phone',
		'street',
		'street_number',
		'zip',
		'city',
		'user_id',
		'country',
		'created_at',
		'updated_at',
	);
	
	protected static $_many_many = array('labels');
	protected static $_has_many = array('clippings');

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('company_name', 'Company Name', 'required|max_length[255]');
		$val->add_field('first_name', 'First Name', 'required|max_length[255]');
		$val->add_field('last_name', 'Last Name', 'required|max_length[255]');
		$val->add_field('email', 'Email', 'required|valid_email|max_length[255]');
		$val->add_field('phone', 'Phone', 'required|max_length[255]');
		$val->add_field('street', 'Street', 'required|max_length[255]');
		$val->add_field('street_number', 'Street Number', 'required|max_length[255]');
		$val->add_field('zip', 'Zip', 'required|max_length[255]');
		$val->add_field('city', 'City', 'required|max_length[255]');
		$val->add_field('country', 'Country', 'required|max_length[255]');
		return $val;
	}

}
