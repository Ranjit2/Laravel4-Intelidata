<?php

return array(

		// Activation
		'active' => false,

		// Unmonitored Urls
		'ban_url_array' => array(
                'ahir/velocity',
                'ahir/velocity/slowspeed',
                'ahir/velocity/memory_usage',
                'ahir/velocity/stats'
			),

		// Monitor filter for user login
		'monitor_filter' => 'Sentry'

	);