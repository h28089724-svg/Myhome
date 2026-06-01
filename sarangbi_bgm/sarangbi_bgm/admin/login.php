
<script language=javascript>
function check_submit()
{
	if( !login.pw.value){
		alert('암호를 입력하세요.');
		login.pw.focus();
		return false;
	}
}
</script>

<form method=post action=<?=$PHP_SELF?> onsubmit='return check_submit();' name=login>
<input type=hidden name=mode value='login_check'>
<TABLE cellspacing=1 cellpadding=3 bgcolor='#00A2F7' border=0 width=200>
<tr>
	<td height=18 bgcolor='#00A2F7' align=center>
		<font color=white><b>Login</b></font>
	</td>
</tr><tr>
	<td bgcolor=white align=center>
		<TABLE cellspacing=0 cellpadding=0 bgcolor='white' border=0 width=100%>
		<tr><td height=3></td></tr>
		<tr>
			<td align=center>
				암호 : <input type=password name=pw size=20 maxlength=20 class=input1>
			</td>
		</tr>
		<tr><td height=5></td></tr>
		<tr>
			<td align=right>
		       <input type=submit value=' Ok~! '  style='BACKGROUND-COLOR: #DDDDDD; BORDER-LEFT: #FFFFFF 1px solid; BORDER-TOP: #FFFFFF 1px solid; BORDER-RIGHT: #666666 1px solid; BORDER-BOTTOM: #666666 1px solid; COLOR: #000000; FONT-FAMILY: Tahoma; FONT-SIZE: 11px; cursor:hand'>&nbsp;&nbsp
			</td>
		</tr>
		<tr><td height=3></td></tr>
		</table>
	</td>
</tr>
</table>
</form>
<script language=javascript>
document.login.pw.focus();
</script>