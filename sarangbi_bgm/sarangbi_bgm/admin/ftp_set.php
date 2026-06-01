<? require "admin/login_check.php";
$connect=db_conn();
?>

<script language=javascript>
function del_check(del_no, command)
{
	if( command != '0'){
		if( confirm('삭제하고자 하는 FTP 에 업로드 한 음악이 있습니다.\rFTP 설정을 삭제 하면 관리도구에서 음악을 삭제 하고자 할 때\rFTP 로 접속을 하지 못하기 때문에 FTP 에 업로드 된 음악 파일은\r삭제하지 못합니다.\r\rFTP 설정을 삭제하시겠습니까?\r\r삭제-확인, 삭제 하지 않음-취소')){

			location_string = "<?=$PHP_SELF?>?mode=ftp_del&num=" + del_no;
			window.location=location_string;
		}
	}else{
		location_string = "<?=$PHP_SELF?>?mode=ftp_del&num=" + del_no;
		window.location=location_string;
	}
}
</script>

<br>
<TABLE cellspacing=1 cellpadding=0 border=0 width=500>
<tr>
	<td align=right>
		<a href='<?=$PHP_SELF?>?mode=ftp_add&mode2=add'><font color=red>[ FTP 추가 ]</font></a>
	</td>
</tr>
</table>
<TABLE cellspacing=1 cellpadding=0 border=0 bgcolor='#00A2F7' width=500>
<tr>
	<td align=center bgcolor='#00A2F7' height=18 width=170>
		<font color=white>이름</font>
	</td>
	<td align=center bgcolor='white' height=18 width=150>
		접속 아이디
	</td>
	<td align=center bgcolor='white' height=18 width=58>
		수정
	</td>
	<td align=center bgcolor='white' height=18 width=50>
		삭제
	</td>
	<td align=center bgcolor='white' height=18 width=80>
		접속 테스트
	</td>
</tr>
<tr>
	<td align=center bgcolor='white' height=18 width=100% colspan=5>
		<TABLE cellspacing=0 cellpadding=0 border=0 bgcolor='white' width=100%>
		<tr>
			<td align=center bgcolor='white' height=18 width=217>
				FTP 주소
			</td>
			<td width=1 bgcolor='#00A2F7'></td>
			<td align=center bgcolor='white' height=18 width=200>
				파일 저장 디렉토리
			</td>
			<td width=1 bgcolor='#00A2F7'></td>
			<td align=center bgcolor='white' height=18>
				포트
			</td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td align=center bgcolor='white' height=18 width=100% colspan=5>
		<TABLE cellspacing=0 cellpadding=0 border=0 bgcolor='white' width=100%>
		<tr>
			<td align=center bgcolor='white' height=18 width=418>
				웹 주소
			</td>
			<td width=1 bgcolor='#00A2F7'></td>
			<td align=center bgcolor='white' height=18>
				파일 개수
			</td>
		</tr>
		</table>
	</td></tr>
</table>
<br>

<?
$data = mysql_query( "select * from sarangbi_ftp_".$table, $connect) or error(mysql_error());

while($db_data=mysql_fetch_array($data)){

	$name=stripslashes($db_data[name]);
	$name = del_html($name);

	$address=stripslashes($db_data[address]);
	$address = del_html($address);

	$directory=stripslashes($db_data[directory]);
	$directory = del_html($directory);

	$link=stripslashes($db_data[link]);
	$link= del_html($link);

	$id=stripslashes($db_data[id]);
	$id = del_html($id);

	$port=$db_data[port];
	$no=$db_data[no];

	// 현재 FTP 에 업로드 한 모든 음악 개수
	$data2 = mysql_query( "select count(*) from sarangbi_music_".$table." where ftp=".$db_data[no], $connect) or error(mysql_error());

	$db_data2 = mysql_fetch_array($data2);

	$total2 = $db_data2["count(*)"];

	// 현재 FTP 에 업로드 한 음악 중 사용하는 음악 개수
	$data3 = mysql_query( "select count(*) from sarangbi_music_".$table." where ftp=".$db_data[no]." and use_this=1", $connect) or error(mysql_error());

	$db_data3 = mysql_fetch_array($data3);

	$total3 = $db_data3["count(*)"];
?>

<TABLE cellspacing=1 cellpadding=0 border=0 bgcolor='#00A2F7' width=500>
<tr>
	<td align=center bgcolor='#00A2F7' height=18 width=170>
		<font color=white><?=$name?></font>
	</td>
	<td align=center bgcolor='white' height=18 width=150>
		<?=$id?>
	</td>
	<td align=center bgcolor='white' height=18 width=50>
		<a href="<?=$PHP_SELF?>?mode=ftp_add&mode2=mod&no=<?=$no?>"><font color=blue>수정</font></a>
	</td>
	<td align=center bgcolor='white' height=18 width=50>
		<a href="javascript:del_check(<?=$no?>, <?=$total2?>)"><font color=blue>삭제</font></a>
	</td>
	<td align=center bgcolor='white' height=18 width=80>
		<a href="<?=$PHP_SELF?>?mode=ftp_test&no=<?=$no?>"><font color=blue>접속 테스트</font></a>
	</td>
</tr>
<tr>
	<td align=center bgcolor='white' height=18 width=100% colspan=5>
		<TABLE cellspacing=0 cellpadding=0 border=0 bgcolor='white' width=100%>
		<tr>
			<td align=center bgcolor='white' height=18 width=217>
				<?=$address?>
			</td>
			<td width=1 bgcolor='#00A2F7'></td>
			<td align=center bgcolor='white' height=18 width=200>
				<?=$directory?>
			</td>
			<td width=1 bgcolor='#00A2F7'></td>
			<td align=center bgcolor='white' height=18>
				<?=$port?>
			</td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td align=center bgcolor='white' height=18 width=100% colspan=5>
		<TABLE cellspacing=0 cellpadding=0 border=0 bgcolor='white' width=100%>
		<tr>
			<td align=center bgcolor='white' height=18 width=418>
				<?=$link?>
			</td>
			<td width=1 bgcolor='#00A2F7'></td>
			<td align=center bgcolor='white' height=18>
				<? echo "$total3 / $total2"; ?>
			</td>
		</tr>
		</table>
	</td>
</tr>

</table>
<table><tr><td height=1></td></tr></table>
<?
}
db_close();
?>
