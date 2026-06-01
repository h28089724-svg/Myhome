<? require "admin/login_check.php"; 
$connect=db_conn();

$selected_no=explode(";",$selected_no);
$selected_count=count($selected_no)-1;

for( $i=0; $i<$selected_count; $i++){
	if( $mode == "list_use_o")
		$update_query="update sarangbi_music_".$table." set use_this=1 where no=".$selected_no[$i];

	if( $mode == "list_use_x")
		$update_query="update sarangbi_music_".$table." set use_this=0 where no=".$selected_no[$i];

	mysql_query( $update_query, $connect) or error(mysql_error());
}

echo "<br><br><br><br>";

if( $mode == "list_use_o")
	echo "$selected_count 개의 음악을 사용 함(O)으로 변경 하였습니다.";
else
	echo "$selected_count 개의 음악을 사용 하지 않음(X)으로 변경 하였습니다.";
?>
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