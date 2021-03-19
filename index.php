<html>
<body>
<?php
include('header.php');
?>

<div class="content">
	<div class="wrap">
		<h3 class="heading3">Прямо сейчас</h3>
		<div class="flexslider carousel">
			<ul class="slides">
				<?php
					$today=date("Y-m-d");
					$qry2=mysqli_query($con,"select * from  tbl_movie where status='0' order by rand() limit 3");
								
					while($m=mysqli_fetch_array($qry2))
						{
				?>
					<li>
						<div class="movie">
							<a href="about.php?id=<?php echo $m['movie_id'];?>">
							<img src="<?php echo $m['image'];?>" alt=""></a>
								<div class="stats">
									<img src="imagesnew/people.svg" width="30px" height="30px" alt="">
									<p><?php echo $m['people'];?></p>
									<img src="imagesnew/popcorn.svg" width="30px" height="30px" alt="">
									<p><?php echo $m['popcorn'];?></p>
								</div>
								<p><?php echo $m['movie_name'];?></p>
						</div>
					</li>
				<?php
				}
				?>
			</ul>
		</div>

		<h3 class="heading3">На этой неделе</h3>
		<div class="flexslider carousel">
			<ul class="slides">
				<?php
					$today=date("Y-m-d");
					$qry2=mysqli_query($con,"select * from  tbl_movie where status='1' order by rand() limit 3");
								
					while($m=mysqli_fetch_array($qry2))
						{
				?>
					<li>
						<div class="movie">
						<a href="about.php?id=<?php echo $m['movie_id'];?>">
							<img src="<?php echo $m['image'];?>" alt=""></a>
								<div class="stats">
									<img src="imagesnew/people.svg" width="30px" height="30px" alt="">
									<p><?php echo $m['people'];?></p>
									<img src="imagesnew/popcorn.svg" width="30px" height="30px" alt="">
									<p><?php echo $m['popcorn'];?></p>
								</div>
								<p><?php echo $m['movie_name'];?></p>
						</div>
					</li>
				<?php
				}
				?>
			</ul>
		</div>

		<h3 class="heading3">Скоро</h3>
		<div class="flexslider carousel">
			<ul class="slides">
					<?php
						$today=date("Y-m-d");
						$qry2=mysqli_query($con,"select * from  tbl_movie where status='3' order by rand() limit 3");
									
						while($m=mysqli_fetch_array($qry2))
							{
					?>
						<li>
							<div class="movie">
							<a href="about.php?id=<?php echo $m['movie_id'];?>">
								<img src="<?php echo $m['image'];?>" alt=""></a>
									<div class="stats">
										<img src="imagesnew/people.svg" width="30px" height="30px" alt="">
										<p><?php echo $m['people'];?></p>
										<img src="imagesnew/popcorn.svg" width="30px" height="30px" alt="">
										<p><?php echo $m['popcorn'];?></p>
									</div>
									<p><?php echo $m['movie_name'];?></p>
							</div>
						</li>
					<?php
					}
					?>
				</ul>
		</div>
		<script>
			$('.flexslider').flexslider({
				animation: "slide",
				animationLoop: false,
				itemWidth: 200,
				itemMargin: 5,
				minItems: 2,
				maxItems: 6
			});
		</script>
	</div>
	<?php include('footer.php');?>
</div>
<?php include('searchbar.php');?>