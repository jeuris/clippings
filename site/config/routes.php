<?php
return array(

	'detail/(:num)'            => 'detail/index/$1',
	'overview/(:num)'          => 'overview/index/$1',
	'overview'                 => 'overview/index',
	'login'                    => 'login/login',

	'_root_'                   => 'overview/index',  // The default route
	'_404_'                    => 'welcome/404',    // The main 404 route
	
);