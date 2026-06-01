<? require "admin/login_check.php"; ?>

<script language=javascript>
function check_submit()
{
	if( info.oldpw.value == ''){
		alert('기존의 비밀 번호를 입력하세요.');
		info.oldpw.focus();
		return false;
	}

	if( info.newpw1.value == ''){
		alert('새로운 비밀 번호를 입력하세요.');
		info.newpw1.focus();
		return false;
	}

	if( info.newpw1.value != info.newpw2.value){
		alert('두개의 암호가 다릅니다. 다시 입력하세요.');
		info.newpw1.focus();
		return false;
	}
	return true;
}
</script>

<br><br><br><br><br><br><br>
<form method=post action=<?=$PHP_SELF?> name=info>
<input type=hidden name=mode value='pw_write'>

<TABLE cellspacing=1 cellpadding=3 border=0 bgcolor='#00A2F7' width=250>
<tr>
	<td align=center bgcolor='#00A2F7' height=18 width=100% colspan=2>
		<font color=white>비밀 번호 변경</font>
	</td>
</tr>
	<td align=center bgcolor=#ffffff height=18 width=110>
		이전 비밀 번호
	</td>
	<td align=left bgcolor=#ffffff height=18 width=140>
		&nbsp;<input type=password name=oldpw size=20 maxlength=20 class=input2>
	</td>
</tr>
</tr>
	<td align=center bgcolor=#ffffff height=18 width=110>
		비밀 번호
	</td>
	<td align=left bgcolor=#ffffff height=18 width=140>
		&nbsp;<input type=password name=newpw1 size=20 maxlength=20 class=input2>
	</td>
</tr>
</tr>
	<td align=center bgcolor=#ffffff height=18 width=110>
		비밀 번호 (확인)
	</td>
	<td align=left bgcolor=#ffffff height=18 width=140>
		&nbsp;<input type=password name=newpw2 size=20 maxlength=20 class=input2>
	</td>
</tr>
</table>
<br>
<TABLE cellspacing=0 cellpadding=0 border=0 bgcolor=white width=250>
<tr>
	<td align=right>
		<input type=image name='submit' src='admin/img/save.gif' onclick='return check_submit();' border=0>
	</td>
</tr>
</table>
</form>
<br>
<TABLE cellspacing=0 cellpadding=0 border=0 bgcolor=white width=340>
<tr>
	<td align=left>
		<li> 비밀 번호는 영문자 기준으로 최대 20 글자까지 가능합니다.
		<li> 기존의 비밀 번호를 '이전 비밀 번호'에 입력하세요.
		<li> 새로운 비밀 번호는 두번 입력 해야 합니다.
	</td>
</tr>
</table>