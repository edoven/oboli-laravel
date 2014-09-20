<html>
    <body>
		<?php 
		
			for ($i=0; $i<count($users); $i++) 
			{
				echo "<p>".$users[$i]['email']." - ".$users[$i]['oboli_count']." - <a href=\"user/".$users[$i]['id']."\">PROFILE</a></p>";
			}
		?>  
    </body>
</html>
