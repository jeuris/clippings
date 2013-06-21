<?php

namespace Fuel\Migrations;

class Create_clippings
{
	public function up()
	{
		\DBUtil::create_table('clippings', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'pdf_url' => array('constraint' => 255, 'type' => 'varchar'),
			'customer_id' => array('constraint' => 11, 'type' => 'int'),
			'label_id' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('clippings');
	}
}