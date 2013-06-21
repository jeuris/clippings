<?php

namespace Fuel\Migrations;

class Create_customers_labels
{
	public function up()
	{
		\DBUtil::create_table('customers_labels', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'customer_id' => array('constraint' => 11, 'type' => 'int'),
			'label_id' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('customers_labels');
	}
}