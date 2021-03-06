<?php
//define('ZF2_PATH', getenv('HOME') . '/vendor/zendframework/zendframework/library');

return array(
	
    // This should be an array of module namespaces used in the application.
    'modules' => array(        
    	'DoctrineModule',
    	'DoctrineORMModule',
    	'Application'
    ),
	'module_listener_options' => array(		
		// An array of paths from which to glob configuration files after
		// modules are loaded. These effectively overide configuration
		// provided by modules themselves. Paths may use GLOB_BRACE notation.
		'config_glob_paths' => array(
				'../../../config/autoload/{,*.}{global,local}.php',
		),
        // This should be an array of paths in which modules reside.
        // If a string key is provided, the listener will consider that a module
        // namespace, the value of that key the specific path to that module's
        // Module class.
        'module_paths' => array(
            'module',
            'vendor',
        )
    ),
);