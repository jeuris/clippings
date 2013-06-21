<?php
use Orm\Model;

class Model_Clipping extends Model
{
	protected static $_properties = array(
		'id',
		'name',
		'label_id',
		'description',
		'pdf_url',
		'customer_id',
		'thumb',
		'publicationdate',
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
		'Orm\Observer_Self' => array(
 			'events' => array('before_delete'),
 		),
 	);

	protected static $_belongs_to = array(
    'customer' => array(
        'key_from' => 'customer_id',
        'model_to' => 'Model_Customer',
        'key_to' => 'id',
        'cascade_save' => true,
        'cascade_delete' => false,
        ),
    'label' => array(
        'key_from' => 'label_id',
        'model_to' => 'Model_Label',
        'key_to' => 'id',
        'cascade_save' => true,
        'cascade_delete' => false,
        ),
    );

    public function _event_before_delete()
	{
		File::delete_dir(FILEPATH.'clippings/' .$this->id);

		$images = Model_Image::find()
							  ->where('clipping_id', '=', $this->id)
							  ->delete();

		$pdfs = Model_Pdf::find()
							  ->where('clipping_id', '=', $this->id)
							  ->delete();
	}

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('name', 'Name', 'required|max_length[255]');
		$val->add_field('label_id', 'Label Id', 'required|valid_string[numeric]');
		$val->add_field('description', 'Description', 'required|max_length[2550]');
		$val->add_field('customer_id', 'Customer Id', 'required|valid_string[numeric]');
		$val->add_field('publicationdate', 'Publicationdate', 'required|max_length[11]');


		return $val;
	}

}
