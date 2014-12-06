<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		# code...
		parent::__construct();
        // Set the title
        $this->template->title = 'Welcome!';
        
        // Dynamically add a css stylesheet
        $this->template->stylesheet->add('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css');
	}
	public function index()
	{        
        // Load a view in the content partial
        //$this->template->content->view('hero', array('title' => 'Hello, world!'));

        $news = array(); // load from model (but using a dummy array here)
        $this->template->content->view('news', $news);
        
        // Set a partial's content
        $this->template->footer = 'Made with Twitter Bootstrap';
        
        // Publish the template        
        $this->template->publish();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */