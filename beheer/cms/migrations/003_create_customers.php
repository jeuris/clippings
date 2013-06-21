<?php

namespace Fuel\Migrations;

class Create_customers
{
	public function up()
	{
		\DBUtil::create_table('customers', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'company_name' => array('constraint' => 255, 'type' => 'varchar'),
			'first_name' => array('constraint' => 255, 'type' => 'varchar'),
			'last_name' => array('constraint' => 255, 'type' => 'varchar'),
			'email' => array('constraint' => 255, 'type' => 'varchar'),
			'phone' => array('constraint' => 255, 'type' => 'varchar'),
			'street' => array('constraint' => 255, 'type' => 'varchar'),
			'street_number' => array('constraint' => 255, 'type' => 'varchar'),
			'zip' => array('constraint' => 255, 'type' => 'varchar'),
			'city' => array('constraint' => 255, 'type' => 'varchar'),
			'country' => array('constraint' => 255, 'type' => 'varchar'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('customers');
	}
}