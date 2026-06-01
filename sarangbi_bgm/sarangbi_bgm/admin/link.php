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

?>
<form method=post action=<?=$PHP_SELF?> name=info>
<font color=red>음악을 링크 할 때는 http:// 나 mms:// 를 꼭 적으세요.</font>
<input type=hidden name=mode value='link_write'>
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
	<td width=70 align=center bgcolor='#00A2F7'><font color=white> 음악 주소 </font></td>
	<td width=430 align=left bgcolor=white colspan=3>
		<input type=text name='link[]' size=82 maxlength=255 class=input2>
	</td>
</tr>
<tr>
	<td width=70 align=center bgcolor='#00A2F7'><font color=white> 가사 주소 </font></td>
	<td width=430 align=left bgcolor=white colspan=3>
		<input type=text name='caption_link[]' size=82 maxlength=255 class=input2>
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
		<input type=image name='submit' src='admin/img/save.gif'>
	</td>
</tr>
</table>
</form>