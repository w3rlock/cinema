<?php include('header.php');?>

<?

echo `<h3>`.$_GET['name'].`</h3>`;

//выводит даты
if(isset($_GET["id"])){
    $theatre_id=$_GET["id"];
    $que=mysqli_query($con, "select * from tbl_shows WHERE theatre_id=" . $theatre_id ." AND `status` = 1");
    while($m=mysqli_fetch_array($que)){
        echo '<br>';
        echo '<a href="th_desc.php?name='.$_GET['name'].'&id='.$_GET['id'].'&start_date='.$m['start_date'].'">'.$m['start_date'].'</a>';
    }
    if(!isset($_GET["start_date"])){
        $que=mysqli_query($con, "select * from tbl_shows WHERE theatre_id=" . $theatre_id ." AND `status` = 1");
        $start_date = mysqli_fetch_array($que);
        $start_date = $start_date["start_date"];
    }else{
        $start_date = $_GET["start_date"];
    }
}

$que=mysqli_query($con, "select * from tbl_shows WHERE theatre_id=" . $theatre_id ." AND `status` = 1 AND start_date='".$start_date."'");
while($m=mysqli_fetch_array($que)){
    echo '<br>';
    $movie_id = $m['movie_id'];
        $que2=mysqli_query($con, "select * from tbl_movie WHERE movie_id=" . $movie_id );
        $movie = mysqli_fetch_array($que2);
        $movie_name = $movie["movie_name"];
        $movie_image = $movie['image'];
        echo $movie_name.'<br>';
        echo $movie_image.'<br>';
        $que3=mysqli_query($con, "select st_id from tbl_shows WHERE theatre_id=" . $theatre_id ." AND `status` = 1 AND movie_id=".$movie_id." AND start_date='".$start_date."'");
        while($st_ids=mysqli_fetch_array($que3)){
            echo '<br>';
            $st_id=$st_ids['st_id'];
            $que4=mysqli_fetch_array(mysqli_query($con, "select start_time from tbl_show_time WHERE st_id=" . $st_id));
            print_r($que4['start_time']);


        }
}


?>
<?php include('footer.php');?>
