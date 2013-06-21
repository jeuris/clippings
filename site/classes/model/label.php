<?php
use Orm\Model;

class Model_Label extends Model
{
	protected static $_properties = array(
		'id',
		'name',
		'created_at',
		'updated_at',
	);
	
	protected static $_many_many = array('customers');
	
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

	protected static $_has_many = array(
    'clippings' => array(
        'key_from' => 'id',
        'model_to' => 'Model_Clipping',
        'key_to' => 'label_id',
        'cascade_save' => true,
        'cascade_delete' => true,
        ),
    );

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('name', 'Name', 'required|max_length[255]');

		return $val;
	}
}
