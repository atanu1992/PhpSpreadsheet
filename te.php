<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include 'db.php';

// $oldTECountrySql = "SELECT * FROM `country` WHERE country_id IN ()";

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use \PhpOffice\PhpSpreadsheet\Style\Font;
 
// $inputFileName = $_SERVER["DOCUMENT_ROOT"].'/phpspreadsheet/nwe.xlsx';
$inputFileName = $_SERVER["DOCUMENT_ROOT"].'/phpspreadsheet/te_com_userlist.xlsx';
$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
/** Load input file to a Spreadsheet Object  **/
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
$schdeules   = $spreadsheet->getActiveSheet()->toArray();
// echo "<pre>"; print_r(array_column($schdeules, 5));
// die;
// $emailArr = ['robert.reier@goodlandgrupp.ee','info@hellaswood.gr','iaint@donaldson-timber.co.uk',
// 'charleswooduk@yahoo.com','afidnes@hellaswood.gr','info@sakkalis.gr', 'michael.schrenk@binderholz.de','josef.mayer@binderholz.de','charl@lprolle.com','elena@interscala.com','vnvint@gmail.com','import@sino-timber.com','manekeller@gratenau.de',
// 	'carriewong@greenheartgroup.com','info@hightechtimber.nl', 'kaji@hokuyowood.com'];

$emailArr = ['robert.reier@goodlandgrupp.ee','info@hellaswood.gr','iaint@donaldson-timber.co.uk','charleswooduk@yahoo.com','afidnes@hellaswood.gr','info@sakkalis.gr','michael.schrenk@binderholz.de','josef.mayer@binderholz.de','charl@lprolle.com','elena@interscala.com','vnvint@gmail.com','import@sino-timber.com','manekeller@gratenau.de','carriewong@greenheartgroup.com','info@hightechtimber.nl','kaji@hokuyowood.com'];
$countryIds  = '';

?>

			<?php 

			$oldTEUsers = [];
			$cc = [];
			for($i = 1; $i<count($schdeules); $i++) { 
				if (!empty($schdeules[$i][5]) && !in_array($schdeules[$i][5], $emailArr)) {
					$email = !empty($schdeules[$i][5])?strtolower($schdeules[$i][5]):'';
					$servername = "localhost";
					$username 	= "root";
					$password 	= "";
					$dbname 	= "newtimberdb";

					// Create connection
					$conn = mysqli_connect($servername, $username, $password, $dbname);
					// Check connection
					if (!$conn) {
					  die("Connection failed: " . mysqli_connect_error());
					}

					$sql = "INSERT INTO `tbl_old_te_non_vip_users_list`(`email`) VALUES ('".$email."')";

					if (mysqli_query($conn, $sql)) {
					  echo " New record created successfully "."<br>";
					} else {
					  echo " Error: " . $sql . "<br>" . mysqli_error($conn);
					}

					mysqli_close($conn);
					array_push($emailArr, $schdeules[$i][5]);

				?>
			<?php }
			 ?>
				
			<?php } ?>