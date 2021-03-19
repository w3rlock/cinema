<div class="footer">
	<div class="wrap">
			<div class="footer-top">
				<ul class="foot-nav">
					<li><a href="index.php">Главная</a></li>
					<li><a href="index.php">Все фильмы</a></li>
					<li><a href="index.php">Все кинотеатры</a></li>
					<li><a href="index.php">Вход</a></li>
					<li><a href="index.php">Новости</a></li>
				</ul>
				<div class="clear"></div>
			</div>
		</div>
	</div>
</body>
</html>

<style>
.content {
	padding-bottom:0px !important;
}
#form111 {
                width:500px;
                margin:50px auto;
}
#search111{
                padding:8px 15px;
                background-color:#fff;
				border:1px solid #000;
				border-radius: 5px;
}
#button111 {
				width: 20px;
				height: 20px;
                position:relative;
				left:-25px; 
				border: 0px;
				background: url('imagesnew/search.svg') no-repeat;
				background-size:100% 100%;
}
#button111:hover  {
                background-color:#fafafa;
                color:#207cca;
}

</style>

<script src="js/auto-complete.js"></script>
 <link rel="stylesheet" href="css/auto-complete.css">
    <script>
        var demo1 = new autoComplete({
            selector: '#search111',
            minChars: 1,
            source: function(term, suggest){
                term = term.toLowerCase();
                <?php
						$qry2=mysqli_query($con,"select * from tbl_movie");
						?>
               var string="";
                <?php $string="";
                while($ss=mysqli_fetch_array($qry2))
                {
                
                $string .="'".strtoupper($ss['movie_name'])."'".",";
                //$string=implode(',',$string);
                
              
                }
                ?>
                //alert("<?php echo $string;?>");
              var choices=[<?php echo $string;?>];
                var suggestions = [];
                for (i=0;i<choices.length;i++)
                    if (~choices[i].toLowerCase().indexOf(term)) suggestions.push(choices[i]);
                suggest(suggestions);
            }
        });
    </script>