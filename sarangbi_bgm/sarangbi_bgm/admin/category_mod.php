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
</script>
<br><br><br><br><br><br><br><br><br>
<form method=post action=<?=$PHP_SELF?> name=info>
<input type=hidden name=mode value='category_wrt'>
<input type=hidden name=mode2 value='mod'>
<TABLE cellspacing=1 cellpadding=3 border=0 bgcolor='#C5EEFF' width=260>
<tr>
	<td align=center bgcolor='#00A2F7' height=18 width=260>
		<font color=white>카테고리 이름</font>
	</td>
</tr>
<?
$data = mysql_query( "select * from sarangbi_category_".$table." where no=$num", $connect) or error(mysql_error());

$db_data=mysql_fetch_array($data);

$name=stripslashes($db_data[name]);
$name = del_html($name);
?>
<input type=hidden name=num value=<?=$db_data[no]?>>
<tr>
	<td align=center bgcolor='white' height=18 width=260>
		<input type=text name=new_category size=26 maxlength=100 class=input2 value="<?=$name?>">
	</td>
</tr>
</table>
<br>
<TABLE cellspacing=0 cellpadding=0 border=0 bgcolor=white width=260>
<tr>
	<td align=right>
		<input type=image name='submit' src='admin/img/save.gif' onclick='return check_submit();' border=0>
	</td>
	<td align=left>
		&nbsp;<a href='javascript:history.go(-1)'><img src='admin/img/back.gif' border=0></a>
	</td>
</tr>
</table>

</form>
<?
db_close();
?>