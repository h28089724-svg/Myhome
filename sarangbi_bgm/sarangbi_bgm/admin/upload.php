<? require "admin/login_check.php"; 

$connect=db_conn();

function show_category()
{
	global $table, $connect;

	$data = mysql_query( "select * from sarangbi_category_".$table, $connect) or error(mysql_error());
	
	echo "<select name=category[] class=input>";
	while($db_data=mysql_fetch_array($data)){
		$ca_name=stripslashes($db_data[name]);
		$ca_name = del_html($ca_name);
		$ca_no=$db_data[no];

			echo "<option value=$ca_no>$ca_name</option>";
	}
	echo "</select>";
}

$filesize = ConvertByte(get_cfg_var("upload_max_filesize"));

$temp_filesize = get_cfg_var("upload_max_filesize");

if( $filesize == 0 ){
	$filesize=2097152;
	$temp_filesize='2M';
}
?>

<script language=javascript>
var upload_type="<?=$mode?>";

function check_submit(){
	if(document.check_attack.check.value==1){
		alert('업로드 중입니다. 잠시 기다려 주세요. ^^');
		return false;
	}

	if( upload_type == "ftp_upload"){
		if( document.upload.ftp_no.value == ''){
			alert('업로드 할 FTP 설정이 없습니다.\rFTP 설정을 먼저 하세요.');
			return false;
		}
	}
		
	document.check_attack.check.value=1;
	show_waiting();
	return true;
}

function show_waiting() {
	var _x = document.body.clientWidth/2 + document.body.scrollLeft - 145;
	var _y = document.body.clientHeight/2 + document.body.scrollTop - 44;
	sarangbi_waiting.style.posLeft=_x;
	sarangbi_waiting.style.posTop=_y;
	sarangbi_waiting.style.visibility='visible';
}
</script>

<form name=check_attack>
<input type=hidden name=check value=0>
</form>
<div id='sarangbi_waiting' style='position:absolute; left:50px; top:120px; width:292; height: 91; z-index:1; visibility: hidden'>
<img src="admin/img/upload.gif" border=0>
</div>

<?
if( $mode == "upload") $tmp="upload_write";
else $tmp="ftp_write";
?>

<form method=post action=<?=$PHP_SELF?> name=upload enctype=multipart/form-data>
<input type=hidden name=mode value='<?=$tmp?>'>
<input type=hidden name=MAX_FILE_SIZE value=$filesize>

<TABLE cellspacing=1 cellpadding=0 border=0 bgcolor='white' width=500>
<tr>
	<td width=200 align=center valign=bottom>
		<font color=red>최대 업로드 파일 크기 : <?=$temp_filesize?>
	</td>
	<td width=300 align=right>
<?
if( $mode == "ftp_upload"){
	$data = mysql_query( "select * from sarangbi_ftp_".$table, $connect) or error(mysql_error());
	
	echo "<font color=red>업로드 할 FTP 선택 : </font>";
	echo "<select name=ftp_no class=input>";
	while($db_data=mysql_fetch_array($data)){
		$ftp_name=stripslashes($db_data[name]);
		$ftp_name = del_html($ftp_name);
		$ftp_no=$db_data[no];
		echo "<option value=$ftp_no>$ftp_name</option>";
	}
	echo "</select>";
}
?>
	</td>
</tr>
</table>
<? for( $i=0; $i<$max_write; $i++){ ?>
<TABLE cellspacing=1 cellpadding=0 border=0 bgcolor='#00A2F7' width=500>
<tr><td>
<TABLE cellspacing=1 cellpadding=0 border=0 bgcolor='white' width=100%>
<tr>
	<td width=70 align=center bgcolor='#00A2F7'><font color=white> 제목 </font></td>
	<td width=200 align=left bgcolor=white>
		<input type=text name='subject[]' size=35 maxlength=255 class=input2>
	</td>
	<td width=70 align=center bgcolor='#00A2F7'><font color=white> 카테고리 </font></td>
	<td width=160><? show_category(); ?></td>
</tr>
<tr>
	<td width=70 align=center bgcolor='#00A2F7'><font color=white> 파일 </font></td>
	<td width=430 align=left bgcolor=white colspan=3>
		<input type=file name='file1[]' size=50 maxlength=255 class=input2>
	</td>
</tr>
<tr>
	<td width=70 align=center bgcolor='#00A2F7'><font color=white> 가사 </font></td>
	<td width=430 align=left bgcolor=white colspan=3>
		<input type=file name='caption_file1[]' size=50 maxlength=255 class=input2>
	</td>
</tr>
<tr>
	<td width=70 align=center bgcolor='#00A2F7'><font color=white> 메모 </font></td>
	<td width=430 align=left bgcolor=white colspan=3>
		<textarea name='context[]' rows=2 cols=83 class=text1></textarea>
	</td>
</tr>
</table>
</td></tr></table>
<TABLE cellspacing=0 cellpadding=0 border=0 bgcolor='white' width=500>
<tr><td height=3></td></tr></table>

<? } ?>

<TABLE cellspacing=0 cellpadding=0 border=0 bgcolor='white' width=500>
<tr><td align=right>
		<input type=image name='submit' src='admin/img/save.gif' onClick='return check_submit();'>
	</td>
</tr>
</table>
</form>
<?
db_close();
?>