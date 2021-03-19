<?php include('header.php');?>

<?

echo `<h3>`.$_GET['name'].`</h3>`;


if(isset($_GET["id"])){
    $cit=$_GET["id"];
    $que=mysqli_query($con, "select * from tbl_shows WHERE `id`='" . $cit );
    while($m=mysqli_fetch_array($que))
    {
    echo '
    <div class="theatre">
    <a href=#>'.$m['name'].'</a>
    <p class="address">Address</p>
    </div>';
}}

?>
<?php include('footer.php');?>