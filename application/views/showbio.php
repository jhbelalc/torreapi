<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>TORREAPI TEST</title>
	
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">	
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>	
	

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>


<?php
    if($_SERVER['REQUEST_METHOD'] == "POST" )
    {
        func();
    }
    function func()
    {
		// do stuff   
		$lcUser = $_POST["txtuser"];
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://bio.torre.co/api/bios/".$lcUser,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache"
		  ),
		));
		
		$response = curl_exec($curl);
		$err = curl_error($curl);
		
		curl_close($curl);
		//echo var_dump($response);
		//echo $response;

		//preg_match_all('/"(.*?)"/', $response, $answers);

		$lcUser="'https://bio.torre.co/".$lcUser."'";

		$objUsr= json_decode($response, true);
		$profHL=$objUsr["person"];
		$locaTI=$profHL["location"];
		$Links= $profHL["links"];

		if (isset($profHL["picture"])){
			echo "<a href=".$lcUser." target='_blank'><img src=".$profHL["picture"]." width='200px'></img></a> <a href=".$lcUser." target='_blank'></a><br>";
		}
		if (isset($profHL["name"])){
			echo "Name: <a href=".$lcUser." target='_blank'>".$profHL["name"]."</a><br>";
		}
		if (isset($profHL["professionalHeadline"])){
			echo "Professional Title: ".$profHL["professionalHeadline"]."<br>";
		}
		if (isset($profHL["name"])){
			echo "City: ".$locaTI["name"]."<br>";	
		}
		if (isset($profHL["country"])){
			echo "Country: ".$locaTI["country"]."<br>";	
		}
		foreach	($Links as $redes){
			echo ucfirst(empty($redes["name"]) ? $redes["address"] : $redes["name"]).":"."<a href=".$redes["address"]." target='_blank'> ".$redes["address"]."</a><br>";
		}
		if (isset($profHL["summaryOfBio"])){
			echo "Summary of Bio:<br>";
			echo "<p>".$profHL["summaryOfBio"]."</p><br>";
		}
    }
?>

<body>

<div id="container">
	<h1>Welcome to TorreAPI Query Users!</h1>

	<div id="body">
		<p>Please provide the exact username to display bio-info.</p>

		<form action="" method="POST">
		<div class="form-group">
      		<label for="txtuser">Name:</label>
    	  	<input type="text" class="form-control" id="txtuser" name="txtuser" value="johnharold" placeholder="Write Username">
	    </div>

		<button type="submit" id="btgetbio" class="btn btn-primary btn-lg" title="Get Bio" value="btgetbio">Get Bio</button>
		<a class="btn btn-primary btn-lg" href="<?= site_url("Welcome") ?>">Return</button></a>
		
		</form>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. </p>
</div>

</body>
</html>