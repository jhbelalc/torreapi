<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Torre API Test" />
    <meta name="author" content="John Harold Belalcazar Lozano" />
	<title>TORREAPI TEST</title>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">	
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>	
	<link rel="stylesheet" href="<?php echo base_url('/public/assets/css/search.css')?>"></script>

	<style type="text/css">

	</style>

</head>

<body>

<div class="anim">
	<h2>
		<span class="letter">S</span>
		<span class="letter">e</span>
		<span class="letter">a</span>
		<span class="letter">r</span>
		<span class="letter">c</span>
		<span class="letter">h</span>
		<span class="letter">i</span>
		<span class="letter">n</span>
		<span class="letter">g</span>
		<div class="anim"></div>
		<span class="letter">i</span>
		<span class="letter">n</span>
		<div class="anim"></div>
		<span class="letter">T</span>
		<span class="letter">O</span>
		<span class="letter">R</span>
		<span class="letter">R</span>
		<span class="letter">E</span>
	</h2>
	<br><br>
</div>


<!-- Modal -->
<div class="modal fade" id="ModalBIO" tabindex="-1" role="dialog" aria-labelledby="ModalBIOTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Hi! I'm John Belalcazar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  	<p>
		  The page is really simple, but thinking in minimalism, I tried to do something related. In fact the only page could be this one.
			Now in the process, I found some weird responses from the api and from the webpage, just an example: <a href="https://torre.co/home" target="_blank">https://torre.co/home</a> some pages redirect to that inexisting address.
			<br>
			Thank you and I will be waiting for my results.
			<br><br>
			Yours truly,
			<br><br><br>
			John.
		  </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div id="contaixner">

	<h1>Welcome to TorreAPI Search Utility</h1>

	<div id="body">
		<p>You can search Candidates by Name or Opportunities by Name, just select the proper option, write the text to search and click Search or hit Enter.</p>

		<form action="" method="POST">
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="flexsearch" id="name" value="name" <?php echo $this->input->post("flexsearch")=="opor" ? "" : "checked" ; ?>>
			<label class="form-check-label" for="name">
				Names 
			</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="flexsearch" id="oportunity" value="opor" <?php echo $this->input->post("flexsearch")=="opor" ? "checked" : "" ; ?>>
			<label class="form-check-label" for="oportunity">
				Opportunities
			</label>
		</div>		
		<br>
		<div class="form-group">
    	  	<input type="text" class="form-control" id="txtuser" name="txtuser" value="<?php echo $this->input->post('txtuser') ?>" placeholder="Text to search">
	    </div>

		<button type="submit" id="btgetuser" name="btgetuser" class="btn btn-primary btn-lg" title="Search" value="btgetuser" >Search</button>
		<a class="btn btn-primary btn-lg" href="<?= site_url("Welcome") ?>">Return</button></a>
		<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#ModalBIO">
			About..
		</button>		
		</form>

	</div>

</div>

<div class="centered">
	<section class="cards">
	<?php  
		if (isset($datosp["results"])) {
		foreach($datosp["results"] as $v){ 
			$lcUser="https://bio.torre.co/".$v["username"]; ?>
		<div class="card">
			<a href="<?php echo $lcUser; ?>" target='_blank'><img src=<?php echo $v["picture"]=='' ? base_url('public/assets/img/img_avatar.png') : $v["picture"] ;?> alt= <?php echo $v["name"];?> style="width:100%"></a>
			<div class="container">
				<h4><b><?php echo $v["name"]; ?></b></h4>
				<p>
					<?php echo $v["professionalHeadline"]; ?><br>
					<?php echo $v["locationName"]; ?><br>
					<?php echo "Weight ".$v["weight"]; ?><br>
					<?php echo $v["verified"]==1 ? "Verified ☑ (>‿◠)✌" : "Not Verified ✘ (ง︡'-'︠)ง" ; ?><br>
				</p>
			</div>
		</div>
	<?php } } ?>

	<?php  
		if (isset($datoso["results"])) {
		foreach($datoso["results"] as $v){
			//die(print_r($v));
			$cias=$v["organizations"];
			$comp=$v["compensation"];
			foreach($cias as $c){ ?>
				<div class="card">
					<img src=<?php echo $c["picture"]=='' ? base_url('public/assets/img/img_avatar.png') : $c["picture"] ;?> alt= <?php echo $c["name"];?> style="width:100%">
					<div class="container">
						<h4><b><?php echo $c["name"]; ?></b></h4>
						<p>
							<?php echo $v["remote"]==true ? "Remote ☑ " : "Not Remote ✘ "; ?><br>
							<?php echo $v["external"]==1 ? "External ☑ " : "Not External ✘ "; ?><br>

							<?php if(isset($comp)) {
								if ($comp["visible"]) {
									if (isset($comp["data"])){
										foreach($comp["data"] as $co) {
											echo $co."<br>";
										}
							   		} 
								} 
							}
							?>
						</p>
					</div>
				</div>
			
			<?php
			$users=$v["members"];
			foreach($users as $u){
				$lcUser="https://torre.co/jobs/".$v["id"]."-".str_replace(" ", "-", $v["objective"] ); ?>
				<div class="card">
					<a href="<?php echo $lcUser; ?>" target='_blank'><img src=<?php echo $u["picture"]=='' ? base_url('public/assets/img/img_avatar.png') : $u["picture"] ;?> alt= <?php echo $u["name"];?> style="width:100%"></a>
					<div class="container">
						<h4><b><?php echo $u["name"]; ?></b></h4>
						<p>
							<?php echo $u["professionalHeadline"]; ?><br>
							<?php echo $u["member"]==true ? "Member ☑ " : "Not Member ✘ " ; ?><br>
							<?php echo $u["manager"]==true ? "Manager ☑ " : "Not Manager ✘ " ; ?><br>
							<?php echo "Weight ".$u["weight"]; ?><br>
							<strong>
							<?php echo "Opportunity ".$v["objective"]; ?><br>
							<?php echo "Type ".$v["type"]; ?><br>
							</strong>
						</p>
					</div>
				</div>			
	<?php } } } }?>
	</section>
</div>
<div>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. </p>
</div>

<script src="<?php echo base_url('/node_modules/animejs/lib/anime.min.js')?>"></script>
<script>
	anime({
		targets: '.letter',
		opacity: 1,
		translateY: 50, 
		rotate: {
			value: 360,
			duration: 5000,
			easing: 'easeInExpo'
		}, 
		scale: anime.stagger([0.7, 1], {from: 'center'}), 
		delay: anime.stagger(300, {start: 1000}), 
		translateX: [-10, 30],
		loop: true
	});
</script>
</body>
</html>