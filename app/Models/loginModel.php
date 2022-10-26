<?php 

namespace App\Models;

use CodeIgniter\Model;

class auth extends Model
{
	function __construct()
	{
		$this->db = \Config\Database::connect();
		$this->db2 = \Config\Database::connect("db1");
		$this->session= \Config\Services::session();
	}

	public function register()
	{
		// code...
	}
}
?>