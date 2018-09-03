<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * For demo only
 */
class Errors extends MY_Controller {
    
    public function index()
    {
        $this->render('errors/custom/error_404');
    }

}
?>