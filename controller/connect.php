<?php
	
	class database
	{
		
		function connection()
		{
			return mysqli_connect('localhost','Ian','password','hrm_db');
		}
	}

?>