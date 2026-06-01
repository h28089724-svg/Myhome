<? require "admin/login_check.php"; 
$connect=db_conn();

$selected_no_copy=$selected_no; 
$selected_no=explode(";",$selected_no);
$selected_count=count($selected_no)-1;


for( $i=0; $i<$selected_count; $i++){
	$query="select MAX(no) from sarangbi_music_".$table;
	$data = mysql_query( $query, $connect) or error(mysql_error());
	$db_data=mysql_fetch_array($data);

	$max_number = $db_data[0] + 1;

	$query="update sarangbi_music_".$table." set no=$max_number where no=$selected_no[$i]";
	mysql_query( $query, $connect) or error(mysql_error());
}
db_close();
?>
<br><br><br><br><br><br><br><br>
선택한 음악을 가장 위로 올렸습니다.<br>
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