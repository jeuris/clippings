<?php
return array(

	'clipping'			=> 'clipping/index',
	'login'			=> 'admin/login',
	'customer'			=> 'customer/index',
	'customer/(:num)'			=> 'customer/edit/$1',

	'_root_'  	=> 'customer/index',  // The default route
	'_404_'   	=> 'welcome/404',    // The main 404 route
);

