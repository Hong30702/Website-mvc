<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/database.php");
include_once ($filepath."/../helpers/format.php");
?>

<?php
/**
 * 
 */
class user
{
	private $db;
	private $fm;

	public function __construct()
	{
		$this -> db = new database();
		$this -> fm = new format();
	}
     }
	?>