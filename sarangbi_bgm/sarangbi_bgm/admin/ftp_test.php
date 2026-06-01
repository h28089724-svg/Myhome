<? require "admin/login_check.php";
$connect=db_conn();

$data = mysql_query( "select * from sarangbi_ftp_".$table." where no='$no'", $connect) or error(mysql_error());

$db_data=mysql_fetch_array($data);

$name=stripslashes($db_data[name]);
$name = del_html($name);

$address=stripslashes($db_data[address]);
$address = del_html($address);

$directory=stripslashes($db_data[directory]);
$directory = del_html($directory);

$id=stripslashes($db_data[id]);
$id = del_html($id);

$pw=stripslashes($db_data[pw]);
$pw = del_html($pw);

$port=$db_data[port];
?>
<br><br><br>
FTP 접속 테스트<br><br>
<TABLE cellspacing=1 cellpadding=0 border=0 bgcolor='#00A2F7' width=470>
<tr>
	<td height=18 width=70 align=center bgcolor='#00A2F7'><font color=white> 이름 </font></td>
	<td bgcolor=white>&nbsp;<?=$name?></td>
	<td width=70 align=center bgcolor='#00A2F7'><font color=white> Port </font></td>
	<td bgcolor=white>&nbsp;<?=$port?></td>
</tr>
<tr>
	<td height=18 width=70 align=center bgcolor='#00A2F7'><font color=white> 아이디 </font></td>
	<td bgcolor=white>&nbsp;<?=$id?></td>
	<td width=70 align=center bgcolor='#00A2F7'><font color=white> 암호 </font></td>
	<td bgcolor=white>&nbsp;********</td>
</tr>
<tr>
	<td height=18 width=70 align=center bgcolor='#00A2F7'><font color=white> 주소 </font></td>
	<td bgcolor=white colspan=3>&nbsp;<?=$address?></td>
</tr>
<tr>
	<td height=18 width=70 align=center bgcolor='#00A2F7'><font color=white> 디렉토리 </font></td>
	<td bgcolor=white colspan=3>&nbsp;<?=$directory?></td>
</table>
<br><br><br>
<?

function ftp_fail()
{
	echo "<font color=red> - 실패</font>";
	echo "<br><br><a href='javascript:history.go(-1)'><img src='admin/img/ok.gif' border=0></a>";
	include "admin/tail.php";
	exit;
}

function ftp_ok()
{
	echo "<font color=blue> - 성공</font>";
	echo "<br>";
}

echo "FTP 접속";
if( !($ftp = @ftp_connect( $address, $port))) ftp_fail();
ftp_ok();

echo "로그인";
if( !@ftp_login( $ftp, $id, $pw)) ftp_fail();
ftp_ok();

if( $directory != ''){
	echo "디렉토리 접근";
	if( !@ftp_chdir( $ftp, $directory)) ftp_fail();
	ftp_ok();
}

@ftp_quit($ftp);
?>
<br><br>
FTP 접속에 성공하였습니다.
<br><br><a href='javascript:history.go(-1)'><img src='admin/img/ok.gif' border=0></a>