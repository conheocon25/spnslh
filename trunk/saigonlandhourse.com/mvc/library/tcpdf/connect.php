<?php
class Connection
{
	function connect ($server,$user,$password,$dbname)
	{
		$db=mysql_connect($servername,$user,$password);
		if(!$db)
		{
			echo "không thể kết nối cơ sỡ dữ liệu!";
			exit;
		}
		$db_selected=mysql_select_db($dbname);
		if(!$db_selected)
		{
			echo("không thể sữ dụng CSDL:".mysql_error());
		}
	}
}
?>