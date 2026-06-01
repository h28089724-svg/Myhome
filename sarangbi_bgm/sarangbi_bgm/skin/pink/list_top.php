<?
///////////////////////////////////////////////////////////
/*
// BODY 의 윗부분에 출력될 내용을 적습니다.
// ========================================
// <?=$skin_dir?>			환경 변수(스킨 디렉토리의 경로)
//
// 사용할 수 있는 함수는 다음과 같습니다.
// <? category_select(); ?>	카테고리 리스트를 출력합니다.
// <? all_music_num(); ?>		현재 카테고리의 음악 개수
// 자바 스크립터 : only_this_category()  현재 카테고리의 음악 모두 듣기
*/
///////////////////////////////////////////////////////////
?>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 style="border: 0px solid black; margin: 0pt;">

<TABLE cellspacing=0 cellpadding=0 border=0 bgcolor=white width=100% height=100%>
<tr>
	<td height=20 width=100% align=center bgcolor=#FFBDCE>
		<img src="<?=$skin_dir?>list/musiclist_top.jpg" border=0>
	</td>
</tr>
<tr>
	<td align=left height=20>
		<br>
		&nbsp;&nbsp;&nbsp;&nbsp;<? category_select(); ?>&nbsp;<a href="javascript:only_this_category()">[ Listen this category ]</a>&nbsp;<? all_music_num(); ?> 개
	</td>
</tr>
<tr height=5><td height=5></td></tr>
<tr>
	<td align=center valign=top width=100%>
		<TABLE cellspacing=0 cellpadding=0 border=0 bgcolor=white width=90%>
