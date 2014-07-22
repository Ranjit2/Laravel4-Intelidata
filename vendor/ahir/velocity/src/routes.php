<?php 

# Stats
Route::get('ahir/velocity', 
		array(
			'before' => Config::get('velocity::monitor_filter'), 
			'uses' => 'VelocityStatsController@getLive'
		)
	);

Route::get('ahir/velocity/slowspeed', 
		array(
			'before' => Config::get('velocity::monitor_filter'), 
			'uses' => 'VelocityStatsController@getSlowspeed'
		)
	);

Route::get('ahir/velocity/memory_usage', 
		array(
			'before' => Config::get('velocity::monitor_filter'), 
			'uses' => 'VelocityStatsController@getMemoryUsage'
		)
	);

Route::get('ahir/velocity/stats', 
		array(
			'before' => Config::get('velocity::monitor_filter'), 
			'uses' => 'VelocityStatsController@getStats'
		)
	);


