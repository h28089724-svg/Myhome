<? require "admin/login_check.php"; 
$connect=db_conn();

$selected_no_copy=$selected_no; 
$selected_no=explode(";",$selected_no);
$selected_count=count($selected_no)-1;
?>
<br><br>
<TABLE cellspacing=0 cellpadding=0 border=0 bgcolor='white' width=300>
<tr>
	<td align=left>
		카테고리를 변경 할 노래 (<?=$selected_count?> 개)
	</td>
</tr>
</table>

<TABLE cellspacing=1 cellpadding=3 border=0 bgcolor='#00A2F7' width=300>
<?
for( $i=0; $i<$selected_count; $i++){
	$query="select * from sarangbi_music_".$table." where no=".$selected_no[$i];
	$data = mysql_query( $query, $connect) or error(mysql_error());
	$db_data=mysql_fetch_array($data);
	$print_subject = $db_data[subject];
	$print_subject = stripslashes($print_subject);
	$print_subject = del_html($print_subject);
?>
	<tr>
	<td align=left bgcolor='white' height=18>
		&nbsp;<?=$print_subject?>
	</td>
	</tr>
<? } ?>
</table>
<br>
<center>
<TABLE cellspacing=0 cellpadding=0 border=0 bgcolor='#ffffff'>
<tr>
	<td align=center width=80 bgcolor=#00A2F7>
		<font color=white>카테고리 선택</font>
	</td>
	<td align=left bgcolor=white>
	<form method=post action=<?=$PHP_SELF?>>
<?
	global $table, $connect, $select_category;

	$data = mysql_query( "select * from sarangbi_category_".$table, $connect) or error(mysql_error());
	
	echo "<select name=to_category class=input1>";
	while($db_data=mysql_fetch_array($data)){
		$ca_name=stripslashes($db_data[name]);
		$ca_name = del_html($ca_name);
		$ca_no=$db_data[no];
		echo "<option value=$ca_no>$ca_name</option>";
	}
	echo "</select>";
?>

	</td>
</tr>
</table>
</center>
<br>
<TABLE cellspacing=1 cellpadding=3 border=0 bgcolor='white' width=300>
<tr>
	<td align=right>
		<input type=hidden name=mode value='list_mc_ok'>
		<input type=hidden name=page value='<?=$page?>'>
		<input type=hidden name=select_page_num value='<?=$select_page_num?>'>
		<input type=hidden name=select_linkfile value='<?=$select_linkfile?>'>
		<input type=hidden name=select_category value='<?=$select_category?>'>
		<input type=hidden name=select_use value='<?=$select_use?>'>
		<input type=hidden name=selected_no value='<?=$selected_no_copy?>'>
		<input type=hidden name=search_string value='<?=$search_string?>'>
		<input type=image name='submit' src='admin/img/ok.gif'>
		</form>
	</td>
	<td align=left>
		<form method=post action=<?=$PHP_SELF?>>
		<input type=hidden name=mode value='list'>
		<input type=hidden name=page value='<?=$page?>'>
		<input type=hidden name=select_page_num value='<?=$select_page_num?>'>
		<input type=hidden name=select_linkfile value='<?=$select_linkfile?>'>
		<input type=hidden name=select_category value='<?=$select_category?>'>
		<input type=hidden name=select_use value='<?=$select_use?>'>
		<input type=hidden name=search_string value='<?=$search_string?>'>
		<input type=image name='submit' src='admin/img/back.gif'>
		</form>		
	</td>
</tr>
</table>

<?
db_close();
?>