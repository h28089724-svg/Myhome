<?
if( $step == '') $step=0;

function top()
{
	echo "<html>
			<head>
			<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>
			<title>사랑비 BGM DB 업그레이드</title>
			<STYLE type=text/css>

			A:link {COLOR: red; TEXT-DECORATION: none}
			A:visited {COLOR: red; TEXT-DECORATION: none}
			A:hover {COLOR: #086390; TEXT-DECORATION: none}
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
			</STYLE>
			</head>
			<body bgcolor=white>
			<center>
			<br>
			<TABLE cellspacing=1 cellpadding=0 border=0 bgcolor=black width=600>
			<tr>
			<td bgcolor=white>
			<TABLE cellspacing=0 cellpadding=0 border=0 bgcolor=white width=100%>
			<tr>
				<td width=100% height=70 background='admin/img/upgrade.jpg' colspan=3></td>
			</tr>
			<tr>
				<td width=25></td>
				<td height=200 valign=top align=left bgcolor=white width=550>";
}

function bottom()
{
		echo "</td>
<td width=25></td>
</tr>
<tr>
	<td width=100% height=22 background='admin/img/install2.jpg' colspan=3></td>
</tr>
</table>
</td></tr></table>
</center>
</body>
</html>";
	exit;
}


function first()
{
	global $PHP_SELF;
	top();
	echo "<br>";
	echo "<li> 본 프로그램은 사랑비 BGM ver 2.0 용 데이타베이스를 사랑비 BGM ver 2.1 용 데이타베이스로 업그레이드 합니다.";
	echo "<li> 업그레이드 준비가 되셨으면 아래 '확인' 버튼을 누르세요.";
	echo "<br><br><center><a href=$PHP_SELF?step=1>[[ 확 인 ]]</a>";
	bottom();
}

function not_found()
{
	top();
	echo "<br>";
	echo "<center><font color=red>** 오 류 **</font></center><br>";
	echo "<li> <font color=red>db_conn.php 파일을 찾을 수 없습니다.</font>";
	echo "<li> 본 파일을 기존의 사랑비 BGM ver 2.0 이 설치 되어 있는 디렉토리로 옮긴 후 다시 실행하세요.";
	bottom();
}

function error()
{
	echo "<br>";
	echo mysql_error();
}

function upgrade()
{
	top();
	include "db_conn.php";

	$update2 = "alter table sarangbi_setup_".$table." add num_list int(2) default '20' not null";

	$update3 = "alter table sarangbi_music_".$table." add use_caption int(1) default '0' not null";

	$update4 = "alter table sarangbi_music_".$table." add caption_url varchar(255) default ''";

	$update5 = "alter table sarangbi_music_".$table." add caption_filename varchar(255) default ''";

	$update6 = "alter table sarangbi_music_".$table." add caption_s_filename varchar(255) default ''";

	$connect = @mysql_connect($host_name, $user_name,$db_password) or error("DB 접속 에러가 발생 했습니다.");  
	@mysql_select_db($db_name, $connect ) or error("DB SELECT 에러가 발생 했습니다.");
	
	mysql_query( $update2, $connect) or error(mysql_error());
	mysql_query( $update3, $connect) or error(mysql_error());
	mysql_query( $update4, $connect) or error(mysql_error());
	mysql_query( $update5, $connect) or error(mysql_error());
	mysql_query( $update6, $connect) or error(mysql_error());

	if( $connet) mysql_close($connect);

	echo "<br><li> DB 업그레이드가 성공적으로 끝났습니다.";
	bottom();
}

if( $step == 1)
	if(!file_exists("db_conn.php")) $step=2;

switch( $step){
	case 0 : first(); break;
	case 1 : upgrade(); break;
	case 2 : not_found(); break;
}
?>	