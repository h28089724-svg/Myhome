<? require "admin/login_check.php"; 

$connect=db_conn();

$selected_no=explode(";",$selected_no);
$selected_count=count($selected_no)-1;

if( $old_subject == '')	error_msg("노래 제목이 공백입니다.");

if( isblank($old_caption_url)) $old_use_caption=0;
else $old_use_caption=1;

$old_subject=addslashes($old_subject);
$old_context=addslashes($old_context);
$old_link=addslashes($old_link);

$old_caption_url=addslashes($old_caption_url);

$query="select * from sarangbi_music_".$table." where no=".$selected_no[0];

$data = mysql_query( $query, $connect) or error(mysql_error());
$db_data=mysql_fetch_array($data);

$old_type = $db_data[linkfile];

if( $old_type == "0"){
	$update_query="update sarangbi_music_".$table." set 
	subject='$old_subject',
	context='$old_context',
	link='$old_link',
	caption_url='$old_caption_url',
	use_caption=$old_use_caption,
	use_this=$old_use_this,
	category=$old_category
	where no=$selected_no[0]";
}else{
	$update_query="update sarangbi_music_".$table." set 
	subject='$old_subject',
	context='$old_context',
	use_this=$old_use_this,
	category=$old_category
	where no=$selected_no[0]";
}

mysql_query( $update_query, $connect) or error(mysql_error());
?>

<br><br><br><br><br><br><br><br>
저장 하였습니다.<br>
<br>
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

<?
db_close();
?>