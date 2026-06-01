<? require "admin/login_check.php";

$connect=db_conn();

$data = mysql_query( "select * from sarangbi_setup_".$table." where no=1", $connect) or error(mysql_error());

$db_data=mysql_fetch_array($data);

echo "
<script language=javascript>
function check_submit()
{
	if( info.new_frame[1].checked){
		if( info.new_bgm_frame.value == '' || info.new_list_frame.value == ''){
			alert(\"Frame 을 사용하여 BGM List 를 띄울 경우 BGM 이 설치된 프레임과 BGM List 프레임의 이름이 있어야 합니다.\");
			info.new_bgm_frame.focus();
			return false;
		}else return true;
	}else
		return true;
}
</script>";

$db_data[bgm_frame]=stripslashes($db_data[bgm_frame]);
$db_data[list_frame]=stripslashes($db_data[list_frame]);
$db_data[skin_dir]=stripslashes($db_data[skin_dir]);
$db_data[play_alt]=stripslashes($db_data[play_alt]);
$db_data[stop_alt]=stripslashes($db_data[stop_alt]);
$db_data[back_alt]=stripslashes($db_data[back_alt]);
$db_data[forward_alt]=stripslashes($db_data[forward_alt]);
$db_data[pause_alt]=stripslashes($db_data[pause_alt]);
$db_data[vol_up_alt]=stripslashes($db_data[vol_up_alt]);
$db_data[vol_down_alt]=stripslashes($db_data[vol_down_alt]);
$db_data[one_alt]=stripslashes($db_data[one_alt]);
$db_data[loop_alt]=stripslashes($db_data[loop_alt]);
$db_data[sound_on_alt]=stripslashes($db_data[sound_on_alt]);
$db_data[sound_off_alt]=stripslashes($db_data[sound_off_alt]);
$db_data[sequence_alt]=stripslashes($db_data[sequence_alt]);
$db_data[random_alt]=stripslashes($db_data[random_alt]);
$db_data[list_alt]=stripslashes($db_data[list_alt]);
$db_data[admin_alt]=stripslashes($db_data[admin_alt]);

echo "<br>
<form method=post action=".$PHP_SELF." name=info>
<input type=hidden name=mode value='setup_write'>

<TABLE cellspacing=1 cellpadding=3 border=0 bgcolor='#00A2F7' width=350>
<tr>
	<td align=center bgcolor='#00A2F7' height=18 width=100% colspan=2>
		<font color=white>환경 설정</font>
	</td>
</tr>
	<td align=center bgcolor=#ffffff height=18 width=100>
		암호
	</td>
	<td align=left bgcolor=#ffffff height=18 >
		&nbsp;**********&nbsp;&nbsp;&nbsp;<a href='$PHP_SELF?mode=change_pw'><font color=red>[암호 변경]</font></a>
	</td>
</tr>
<tr>
	<td align=center bgcolor=#ffffff height=18 width=100>
		스킨
	</td>
	<td align=left bgcolor=#ffffff height=18 width=250>
	<select name=new_skin_dir class=select1>";
	$handle=opendir("skin");
	while ($skin_info = readdir($handle))
	{
	if(!eregi("\.",$skin_info))
	{
	   if($skin_info==$db_data[skin_dir]) $select="selected"; else $select="";
	   echo "<option value=$skin_info $select>$skin_info</option>";
	  }
	 }
	closedir($handle);
	echo "</select>
	</td>
</tr>
<tr>
	<td align=center bgcolor=#ffffff height=18 width=100>
		음악 정렬
	</td>
	<td align=left bgcolor=#ffffff height=18 width=250>
	<select name=new_sort class=select1>
	<option value=0 "; if( $db_data[use_sort] == '0'){ echo "selected";}
	echo ">최근 음악이 가장 위에</option>
	<option value=1 "; if( $db_data[use_sort] == '1'){ echo "selected";}
	echo ">최근 음악이 가장 아래에</option>
	<option value=2 "; if( $db_data[use_sort] == '2'){ echo "selected";}
	echo ">가나다 순으로</option>
	<option value=3 "; if( $db_data[use_sort] == '3'){ echo "selected";}
	echo ">가나다 역순으로</option>
	</select>
	</td>
</tr>
<tr>
	<td align=center bgcolor=#ffffff height=18 width=100>
		초기 볼륨 크기
	</td>
	<td align=left bgcolor=#ffffff height=18 width=250>
	<select name=new_init_volume class=select1>";
	for( $i=10; $i>0; $i--){
		if( $db_data[init_volume] == $i) $select="selected"; else $select="";
		echo "<option value=$i $select>$i</option>";
	}
	echo "</select>
	&nbsp;&nbsp;&nbsp; (최대 볼륨 크기 : 10)
	</td>
</tr>
<tr>
	<td align=center bgcolor=#ffffff height=18 width=100>
		List 음악 개수
	</td>
	<td align=left bgcolor=#ffffff height=18 width=250>
	<select name=new_num_list class=select1>";
	for( $i=5; $i<=20; $i+=5){
		if( $db_data[num_list] == $i) $select="selected"; else $select="";
		echo "<option value=$i $select>$i</option>";
	}
	echo "</select>
	&nbsp;&nbsp;&nbsp; (최소 : 5개, 최대 : 20개)
	</td>
</tr>
<tr>
	<td align=center bgcolor=#ffffff height=18 width=100>
		처음 시작
	</td>
	<td align=left bgcolor=#ffffff height=18 width=250>
		<input type=radio name=new_start value=1 ";
		if( $db_data[use_start] == 1) echo "checked";
		echo ">Play&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=radio name=new_start value=0 ";
		if( $db_data[use_start] == 0) echo "checked";
		echo ">Stop
	</td>
</tr>
<tr>
	<td align=center bgcolor=#ffffff height=18 width=100>
		재생 모드
	</td>
	<td align=left bgcolor=#ffffff height=18 >
		<input type=radio name=new_random value=1 ";
		if( $db_data[use_random] == 1) echo "checked";
		echo ">랜덤 재생&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=radio name=new_random value=0 ";
		if( $db_data[use_random] == 0) echo "checked";
		echo ">순차 재생
	</td>
</tr>
<tr>
	<td align=center bgcolor=#ffffff height=18 width=100>
		노래 메모
	</td>
	<td align=left bgcolor=#ffffff height=18 >
		<input type=radio name=new_context value=1 ";
		if( $db_data[use_context] == 1) echo "checked";
		echo ">출력 하기&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=radio name=new_context value=0 ";
		if( $db_data[use_context] == 0) echo "checked";
		echo ">출력 하지 않음
	</td>
</tr>
<tr>
	<td align=center bgcolor=#ffffff height=18 width=100>
		카테고리 목록
	</td>
	<td align=left bgcolor=#ffffff height=18 >
		<input type=radio name=new_category value=1 ";
		if( $db_data[use_category] == 1) echo "checked";
		echo ">출력 하기&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=radio name=new_category value=0 ";
		if( $db_data[use_category] == 0) echo "checked";
		echo ">출력 하지 않음
	</td>
</tr>
<tr>
	<td align=center bgcolor=#ffffff height=18 width=100>
		브라우저 상태창
	</td>
	<td align=left bgcolor=#ffffff height=18 >
		<input type=radio name=new_status value=1 ";
		if( $db_data[use_status] == 1) echo "checked";
		echo ">BGM 제목 출력&nbsp;&nbsp;<input type=radio name=new_status value=0 ";
		if( $db_data[use_status] == 0) echo "checked";
		echo ">출력 하지 않음
	</td>
</tr>
<tr>
	<td align=center bgcolor=#ffffff height=18 width=100>
		사용자 선택 듣기
	</td>
	<td align=left bgcolor=#ffffff height=18 >
		<input type=radio name=new_user value=1 ";
		if( $db_data[use_user] == 1) echo "checked";
		echo ">사용&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=radio name=new_user value=0 ";
		if( $db_data[use_user] == 0) echo "checked";
		echo ">사용 하지 않음
	</td>
</tr>
<tr>
	<td align=center bgcolor=#ffffff height=18 width=100>
		BGM 리스트
	</td>
	<td align=left bgcolor=#ffffff height=18 >
		<input type=radio name=new_frame value=0 ";
		if( $db_data[use_frame] == 0) echo "checked";
		echo ">새 창 띄우기&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=radio name=new_frame value=1 ";
		if( $db_data[use_frame] == 1) echo "checked";
		echo ">다른 프레임에 출력
	</td>
</tr>
<tr>
	<td align=center bgcolor=#ffffff height=18 width=100>
		프레임 이름
	</td>
	<td align=left bgcolor=#ffffff height=18 >
		&nbsp;BGM 프레임 : <input type=text name=new_bgm_frame size=26 maxlength=100 class=input2 value=\"$db_data[bgm_frame]\"><br>
		&nbsp;List 프레임 &nbsp;&nbsp;: <input type=text name=new_list_frame size=26 maxlength=100 class=input2 value=\"$db_data[list_frame]\">
		</td>
</tr>
</table>
<br>

<TABLE cellspacing=1 cellpadding=3 border=0 bgcolor='#00A2F7' width=500>
<tr>
	<td align=center bgcolor='#00A2F7' height=18 width=100% colspan=2>
		<font color=white>마우스 버튼 over 풍선 도움말 설정</font>
	</td>
</tr>
<tr>
	<td align=center bgcolor=#ffffff width=50%>
	<TABLE cellspacing=0 cellpadding=0 border=0 bgcolor=white width=100%>
	<tr>
		<td align=center bgcolor=#ffffff height=18 width=80>
			Play
		</td>
		<td align=center width=170>
			 <input type=text name=new_play_alt size=27 maxlength=100 class=input2 value=\"$db_data[play_alt]\">
		</td>
	</tr>
	</table>
	</td>
	<td align=center bgcolor=#ffffff width=50%>

	</td>
</tr>
<tr>
	<td align=center bgcolor=#ffffff width=50%>
	<TABLE cellspacing=0 cellpadding=0 border=0 bgcolor=white width=100%>
	<tr>
		<td align=center bgcolor=#ffffff height=18 width=80>
			Stop
		</td>
		<td align=center width=170>
			 <input type=text name=new_stop_alt size=27 maxlength=100 class=input2 value=\"$db_data[stop_alt]\">
		</td>
	</tr>
	</table>
	</td>
	<td align=center bgcolor=#ffffff width=50%>
	<TABLE cellspacing=0 cellpadding=0 border=0 bgcolor=white width=100%>
	<tr>
		<td align=center bgcolor=#ffffff height=18 width=80>
			Pause
		</td>
		<td align=center width=170>
			 <input type=text name=new_pause_alt size=27 maxlength=100 class=input2 value=\"$db_data[pause_alt]\">
		</td>
	</tr>
	</table>
	</td>
</tr>
<tr>
	<td align=center bgcolor=#ffffff width=50%>
	<TABLE cellspacing=0 cellpadding=0 border=0 bgcolor=white width=100%>
	<tr>
		<td align=center bgcolor=#ffffff height=18 width=80>
			Back
		</td>
		<td align=center width=170>
			 <input type=text name=new_back_alt size=27 maxlength=100 class=input2 value=\"$db_data[back_alt]\">
		</td>
	</tr>
	</table>
	</td>
	<td align=center bgcolor=#ffffff width=50%>
	<TABLE cellspacing=0 cellpadding=0 border=0 bgcolor=white width=100%>
	<tr>
		<td align=center bgcolor=#ffffff height=18 width=80>
			Forward
		</td>
		<td align=center width=170>
			 <input type=text name=new_forward_alt size=27 maxlength=100 class=input2 value=\"$db_data[forward_alt]\">
		</td>
	</tr>
	</table>
	</td>
</tr>
<tr>
	<td align=center bgcolor=#ffffff width=50%>
	<TABLE cellspacing=0 cellpadding=0 border=0 bgcolor=white width=100%>
	<tr>
		<td align=center bgcolor=#ffffff height=18 width=80>
			Volume Up
		</td>
		<td align=center width=170>
			 <input type=text name=new_vol_up_alt size=27 maxlength=100 class=input2 value=\"$db_data[vol_up_alt]\">
		</td>
	</tr>
	</table>
	</td>
	<td align=center bgcolor=#ffffff width=50%>
	<TABLE cellspacing=0 cellpadding=0 border=0 bgcolor=white width=100%>
	<tr>
		<td align=center bgcolor=#ffffff height=18 width=80>
			Volume Down
		</td>
		<td align=center width=170>
			 <input type=text name=new_vol_down_alt size=27 maxlength=100 class=input2 value=\"$db_data[vol_down_alt]\">
		</td>
	</tr>
	</table>
	</td>
</tr>
<tr>
	<td align=center bgcolor=#ffffff width=50%>
	<TABLE cellspacing=0 cellpadding=0 border=0 bgcolor=white width=100%>
	<tr>
		<td align=center bgcolor=#ffffff height=18 width=80>
			No Loop
		</td>
		<td align=center width=170>
			 <input type=text name=new_one_alt size=27 maxlength=100 class=input2 value=\"$db_data[one_alt]\">
		</td>
	</tr>
	</table>
	</td>
	<td align=center bgcolor=#ffffff width=50%>
	<TABLE cellspacing=0 cellpadding=0 border=0 bgcolor=white width=100%>
	<tr>
		<td align=center bgcolor=#ffffff height=18 width=80>
			Loop
		</td>
		<td align=center width=170>
			 <input type=text name=new_loop_alt size=27 maxlength=100 class=input2 value=\"$db_data[loop_alt]\">
		</td>
	</tr>
	</table>
	</td>
</tr>
<tr>
	<td align=center bgcolor=#ffffff width=50%>
	<TABLE cellspacing=0 cellpadding=0 border=0 bgcolor=white width=100%>
	<tr>
		<td align=center bgcolor=#ffffff height=18 width=80>
			Sound On
		</td>
		<td align=center width=170>
			 <input type=text name=new_sound_on_alt size=27 maxlength=100 class=input2 value=\"$db_data[sound_on_alt]\">
		</td>
	</tr>
	</table>
	</td>
	<td align=center bgcolor=#ffffff width=50%>
	<TABLE cellspacing=0 cellpadding=0 border=0 bgcolor=white width=100%>
	<tr>
		<td align=center bgcolor=#ffffff height=18 width=80>
			Sound Off
		</td>
		<td align=center width=170>
			 <input type=text name=new_sound_off_alt size=27 maxlength=100 class=input2 value=\"$db_data[sound_off_alt]\">
		</td>
	</tr>
	</table>
	</td>
</tr>
<tr>
	<td align=center bgcolor=#ffffff width=50%>
	<TABLE cellspacing=0 cellpadding=0 border=0 bgcolor=white width=100%>
	<tr>
		<td align=center bgcolor=#ffffff height=18 width=80>
			Sequence
		</td>
		<td align=center width=170>
			 <input type=text name=new_sequence_alt size=27 maxlength=100 class=input2 value=\"$db_data[sequence_alt]\">
		</td>
	</tr>
	</table>
	</td>
	<td align=center bgcolor=#ffffff width=50%>
	<TABLE cellspacing=0 cellpadding=0 border=0 bgcolor=white width=100%>
	<tr>
		<td align=center bgcolor=#ffffff height=18 width=80>
			Random
		</td>
		<td align=center width=170>
			 <input type=text name=new_random_alt size=27 maxlength=100 class=input2 value=\"$db_data[random_alt]\">
		</td>
	</tr>
	</table>
	</td>
</tr>
<tr>
	<td align=center bgcolor=#ffffff width=50%>
	<TABLE cellspacing=0 cellpadding=0 border=0 bgcolor=white width=100%>
	<tr>
		<td align=center bgcolor=#ffffff height=18 width=80>
			BGM List
		</td>
		<td align=center width=170>
			 <input type=text name=new_list_alt size=27 maxlength=100 class=input2 value=\"$db_data[list_alt]\">
		</td>
	</tr>
	</table>
	</td>
	<td align=center bgcolor=#ffffff width=50%>
	<TABLE cellspacing=0 cellpadding=0 border=0 bgcolor=white width=100%>
	<tr>
		<td align=center bgcolor=#ffffff height=18 width=80>
			BGM ADMIN
		</td>
		<td align=center width=170>
			 <input type=text name=new_admin_alt size=27 maxlength=100 class=input2 value=\"$db_data[admin_alt]\">
		</td>
	</tr>
	</table>
	</td>
</tr>
</table>
<br>
<TABLE cellspacing=0 cellpadding=0 border=0 bgcolor=white width=500>
<tr>
	<td bgcolor=white height=18 width=100% align=right>
	<input type=image name='submit' src='admin/img/save.gif' onclick='return check_submit();' border=0>
	</td>
</tr>
</table>
</form>";
db_close();
?>