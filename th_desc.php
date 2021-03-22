<?php include('header.php');?>

<?php
echo '<div class="wrap">';
echo '<div class="content-top">';
    echo '<h3>'.$_GET['name'].'</h3>';
    $address=mysqli_fetch_array(mysqli_query($con, "select * from tbl_theatre WHERE id=" .$_GET['id']));
    echo '<p class="address">'.$address['address'].'</p>';

//выводит даты
if(isset($_GET["id"])){
    $theatre_id=$_GET["id"];
    mysqli_query($con, "SET lc_time_names = 'ru_RU'");
    $reqDate=mysqli_query($con, "select start_date from tbl_shows WHERE theatre_id=" . $theatre_id ." AND `status` = 1 GROUP BY start_date");
    $que=mysqli_query($con, "select DATE_FORMAT(start_date, '%W %M %d') as 'start_date' from tbl_shows WHERE theatre_id=" . $theatre_id ." AND `status` = 1 GROUP BY start_date");
    echo '<div class="dates">';
    while($m=mysqli_fetch_array($que))
		{
            $start=mysqli_fetch_array($reqDate);
			list($week, $month, $day) = explode(" ", $m['start_date']);
			echo '<div class="date">';
			echo '<a href="th_desc.php?name='.$_GET['name'].'&id='.$_GET['id'].'&start_date='.$start['start_date'].'">'.$week.'<p class="day">'.$day.'</p>'.$month.'</a>';
			echo '</div>';
		}
    if(!isset($_GET["start_date"])){
        $que=mysqli_query($con, "select * from tbl_shows WHERE theatre_id=" . $theatre_id ." AND `status` = 1");
        $start_date = mysqli_fetch_array($que);
        $start_date = $start_date["start_date"];
    }else{
        $start_date = $_GET["start_date"];
    }
    echo '</div>';
}

$que=mysqli_query($con, "select * from tbl_shows WHERE theatre_id=" . $theatre_id ." AND `status` = 1 AND start_date='".$start_date."' group by movie_id");
while($m=mysqli_fetch_array($que)){
    $movie_id = $m['movie_id'];
        $que2=mysqli_query($con, "select * from tbl_movie WHERE movie_id=" . $movie_id);
        $movie = mysqli_fetch_array($que2);
        $movie_name = $movie["movie_name"];
        $movie_image = $movie['image'];
        
        

        echo '<div class="seans">';
        echo '<h2>'.$movie_name.'</h2>';
        echo '<img src="'.$movie_image.'">';
        echo '<h2 style="display:inline-block; margin:30px;">Сеансы</h2>';
        $que3=mysqli_query($con, "select st_id from tbl_shows WHERE theatre_id=" . $theatre_id ." AND `status` = 1 AND movie_id=".$movie_id." AND start_date='".$start_date."'");
        while($st_ids=mysqli_fetch_array($que3)){
            $st_id=$st_ids['st_id'];
            $que4=mysqli_fetch_array(mysqli_query($con, "select start_time from tbl_show_time WHERE st_id=" . $st_id));
            //print_r($que4['start_time']);
            echo '<div class="time">';
			echo '<a href="">'.date("H:i",strtotime($que4['start_time'])).'</a>';
			echo '</div>';


        }
        echo '</div>';
}
echo '</div>';
echo '</div>';
?>
<?php include('footer.php');?>
