<?php
use Orm\Model;

class Model_Image extends Model
{
	protected static $_properties = array(
		'id',
		'url',
		'clipping_id',
		'created_at',
		'updated_at',
	);

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
		$val->add_field('clipping_id', 'ClippingId', 'required|max_length[255]');
		$val->add_field('url', 'url', 'required|max_length[255]');

		return $val;
	}

}
