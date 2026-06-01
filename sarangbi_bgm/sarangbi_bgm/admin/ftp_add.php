<? require "admin/login_check.php";
$connect=db_conn();

if( $mode2 == 'add'){
	$old_port='21';
	$old_name='';
	$old_address='';
	$old_directory='';
	$old_id='';
	$old_link='http://';
	$old_pw='';
}else{
	$data = mysql_query( "select * from sarangbi_ftp_".$table." where no='$no'", $connect) or error(mysql_error());

	$db_data=mysql_fetch_array($data);

	$old_name=stripslashes($db_data[name]);
	$old_name = del_html($old_name);

	$old_address=stripslashes($db_data[address]);
	$old_address = del_html($old_address);

	$old_directory=stripslashes($db_data[directory]);
	$old_directory = del_html($old_directory);

	$old_link=stripslashes($db_data[link]);

	$old_id=stripslashes($db_data[id]);
	$old_id = del_html($old_id);

	$old_pw=stripslashes($db_data[pw]);
	$old_pw = del_html($old_pw);

	$old_port=$db_data[port];
}
?>



<script language=javascript>
function check_submit()
{
	if( info.new_name.value == ''){
		alert("FTP 이름을 입력하세요.");
		info.new_name.focus();
		return false;
	}
	if( info.new_port.value == ''){
		alert("Port 입력하세요. (기본값은 21)");
		info.new_port.focus();
		return false;
	}
	if( info.new_id.value == ''){
		alert("FTP 접속 아이디를 입력하세요.");
		info.new_id.focus();
		return false;
	}
	if( info.new_pw.value == ''){
		alert("FTP 암호를 입력하세요.");
		info.new_pw.focus();
		return false;
	}
	if( info.new_address.value == ''){
		alert("FTP 주소를 입력하세요.");
		info.new_address.focus();
		return false;
	}
	if( info.new_link.value == '' || info.new_link.value == 'http://'){
		alert("웹 주소를 입력하세요.");
		info.new_link.focus();
		return false;
	}
}
</script>

<br><br><br><br>
<form method=post action=<?=$PHP_SELF?> name=info>
<input type=hidden name=mode value='ftp_save'>
<input type=hidden name=mode2 value=<?=$mode2?>>
<input type=hidden name=no value=<?=$no?>>
<TABLE cellspacing=1 cellpadding=0 border=0 bgcolor='white' width=470>
<tr>
	<td width=100 align=center bgcolor='#00A2F7'><font color=white> 이름 </font></td>
	<td bgcolor=white><input type=text name=new_name size=26 maxlength=255 class=input2 value="<?=$old_name?>"></td>
	<td width=80 align=center bgcolor='#00A2F7'><font color=white> Port </font></td>
	<td bgcolor=white><input type=text name=new_port size=10 maxlength=10 class=input2 value=<?=$old_port?>></td>
</tr>
<tr>
	<td   align=center bgcolor='#00A2F7'><font color=white> 아이디 </font></td>
	<td bgcolor=white><input type=text name=new_id size=26 maxlength=255 class=input2 value=<?=$old_id?>></td>
	<td   align=center bgcolor='#00A2F7'><font color=white> 암호 </font></td>
	<td bgcolor=white><input type=password name=new_pw size=26 maxlength=255 class=input2 value=<?=$old_pw?>></td>
</tr>
<tr>
	<td   align=center bgcolor='#00A2F7'><font color=white> FTP 주소 </font></td>
	<td bgcolor=white colspan=3><input type=text name=new_address size=73 maxlength=255 class=input2 value=<?=$old_address?>></td>
</tr>
<tr>
	<td   align=center bgcolor='#00A2F7'><font color=white> 디렉토리 </font></td>
	<td bgcolor=white colspan=3><input type=text name=new_directory size=73 maxlength=255 class=input2 value=<?=$old_directory?>></td>
</tr>
<tr>
	<td   align=center bgcolor='#00A2F7'><font color=white> 웹 주소 </font></td>
	<td bgcolor=white colspan=3><input type=text name=new_link size=73 maxlength=255 class=input2 value=<?=$old_link?>></td>
</tr>
</table>
<TABLE cellspacing=1 cellpadding=0 border=0 bgcolor='white' width=420>
<tr>
	<td align=right width=100%>
		<br>
		<input type=image name='submit' src='admin/img/save.gif' onclick='return check_submit();'>
		<a href='javascript:history.go(-1)'><img src='admin/img/back.gif' border=0></a>
	</td>
</tr>
</table>
</form>

<TABLE cellspacing=1 cellpadding=0 border=0 bgcolor='white' width=470>
<tr>
	<td align=left>
		<li> Port 는 일반적으로 21 입니다.
		<li> FTP 주소를 적을 때는 ftp:// 를 적지 마세요. ( 예: ftp.abc.com )
		<li> 저장할 디렉토리를 꼭 적어야 합니다.
		<li> 일반적으로 public_html 디렉토리 안에 파일을 저장해야 웹에서 접근이 가능합니다.
		<li> 작은 따옴표, 큰 따옴표 등의 특수 문자는 사용하지 마세요.
		<li> 접속 경로는 웹브라우저에서 접속 할 수 있는 주소 입니다.<br>
		&nbsp;&nbsp;&nbsp;(꼭 http:// 를 적어야 합니다.)
	</td>
</tr>
<tr>
	<td align=left>
	<br>(예제)<br>
	아이디 &nbsp;&nbsp;&nbsp;: test<br>
	FTP 주소 : ftp.abc.com<br>
	디렉토리 : public_html<br>
	웹 주소 &nbsp;&nbsp;: http://abc.com/~test/public_html 
</table>

<?
db_close();
?>