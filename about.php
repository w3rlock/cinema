<?php include('header.php');
	$qry2=mysqli_query($con,"select * from tbl_movie where movie_id='".$_GET['id']."'");
	$movie=mysqli_fetch_array($qry2);
	?>
<div class="content">
	<div class="wrap">
		<div class="content-top">
				<div class="section group">
					<div class="about span_1_of_2">	
						<h3><?php echo $movie['movie_name']; ?></h3>	
							<div class="about-top">	
								<div class="grid images_3_of_2">
									<img src="<?php echo $movie['image']; ?>" alt=""/>
								</div>
								<div class="desc span_3_of_2">
									<p class="p-link" style="font-size:15px">Cast : <?php echo $movie['cast']; ?></p>
									<p class="p-link" style="font-size:15px">Relece Date : <?php echo date('d-M-Y',strtotime($movie['release_date'])); ?></p>
									<p style="font-size:15px"><?php echo $movie['descr']; ?></p>
									<a href="<?php echo $movie['video_url']; ?>" target="_blank" class="watch_but">Watch Trailer</a>
								</div>
								<div class="clear"></div>
							</div>
							<?php $s=mysqli_query($con,"select DISTINCT theatre_id from tbl_shows where movie_id='".$movie['movie_id']."'");
							if(mysqli_num_rows($s))
							{?>
							<table class="table table-hover table-bordered text-center">
							<?php
								
								while($shw=mysqli_fetch_array($s))
								{
									$t=mysqli_query($con,"select * from tbl_theatre where id='".$shw['theatre_id']."'");
									$theatre=mysqli_fetch_array($t);
									?>
									<tr>
										<td>
											<?php echo $theatre['name'].", ".$theatre['place'];?>
										</td>
										<td>
											<?php $tr=mysqli_query($con,"select * from tbl_shows where movie_id='".$movie['movie_id']."' and theatre_id='".$shw['theatre_id']."'");
											while($shh=mysqli_fetch_array($tr))
											{
												$ttm=mysqli_query($con,"select  * from tbl_show_time where st_id='".$shh['st_id']."'");
												$ttme=mysqli_fetch_array($ttm);
												
												?>
												
												<a href="check_login.php?show=<?php echo $shh['s_id'];?>&movie=<?php echo $shh['movie_id'];?>&theatre=<?php echo $shw['theatre_id'];?>"><button class="btn btn-default"><?php echo date('h:i A',strtotime($ttme['start_time']));?></button></a>
												<?php
											}
											?>
										</td>
									</tr>
									<?php
								}
							?>
						</table>
							<?php
							}
						
							else
							{
								?>
								<h3>No Show Available</h3>
								<?php
							}
							?>
						
					</div>			
				<?php include('movie_sidebar.php');?>
			</div>
				<div class="clear"></div>		
			</div>
	</div>
</div>


	<div class="dates">
		<?php $dateQue=mysqli_query($con, "select start_date from tbl_shows WHERE movie_id=".$_GET['id']." GROUP BY start_date");
		while($date=mysqli_fetch_array($dateQue))
		{
			echo '<a href="about.php?id='.$_GET['id'].'&city='.$_GET['city'].'&date='.$date['start_date'].'">'.$date['start_date'].'</a>';
			echo '<br>';
		}
		?>
	</div>

	<div class="cities">
				<form>
					<select onchange="document.location='about.php?id='+<?php echo $_GET['id'];?>+this.options[this.selectedIndex].value" name="city">
						<?php 
						$que=mysqli_query($con, "select * from tbl_theatre");

							while($m=mysqli_fetch_array($que))
							{
						?>
						<option value="&date=<?php echo $_GET['date']; ?>&city=<?php echo $m['place']; ?>"><?php echo $m['place']; ?></option>
						<?php
						}
						?>
					</select>
				</form>
				<br>
	</div>

<?php
	if(isset($_GET["city"])){
		$ticketQue=mysqli_query($con, "select name, address from tbl_theatre WHERE place='".$_GET["city"]."' AND id IN (SELECT theatre_id FROM tbl_shows WHERE `status` = 1 AND movie_id=".$_GET['id']." GROUP BY theatre_id)");
		$price=mysqli_fetch_array(mysqli_query($con, "select price from tbl_shows where movie_id=".$_GET['id']));
		$ticketTimeQue=mysqli_query($con, "select start_time FROM tbl_show_time WHERE st_id IN (SELECT st_id FROM tbl_shows WHERE `status`= 1 AND movie_id=".$_GET['id'].")");
		while($ticketName=mysqli_fetch_array($ticketQue)){
			echo $ticketName['name']."<br>".$ticketName['address'];
			echo '<br>'.$price['price'];
			// while($ticketTime=mysqli_fetch_array($ticketTimeQue)){
			// echo '<br>'.$ticketTime['start_time'];
			// }
		}
	}else{
		echo "No show available";
	}
?>

<?php include('footer.php');?>