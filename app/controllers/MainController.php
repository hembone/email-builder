<?php

class MainController extends BaseController {

	protected $layout = 'layouts.master';

    public function getIndex()
    {
    	View::share('title', 'Email Builder');
        $this->layout->content = View::make('main');
    }

}
