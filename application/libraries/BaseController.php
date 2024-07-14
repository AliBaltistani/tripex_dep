<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class : BaseController
 * Base Class to control over all the classes
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class BaseController extends CI_Controller
{
	
	protected $role = '';
	protected $roleStatus = 1;
	protected $vendorId = '';
	protected $name = '';
	protected $roleText = '';
	protected $isAdmin = 0;
	protected $accessInfo = [];
	protected $global = array();
	protected $lastLogin = '';
	protected $module = '';


	/**
	 * This is default constructor
	 */
	public function __construct()
	{

		parent::__construct();

		$this->load->model('Category_model', 'cm');
		$this->load->model('Login_model', 'lm');
		$this->load->model('Notification_model');
		$this->load->model('Prices_model');
	}

	/**
	 * This function used to check the user is logged in or not
	 */
	function isLoggedIn()
	{
		$isLoggedIn = $this->session->userdata('isLoggedIn');

		if (!isset($isLoggedIn) || $isLoggedIn != TRUE) {
			redirect('login');
		} else {

			$this->role = $this->session->userdata('role');
			$this->roleStatus = $this->session->userdata('roleStatus');
			$this->vendorId = $this->session->userdata('userId');
			$this->name = $this->session->userdata('name');
			$this->roleText = $this->session->userdata('roleText');
			$this->lastLogin = $this->session->userdata('lastLogin');
			$this->isAdmin = $this->session->userdata('isAdmin');
			$this->accessInfo = getAllRoleAccess($this->role);

			$this->global['name'] = $this->name;
			$this->global['role'] = $this->role;
			$this->global['role_text'] = $this->roleText;
			$this->global['last_login'] = $this->lastLogin;
			$this->global['is_admin'] = $this->isAdmin;
			$this->global['access_info'] = $this->accessInfo;
			$this->global['services_info'] = $this->cm->getAll();

			$notificats  =  new Notification_model();
			$notify  = array();
			if ($this->isAdmin()) {
				$notify = $notificats->getWhere(['read_status' => 0, 'user_id' => SYSTEM_ADMIN ?? 0]);
			} else {
				$notify = $notificats->getWhere(['read_status' => 0, 'user_id' => $_SESSION['userId'] ?? 0]);
			}


			$price_model = new Prices_model();
			$my_price = array();
			if (!$this->isAdmin()) {
				$my_price = $price_model->getWhere(['role_id' => $this->role])[0] ?? array();
			}

			$this->global['vendor_price'] = $my_price;

			$this->global['notifications'] = $notify;
		}
	}

	function preAndDie($array)
	{
		echo "<pre>";
		print_r($array);
		echo "</pre>";
		die;
	}

	/**
	 * This function is used to check the access
	 */
	function isAdmin()
	{
		if ($this->isAdmin == SYSTEM_ADMIN && $this->role == 1 ) {
			return true;
		} else {
			return false;
		}
	}

	function check_permission($moduleName, $permission)
	{
		if ($this->isAdmin() && $this->roleStatus != 2) {
			return true;
		}else{

			 $res =  user_can($this->role,$moduleName) ?? false;
			if(!empty($res)){
				if(array_key_exists($permission, $res)){
					if( $res[$permission] == 1){
						return true;
					}
				}
			}
			return false;

		}
		
	}


	/**
	 * This function is used to check the user having list access or not
	 */
	protected function hasListAccess()
	{
		
		if (
			$this->isAdmin() ||
			(array_key_exists($this->module, $this->accessInfo)
				&& ($this->accessInfo[$this->module]['list'] == 1
					|| $this->accessInfo[$this->module]['total_access'] == 1))
		) {
			
			return true;
		}
		return false;
	}

	/**
	 * This function is used to check the user having create access or not
	 */
	protected function hasCreateAccess()
	{

		if (
			$this->isAdmin() ||
			(array_key_exists($this->module, $this->accessInfo)
				&& ($this->accessInfo[$this->module]['create_records'] == 1
					|| $this->accessInfo[$this->module]['total_access'] == 1))
		) {
			return true;
		}
		return false;
	}

	/**
	 * This function is used to check the user having update access or not
	 */
	protected function hasUpdateAccess()
	{
		if (
			$this->isAdmin() ||
			(array_key_exists($this->module, $this->accessInfo)
				&& ($this->accessInfo[$this->module]['edit_records'] == 1
					|| $this->accessInfo[$this->module]['total_access'] == 1))
		) {
			return true;
		}
		return false;
	}

	/**
	 * This function is used to check the user having delete access or not
	 */
	protected function hasDeleteAccess()
	{
		if (
			$this->isAdmin() ||
			(array_key_exists($this->module, $this->accessInfo)
				&& ($this->accessInfo[$this->module]['delete_records'] == 1
					|| $this->accessInfo[$this->module]['total_access'] == 1))
		) {
			return true;
		}
		return false;
	}

	/**
	 * This function is used to load the set of views
	 */
	function loadThis()
	{
		$this->global['pageTitle'] = 'Tours & Travel : Access Denied';

		$this->load->view('includes/header', $this->global);
		$this->load->view('general/access');
		$this->load->view('includes/footer');
	}

	/**
	 * This function is used to logged out user from system
	 */
	function logout()
	{
		$this->session->sess_destroy();
		$url = $_SERVER['HTTP_REFERER'] ?? base_url();
		redirect($url);
	}

	/**
	 * This function used to load views
	 * @param {string} $viewName : This is view name
	 * @param {mixed} $headerInfo : This is array of header information
	 * @param {mixed} $pageInfo : This is array of page information
	 * @param {mixed} $footerInfo : This is array of footer information
	 * @return {null} $result : null
	 */
	function loadViews($viewName = "", $headerInfo = NULL, $pageInfo = NULL, $footerInfo = NULL)
	{
		// pre($this->global); die;
		$this->load->view('includes/header', $headerInfo);
		$this->load->view($viewName, $pageInfo);
		$this->load->view('includes/footer', $footerInfo);
	}

	/**
	 * This function used provide the pagination resources
	 * @param {string} $link : This is page link
	 * @param {number} $count : This is page count
	 * @param {number} $perPage : This is records per page limit
	 * @return {mixed} $result : This is array of records and pagination data
	 */
	function paginationCompress($link, $count, $perPage = 10, $segment = SEGMENT)
	{

		$this->load->library('pagination');

		$config['base_url'] = base_url() . $link;
		$config['total_rows'] = $count;
		$config['uri_segment'] = $segment;
		$config['per_page'] = $perPage;
		$config['num_links'] = 5;
		$config['full_tag_open'] = '<nav><ul class="pagination">';
		$config['full_tag_close'] = '</ul></nav>';
		$config['first_tag_open'] = '<li class="arrow">';
		$config['first_link'] = 'First';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = 'Previous';
		$config['prev_tag_open'] = '<li class="arrow">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li class="arrow">';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="arrow">';
		$config['last_link'] = 'Last';
		$config['last_tag_close'] = '</li>';

		$this->pagination->initialize($config);
		$page = $config['per_page'];
		$segment = $this->uri->segment($segment);

		return array(
			"page" => $page,
			"segment" => $segment
		);
	}
}
