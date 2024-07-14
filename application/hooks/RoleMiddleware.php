<?php
// application/hooks/RoleMiddleware.php

class RoleMiddleware
{
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->helper('url');
    }

    public function redirectBasedOnRole()
    {
        // Check user role here
        $role = $this->getLoggedInUserRole();

        // Perform dynamic routing based on user role
        switch ($role) {
            case '1':
                $this->modifyURLPrefix('admin');
                break;
            case '3':
                $this->modifyURLPrefix('agent');
                break;
            default:
                $this->modifyURLPrefix('user');
                break;
        }
    }

    protected function getLoggedInUserRole()
    {
        // Logic to retrieve user role from session or database
        // For demonstration purposes, assuming it's retrieved from session
        return $this->CI->session->userdata('role');
    }

    protected function modifyURLPrefix($prefix)
    {
        $uri = & load_class('URI', 'core');
        $uri->set_uri_string($prefix . '/' . $uri->uri_string());
    }
}
