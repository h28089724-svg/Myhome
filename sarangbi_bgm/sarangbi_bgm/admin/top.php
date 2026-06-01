<!--
// ================================<< License(저작권) >>================================
// SARANGBI BGM Player 2.0
// Copyright 2001-2002 SARANGBI, Park Young hwal
// Home  : http://www.sarangbi.net
// email : java4u@sarangbi.net
// 본 프로그램을 사용하는 것은 License 에 동의하는 것입니다.
// 본 프로그램은 개인, 비영리단체, 영리단체에서 사용할 수 있습니다.
// 본 프로그램은 영리를 목적으로 수정, 배포, 사용 할 수 없습니다.
// 본 소스의 내용을 수정하여 사용할 수 있지만 수정자의 이름으로 재배포할 수 없습니다.
// 본 소스를 수정할 경우를 포함한 어떠한 경우에도 저작권 부분은 수정, 삭제하면 안됩니다.
// 본 소스를 본인의 동의 없이 배포할 수 없습니다. 배포를 원하시는 분은 email 주세요.
// =====================================================================================
//-->
<html>
<head>
<TITLE>사랑비 BGM 관리 도구</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<meta name="author" content="사랑비 BGM">
<META NAME="Keywords" CONTENT="사랑비 BGM">
<META NAME="Description" CONTENT="사랑비 BGM">
<meta name="classification" content="사랑비 BGM">
<!-- 스타일 시트 //-->
<STYLE type=text/css>

A:link {COLOR: blue; TEXT-DECORATION: none}
A:visited {COLOR: blue; TEXT-DECORATION: none}
A:hover {COLOR: red; TEXT-DECORATION: none}
A:active {COLOR: black; TEXT-DECORATION: none}

body {
font-size:9pt; font-family:돋움; FONT-WEIGHT: 200;
background:#FFFFFF; overflow:auto;
scrollbar-face-color:#FFFFFF;
scrollbar-highlight-color: #000000;
scrollbar-3dlight-color: #FFFFFF;
scrollbar-shadow-color: #000000;
scrollbar-darkshadow-color: #FFFFFF;
scrollbar-track-color: #FFFFFF;
scrollbar-arrow-color: #000000}

table, td, tr{
font-size:9pt; font-family:돋움;  FONT-WEIGHT: 200}
 
.select1 { font-size:9pt; font-family:돋움; line-height:100%}
.input1 {border-width:0 0 1; border-color:#94AAD6; background:; font-size:9pt; font-family:돋움; line-height:100%}
.input2 {BACKGROUND-COLOR: #F7F7F7; BORDER-LEFT: #777777 1px solid; BORDER-TOP: #444444 1px solid; BORDER-RIGHT: #FFFFFF 1px solid; BORDER-BOTTOM: #FFFFFF 1px solid; COLOR: #000000; FONT-FAMILY: Tahoma; FONT-SIZE: 9pt}
.input3 {border-width:0 0 1; border-color:#000000; background:; font-size:9pt; font-family:돋움; line-height:100%}
.button1 {BACKGROUND-COLOR: #DDDDDD; BORDER-LEFT: #FFFFFF 1px solid; BORDER-TOP: #FFFFFF 1px solid; BORDER-RIGHT: #666666 1px solid; BORDER-BOTTOM: #666666 1px solid; COLOR: #000000; FONT-FAMILY: Tahoma; FONT-SIZE: 11px; cursor:hand}
.text1 {BACKGROUND-COLOR: #F7F7F7; BORDER-LEFT: #777777 1px solid; BORDER-TOP: #444444 1px solid; BORDER-RIGHT: #FFFFFF 1px solid; BORDER-BOTTOM: #FFFFFF 1px solid; COLOR: #000000; FONT-FAMILY: Tahoma; FONT-SIZE: 9pt; overflow-x:hidden; overflow-y:auto}
.tooltable {border:solid 1 navy}
</STYLE>
</head>
<center>
<BODY topmargin='0'  leftmargin='0' marginwidth='0' marginheight='0' style="border: 0px solid black; margin: 0pt;">
<TABLE cellspacing=0 cellpadding=0 border=0 width=100% height=100%>
<tr>
	<td width=17 bgcolor="#008CD6">
	</td>
	<td align=center height=48 bgcolor="#008CD6">
		<TABLE cellspacing=0 cellpadding=0 border=0 width=100% height=100%>
		<tr>
		<td width=100></td>
		<td align=center height=48>
			<a href="<?=$PHP_SELF?>?mode=main"><img src='admin/img/top.jpg' border=0></a>
		</td>
		<td width=100 align=right valign=bottom><img src='admin/img/ver.gif' border=0></td>
		</tr>
		</table>
	</td>
	<td width=17 bgcolor="#FFB401">
	</td>
</tr>
<tr>
	<td height=1 bgcolor=white colspan=3></td>
</tr>
<tr>
	<td align=center valign=top colspan=3>