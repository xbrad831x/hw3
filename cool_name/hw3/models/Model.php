<?php
namespace cool_name\hw3\models;
require_once("../configs/configs.php");

class Model {
/*namespace cool_name\hw3\models;*/
	
	private $con;

	public function db_connect() {
        $configs = new Configs();
        $this->con = mysqli_connect(
            $configs->host,
            $configs->username,
            $configs->password,
            $configs->db_name
        );
        mysqli_select_db($this->con, $configs->db_name);
	}

}
?>