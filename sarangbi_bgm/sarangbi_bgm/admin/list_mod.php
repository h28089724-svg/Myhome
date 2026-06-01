<? require "admin/login_check.php"; 
$connect=db_conn();

$selected_no_copy=$selected_no;
$selected_no=explode(";",$selected_no);
$selected_count=count($selected_no)-1;

$query="select * from sarangbi_music_".$table." where no=".$selected_no[0];
$data = mysql_query( $query, $connect) or error(mysql_error());
$db_data=mysql_fetch_array($data);

$old_subject=stripslashes($db_data[subject]);
$old_subject=del_html($old_subject);

$old_context=stripslashes($db_data[context]);

$old_link=stripslashes($db_data[link]);

$old_use_caption=$db_data[use_caption];
$old_caption_url=stripslashes($db_data[caption_url]);

$old_use_this=$db_data[use_this];
$old_category=$db_data[category];

function show_category( $tmp)
{
	global $table, $connect;

	$data = mysql_query( "select * from sarangbi_category_".$table, $connect) or error(mysql_error());
	
	echo "<select name=old_category class=input1>";
	while($db_data=mysql_fetch_array($data)){
		$ca_name=stripslashes($db_data[name]);
		$ca_name = del_html($ca_name);
		$ca_no=$db_data[no];
		if( $tmp == $ca_no) $ca_select="selected";
		else $ca_select="";
			echo "<option value=$ca_no $ca_select>$ca_name</option>";
	}
	echo "</select>";
}
?>

<script language=javascript>
var type_linkfile=<?=$db_data[linkfile]?>;

function check_submit()
{
	if( mod.old_subject.value == ''){
		alert("노래 제목을 입력하세요.");
		mod.old_subject.focus();
		return false;
	}

	if( type_linkfile == 0){
		if( mod.old_link.value == ''){
			alert("음악 파일의 링크를 입력하세요.");
			mod.old_subject.focus();
			return false;
		}
	}

	return true;

}
</script>

<br><br><br><br>
<TABLE cellspacing=1 cellpadding=0 border=0 bgcolor='#00A2F7' width=500>
<tr><td>
<form method=post name=mod action=<?=$PHP_SELF?>>
<input type=hidden name=mode value='list_mod_ok'>
<input type=hidden name=page value='<?=$page?>'>
<input type=hidden name=select_page_num value='<?=$select_page_num?>'>
<input type=hidden name=select_linkfile value='<?=$select_linkfile?>'>
<input type=hidden name=select_category value='<?=$select_category?>'>
<input type=hidden name=select_use value='<?=$select_use?>'>
<input type=hidden name=selected_no value='<?=$selected_no_copy?>'>
<input type=hidden name=search_string value='<?=$search_string?>'>
<TABLE cellspacing=1 cellpadding=0 border=0 bgcolor='white' width=100%>
<tr>
	<td width=70 align=center bgcolor='#00A2F7'><font color=white> 제목 </font></td>
	<td width=200 align=left bgcolor=white>
		<input type=text name='old_subject' size=35 maxlength=255 class=input2 value="<?=$old_subject?>">
	</td>
	<td width=70 align=center bgcolor='#00A2F7'><font color=white> 카테고리 </font></td>
	<td width=160><? show_category($old_category); ?></td>
</tr>
<tr>
	<td width=70 align=center bgcolor='#00A2F7' height=20><font color=white> 종류 </font></td>
	<td width=200 align=left bgcolor=white>
<?
	switch ($db_data[linkfile]){
		case 0	: echo "LINK"; break;
		case 1	: echo "FILE"; break;
		case 2	: echo "FTP"; break;
	}
?>
	</td>
	<td width=70 align=center bgcolor='#00A2F7'><font color=white>사용</font></td>
	<td width=160>
	<select name=old_use_this class=input1>
<?
	if( $old_use_this == 1){
		echo "<option value=1 selected>사용 (O)</option>";
		echo "<option value=0>사용 안함 (X)</option>";
	}else{
		echo "<option value=1>사용 (O)</option>";
		echo "<option value=0 selected>사용 안함 (X)</option>";
	}
?>
	</select>
	</td>
</tr>
<? if( $db_data[linkfile] == 0){
	echo "<tr>
	<td width=70 align=center bgcolor='#00A2F7' height=20><font color=white> 파일 주소 </font></td>
	<td width=430 align=left bgcolor=white colspan=3>
		<input type=text name='old_link' size=83 maxlength=255 class=input2 value=\"$old_link\">
	</td>
</tr>
<tr>
	<td width=70 align=center bgcolor='#00A2F7' height=20><font color=white> 가사 주소 </font></td>
	<td width=430 align=left bgcolor=white colspan=3>
		<input type=text name='old_caption_url' size=83 maxlength=255 class=input2 value=\"$old_caption_url\">
	</td>
</tr>";
}else if( $db_data[linkfile] == 1){
	echo "<tr>
	<td width=70 align=center bgcolor='#00A2F7' height=20><font color=white>파일명</font></td>
	<td width=200 align=left bgcolor=white colspan=3>
		$db_data[s_filename]
	</td>
</tr>";
			if( $old_use_caption == 1){
				echo "<tr>
				<td width=70 align=center bgcolor='#00A2F7' height=20><font color=white>가사</font></td>
				<td width=430 align=left bgcolor=white colspan=3>
					$db_data[caption_s_filename]
				</td>
				</tr>";
			}
}else if( $db_data[linkfile] == 2){
	echo "<tr>
	<td width=70 align=center bgcolor='#00A2F7' height=20><font color=white>파일명</font></td>
	<td width=200 align=left bgcolor=white colspan=3>
		$db_data[s_filename]
	</td>
</tr>
<tr>
	<td width=70 align=center bgcolor='#00A2F7' height=20><font color=white>파일 주소</font></td>
	<td width=430 align=left bgcolor=white colspan=3>";
		echo del_html($old_link);
	echo "</td>
</tr>";
		if( $old_use_caption == 1){
			echo "<tr>
			<td width=70 align=center bgcolor='#00A2F7' height=20><font color=white>가사</font></td>
			<td width=430 align=left bgcolor=white colspan=3>
				$db_data[caption_s_filename]
			</td>
			</tr>";
			echo "<tr>
			<td width=70 align=center bgcolor='#00A2F7' height=20><font color=white>가사 주소</font></td>
			<td width=430 align=left bgcolor=white colspan=3>";
				echo del_html( $old_caption_url);
			echo "</td>
			</tr>";

		}
}
?>
<tr>
	<td width=70 align=center bgcolor='#00A2F7'><font color=white> 메모 </font></td>
	<td width=430 align=left bgcolor=white colspan=3>
		<textarea name='old_context' rows=5 cols=83 class=text1><?=$old_context?></textarea>
	</td>
</tr>
</table>
</td></tr></table>
<TABLE cellspacing=0 cellpadding=0 border=0 bgcolor='white' width=500>
<tr><td height=10></td></tr></table>
<TABLE cellspacing=0 cellpadding=0 border=0 bgcolor='white' width=500>
<tr>
	<td width=50% align=right>
		<input type=image name='submit' src='admin/img/save.gif' onclick='return check_submit();'>
		</form>
	</td>
	<td width=5>&nbsp;</td>
	<td width=50% align=left>
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



