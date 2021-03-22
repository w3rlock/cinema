<?php include('header.php');?>
</div>
<div class="content">
	<div class="wrap">
		

		<div class="content-top">
			<p style="display:inline-block">Город</p>
			<img src="imagesnew/gps.svg" alt="">
			<div class="cities">
				<form>
				<select onchange="this.form.submit()" name="city">
					<?php 
					$que=mysqli_query($con, "select * from tbl_theatre");

						while($m=mysqli_fetch_array($que))
						{
					?>
					<option value="<?php echo $m['place']; ?>"><?php echo $m['place']; ?></option>
					<?php
					}
					?>
				</select>
				</form>
			</div>
					<?php
					if(isset($_GET["city"])){
						$cit=$_GET["city"];
						$que=mysqli_query($con, "select * from tbl_theatre WHERE '" . $cit . "' =tbl_theatre.place");
						while($m=mysqli_fetch_array($que))
						{
						echo '
						<div class="theatre">
						<a href="th_desc.php?name='.$m['name'].'&id='.$m['id'].'">'.$m['name'].'</a>
						<p class="address">Address</p>
						</div>';
					}}
					?>
		</div>

		
				<div class="clear"></div>		
			</div>
			<?php include('footer.php');?>