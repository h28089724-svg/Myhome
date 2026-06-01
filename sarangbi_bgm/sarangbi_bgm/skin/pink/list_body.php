<?
///////////////////////////////////////////////////////////
/*
// 배경 음악 제목을 출력 합니다.
// ===============================
// <?=$skin_dir?>	환경 변수(스킨 디렉토리의 경로)
//
// 사용할 수 있는 함수는 다음과 같습니다.
// <? show_bgm(); ?>		// BGM List 출력
// <? show_check(); ?>		// 사용자가 원하는 음악만 듣는 선택 버튼
*/
///////////////////////////////////////////////////////////


?>

<tr height=18  onMouseOver=this.style.backgroundColor='#F5F5F5';return true; onMouseOut=this.style.backgroundColor='';return true;>
	<td align=left width=95%>
	<img src=<?=$skin_dir?>list/button2.gif border=0>&nbsp;&nbsp;<? show_list(); ?>
	</td>
	<td>
	<? show_check(); ?>
	</td>
</tr>
<tr>
	<td width=100% height=1 background='<?=$skin_dir?>list/dot.gif' colspan=2>
	</td>
</tr>
