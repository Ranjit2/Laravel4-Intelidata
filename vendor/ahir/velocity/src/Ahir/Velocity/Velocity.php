<?php namespace Ahir\Velocity;

use Session;
use Input;
use Request;
use Config;
use View;

class Velocity {

    /**
     * Start
     *
     * @return null
     */
    public function start()
    {
        if (!Config::get('velocity::active')) return false;
        Session::flash('ahir.velocity.start', $this->getTime());
    }

    public function handle($data)
    {
        if (!Config::get('velocity::active')) return false;
        Session::flash(
                'ahir.velocity.data', 
                (object) array(
                    'url' => Request::path(),
                    'method' => Request::method(),
                    'controller' => get_class($data),
                    'post_data' => json_encode(Input::all()),

                )
            );
    }


    /**
     * Bench
     *
     * @return null
     */
    public function stop()
    {
        if (!Config::get('velocity::active')) return false;
        $this->data = Session::get('ahir.velocity.data');
        $this->data->response_time = number_format($this->getTime() - Session::get('ahir.velocity.start'), 4);
        $this->data->memory_usage = memory_get_usage();
        $this->insertToModel();
    }

    /**
     * Size To Str
     *
     * @param  integer 
     * @return string
     */
    public function sizeToStr($bytes)
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 0) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 0) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 0) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' Byte';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' Byte';
        } else {
            $bytes = '0 Byte';
        }
        return $bytes;
    }

    /**
     * Insert To Model
     *
     * @return null
     */
    private function insertToModel()
    {
        $model = new VelocityModel;
        foreach ($this->data as $key => $value) {
            $model->{$key} = $value;
        }
        if (in_array($model->url, Config::get('velocity::ban_url_array'))) return;
        $model->save();
    }

    /** 
     * Get Time 
     *
     * @return  float
     */
    private function getTime()
    {
        $mtime = explode(" ", microtime()); 
        return $mtime[1] + $mtime[0];
    }

}