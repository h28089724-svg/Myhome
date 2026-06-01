<? require "admin/login_check.php"; 

$connect=db_conn();

if( isblank($new_category)){
	error_msg("카테고리 이름이 공백입니다.");
}else{
	$new_category=addslashes(del_html($new_category));

	$check=mysql_fetch_array(mysql_query("select count(*) from sarangbi_category_".$table." where name='$new_category'"));

	$check2=mysql_fetch_array(mysql_query("select * from sarangbi_category_".$table." where name='$new_category'"));

	if( $mode2 == 'mod' && $check2[no] == $num)	$check[0] = 0;

	if($check[0]>0){
		error_msg("동일한 이름의 카테고리가 이미 있습니다.");
	}else{
		if( $mode2 == 'add'){
			$write_query="insert into sarangbi_category_".$table." values(
				'',
				('$new_category'))";
		}else{
			$write_query="update sarangbi_category_".$table." set name='$new_category' where no=$num";
		}
	
		mysql_query( $write_query, $connect) or error(mysql_error());
		echo "<br><br><br><br><br><br><br><br><br><br>";

		if( $mode2 == "add") echo "카테고리를 추가 하였습니다.";
		else echo "카테고리를 수정 하였습니다.";
		echo "<br><br><a href='$PHP_SELF?mode=category'><img src='admin/img/ok.gif' border=0></a>";
   }
}
db_close();
?>