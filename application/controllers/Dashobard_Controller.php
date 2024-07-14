<?php
// application/controllers/Dashboard_controller.php

class Dashboard_Controller extends CI_Controller {
    public function index() {
        // Common logic for all users
    }

    // Additional methods for specific user roles
    public function admin_dashboard() {
        // Logic for admin dashboard
        echo "admin";
    }

    public function agent_dashboard() {
        // Logic for agent dashboard
        echo "agent";
      }

    public function user_dashboard() {
        // Logic for user dashboard
        echo "user";
    }
}
?>
