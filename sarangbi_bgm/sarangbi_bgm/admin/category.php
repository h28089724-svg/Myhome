<? require "admin/login_check.php";
$connect=db_conn();
?>

<script language=javascript>
function check_submit()
{
	if( info.new_category.value == ''){
		alert("카테고리 이름을 입력하세요.");
		info.new_category.focus();
		return false;
	}else return true;
}

function del_check(del_no, command)
{
	if( command != '0'){
		alert("등록된 음악이 있습니다. 음악을 모두 삭제하고 카테고리를 삭제하세요.");
	}else{
		location_string = "<?=$PHP_SELF?>?mode=category_del&num=" + del_no;
		window.location=location_string;
	}
}

</script>

<br>
<TABLE cellspacing=1 cellpadding=3 border=0 bgcolor='#C5EEFF' width=500>
<tr>
	<td align=center bgcolor='#00A2F7' height=18 width=260>
		<font color=white>카테고리 이름</font>
	</td>
	<td align=center bgcolor='#00A2F7' height=18 width=110>
			<font color=white>등록된 음악개수</font>
	</td>
	<td align=center bgcolor='#00A2F7' height=18 width=50>
			<font color=white>수정</font>
	</td>
	<td align=center bgcolor='#00A2F7' height=18 width=50>
			<font color=white>삭제</font>
	</td>
<tr>

<?
$data = mysql_query( "select * from sarangbi_category_".$table, $connect) or error(mysql_error());

$at_first=true;
while($db_data=mysql_fetch_array($data)){
	$name=stripslashes($db_data[name]);
	$name = del_html($name);

	// 현재 카테고리에 등록된 모든 음악 개수
	$data2 = mysql_query( "select count(*) from sarangbi_music_".$table." where category=".$db_data[no], $connect) or error(mysql_error());

	$db_data2 = mysql_fetch_array($data2);

	$total2 = $db_data2["count(*)"];

	// 등록된 음악 중 사용하는 음악 개수
	$data3 = mysql_query( "select count(*) from sarangbi_music_".$table." where category=".$db_data[no]." and use_this=1", $connect) or error(mysql_error());

	$db_data3 = mysql_fetch_array($data3);

	$total3 = $db_data3["count(*)"];



	echo "
	<tr>
	<td align=center bgcolor='white' height=18 width=260>
		$name
	</td>
	<td align=center bgcolor='white' height=18 width=110>
			$total3 / $total2
	</td>
	<td align=center bgcolor='white' height=18 width=50>
			<a href='$PHP_SELF?mode=category_mod&num=$db_data[no]'>수정</a>
	</td>
	<td align=center bgcolor='white' height=18 width=50>";
	if( $at_first == false)
		echo "<a href=\"javascript:del_check( $db_data[no], $total2)\">삭제</a>";
	else{
		echo "";
		$at_first=false;
	}
	echo "</td>
	</tr>";
}
?>
</table>
<br>
<form method=post action=<?=$PHP_SELF?> name=info>
<input type=hidden name=mode value='category_wrt'>
<input type=hidden name=mode2 value='add'>
<input type=text name=new_category size=26 maxlength=255 class=input2>
<input type=submit name='submit' value='카테고리 추가' onclick='return check_submit();' class=button1>
</form>
<?
db_close();
?>
