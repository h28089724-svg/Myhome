<? require "admin/login_check.php"; 
$connect=db_conn();

$selected_no=explode(";",$selected_no);
$selected_count=count($selected_no)-1;

for( $i=0; $i<$selected_count; $i++){
	$update_query="update sarangbi_music_".$table." set category=".$to_category." where no=".$selected_no[$i];
	mysql_query( $update_query, $connect) or error(mysql_error());
}

$data = mysql_query( "select * from sarangbi_category_".$table." where no=".$to_category, $connect) or error(mysql_error());

$db_data=mysql_fetch_array($data);

$name=stripslashes($db_data[name]);
$name = del_html($name);

?>

<br><br><br><br>
<?=$selected_count?> 개의 음악을 ( <?=$name?> ) 으로 이동 하였습니다.
<br><br>

<form method=post action=<?=$PHP_SELF?>>
<input type=hidden name=mode value='list'>
<input type=hidden name=page value='<?=$page?>'>
<input type=hidden name=select_page_num value='<?=$select_page_num?>'>
<input type=hidden name=select_linkfile value='<?=$select_linkfile?>'>
<input type=hidden name=select_category value='<?=$select_category?>'>
<input type=hidden name=select_use value='<?=$select_use?>'>
<input type=hidden name=search_string value='<?=$search_string?>'>
<input type=image name='submit' src='admin/img/ok.gif'>
</form>

<? db_close(); ?>