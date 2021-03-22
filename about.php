<?php include('header.php');
	$qry2=mysqli_query($con,"select * from tbl_movie where movie_id='".$_GET['id']."'");
	$movie=mysqli_fetch_array($qry2);
	?>
<div class="content">
	<div class="section group">
		<img src="imagesnew/SoulBannerBig.jpg" width="100%" height="500px" style="object-fit:cover">
	</div>





	<div class="wrap">
		<div class="content-top">
				<div class="section group">
					<div class="about span_1_of_2">	
						<h3><?php echo $movie['movie_name']; ?></h3>	
							<div class="about-top">	
								
								<div class="desc span_3_of_2">
									
									<p class="p-link" style="font-size:15px"><?php echo date('d-m-Y',strtotime($movie['release_date'])).' | '.$movie['during']; ?></p>
									<p style="font-size:15px"><?php echo $movie['descr']; ?></p>
									<p class="p-link" style="font-size:15px">Cast : <?php echo $movie['cast']; ?></p>
									<!-- <a href="<?php echo $movie['video_url']; ?>" target="_blank" class="watch_but">Watch Trailer</a> -->
								</div>
								<div class="clear"></div>
							</div>
												
							<div class="dates">
								<?php 
									$reqDate=mysqli_fetch_array(mysqli_query($con, "select start_date from tbl_shows WHERE movie_id=".$_GET['id']." GROUP BY start_date"));
									mysqli_query($con, "SET lc_time_names = 'ru_RU'"); $dateQue=mysqli_query($con, "select DATE_FORMAT(start_date, '%W %M %d') as 'start_date' from tbl_shows WHERE movie_id=".$_GET['id']." GROUP BY start_date");
									while($date=mysqli_fetch_array($dateQue))
									{
										list($week, $month, $day) = explode(" ", $date['start_date']);
										echo '<div class="date">';
										echo '<a href="about.php?id='.$_GET['id'].'&city='.$_GET['city'].'&date='.$reqDate['start_date'].'">'.$week.'<p class="day">'.$day.'</p>'.$month.'</a>';
										echo '</div>';
									}
								?>
							</div>

						<div class="cities">
							<br>
							<p style="display:inline-block">Город</p>
							<form>
								<select onchange="document.location='about.php?id='+<?php echo $_GET['id'];?>+this.options[this.selectedIndex].value" name="city">
									<?php 
									$que=mysqli_query($con, "select * from tbl_theatre GROUP BY place");

										while($m=mysqli_fetch_array($que))
										{
									?>
									<option value="&date=<?php echo $_GET['date']; ?>&city=<?php echo $m['place']; ?>"><?php echo $m['place']; ?></option>
									<?php
									}
									?>
								</select>
							</form>
						</div>

						<?php
							if(isset($_GET["city"]) and isset($_GET["date"]) ){
								$ticketQue=mysqli_query($con, "select id, name, address from tbl_theatre WHERE place='".$_GET['city']."' AND id IN (SELECT theatre_id FROM tbl_shows WHERE `status` = 1 AND movie_id=".$_GET['id']." GROUP BY theatre_id)");
								while($ticketName=mysqli_fetch_array($ticketQue)){
									echo '<div class="ticket">';
									echo '<p class="ticketName">'.$ticketName['name'].'</p>'.'<p class="ticketAddress">'.$ticketName['address'].'</p>';
									$priceQue=mysqli_query($con, "SELECT price FROM tbl_shows WHERE theatre_id='".$ticketName['id']."' AND start_date = '".$_GET['date']."' AND `status`= 1 AND movie_id=".$_GET['id']);
									$ticketTimeQue=mysqli_query($con, "select start_time FROM tbl_show_time WHERE st_id IN (SELECT st_id FROM tbl_shows WHERE theatre_id='".$ticketName['id']."' AND start_date = '".$_GET['date']."' AND `status`= 1 AND movie_id=".$_GET['id'].")");
									while($ticketTime=mysqli_fetch_array($ticketTimeQue)){
									echo '<div class="time">';
									echo '<a href=#>'.date("H:i",strtotime($ticketTime['start_time'])).'</a>';
									
									echo '</div>';
									}
									echo '<br>';
									while($price=mysqli_fetch_array($priceQue)){
										echo '<div class="price">';
										echo '<p>'.$price['price'].'тг'.'</p>';
										echo '</div>';
										}
									echo '</div>';
								}
							}else{
								echo "No show available";
							}
						?>
					</div>
					<?php 
						$statsfilms=mysqli_fetch_array(mysqli_query($con, "select people, popcorn, video_url from tbl_movie where movie_id=".$_GET['id']));
						echo '<div class="listview_1_of_3 popcorn">
							<img src="imagesnew/popcorn.svg" width="49px" height="49px">
							<p>'.$statsfilms['popcorn'].'</p>
							<img src="imagesnew/people.svg" width="49px" height="49px">
							<p>'.$statsfilms['people'].'</p>
							<br>
							<br>
							<a href='.$statsfilms['video_url'].'>Трейлер</a>
							</div>';
					?>
				<?php include('movie_sidebar.php');?>
			</div>
				<div class="clear"></div>		
			</div>
	</div>
</div>


	

<?php include('footer.php');?>