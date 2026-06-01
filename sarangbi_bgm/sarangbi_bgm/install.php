<?
function error_msg($message)
{
	echo "<center><br><br><font color=red>$message</font>";
	echo "<br><br><a href='javascript:history.go(-1)'><img src='admin/img/back.gif' border=0></a><br><br></center>";
	bottom();
	exit;
}

function isblank($str) {
	$temp=str_replace("　","",$str);
	$temp=str_replace("\n","",$temp);
	$temp=str_replace("&nbsp;","",$temp);
	$temp=str_replace(" ","",$temp);
	$check=0;
	for($i=0;$i<strlen($temp);$i++)
	{
		if($temp[$i]=="<") $check=1;
		if(!$check) $temp2.=$temp[$i];
		if($temp[$i]==">") $check=0;
	}
	if(eregi("[^[:space:]]",$temp2)) return 0;
	return 1;
}

function istable($str, $dbname) 
{
	$result = mysql_list_tables($dbname) or error(mysql_error(),"");

	$i=0;

	while ($i < mysql_num_rows($result))
	{
		if($str==mysql_tablename ($result, $i)) return 1;
		$i++;
	}
	return 0;
}

function top()
{
	echo "<body bgcolor=white>
<center>
<br>
<TABLE cellspacing=1 cellpadding=0 border=0 bgcolor=black width=600>
<tr>
<td bgcolor=white>
<TABLE cellspacing=0 cellpadding=0 border=0 bgcolor=white width=100%>
<tr>
	<td width=100% height=70 background='admin/img/install1.jpg' colspan=3></td>
</tr>
<tr>
	<td width=25></td>
	<td valign=top align=left bgcolor=white width=550>";
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
}

function step1()
{
	global $PHP_SELF;
	echo "<br><b><li>설치 하기 전에 확인하세요</b><br>
	1. 사랑비 BGM 을 설치하기 위해서는 <font color=red>MYSQL</font> 과 <font color=red>PHP</font> 를 지원해야 합니다.<br>
	2. 사랑비 BGM 을 설치하기 위한 <font color=red>디렉토리의 퍼미션이 707 혹은 777</font> 이어야 합니다.<br>
	<br>
	<b><li>만든 이유..</b><br>
	가장 큰 이유는 BGM 관리를 편리하게 하기 위해서입니다. PHP 와 Java Script 를 몰라도 SKIN 수정 및
	관리 도구에서 마우스 클릭 한번으로 원하는 디자인, 원하는 기능의 BGM 을 설치 할 수 있습니다.<br>
	관리 도구에서 게시판에 자료 올리듯 음악 파일의 업로드 혹은 다른 서버의 파일의 링크를 적기만 하면
	간단하게 배경 음악을 변경 할 수 있습니다.<br>
	아무쪼록 사랑비 BGM 으로 편리한 홈페이지 배경 음악 관리를 하시길 바랍니다. ^^<br>
	<br>
	<b><li>기능 (모든 기능을 나열하지 못합니다. 직접 사용해 보세요)</b><br>
	1. Play, Stop, 일시정지, 볼륨 조절, Random or Sequence 플레이 선택, Mute, 배경 음악 리스트 출력, 노래 제목 출력, 가사 등의 정보 출력, 총 연주 시간, 현재 연주 시간, 윈도우 상태창에 노래 제목 출력, 연주 상태를 알 수 있는 이퀄라이저, 기타등등...<br>
	2. 관리 도구를 통하여 웹에서 배경 음악 업로드, 링크, 삭제, 다른 서버에 음악 파일 올리기, 카테고리 설정, 연주 하고자 하는 배경 음악 선택, 버튼에 마우스 over 시 출력되는 문장 설정, 음악 리스트 정렬, 초기 볼륨 설정, 음악 리스트를 새창이 아닌 다른 프레임에 출력, 기타등등...<br>
	3. 스킨의 복사 및 수정으로 디자인 변경.<br>
	4. 위의 모든 사항을 간단하게 웹브라우저로 설정 할 수 있습니다.<br>
	<br>
	<b><li>License</b><br>
// ================================<< License(저작권) >>================================<br>
// SARANGBI BGM Player 2.1<br>
// Copyright 2001-2002 SARANGBI, Park Young hwal<br>
// Home  : http://www.sarangbi.net<br>
// email : java4u@sarangbi.net<br>
// 본 프로그램을 사용하는 것은 License 에 동의하는 것입니다.<br>
// 본 프로그램은 개인, 비영리단체, 영리단체에서 사용할 수 있습니다.<br>
// 본 프로그램은 영리를 목적으로 수정, 배포, 사용 할 수 없습니다.<br>
// 본 소스의 내용을 수정하여 사용할 수 있지만 수정자의 이름으로 재배포할 수 없습니다.<br>
// 본 소스를 수정할 경우를 포함한 어떠한 경우에도 저작권 부분은 수정, 삭제하면 안됩니다.<br>
// 본 소스를 본인의 동의 없이 배포할 수 없습니다. 배포를 원하시는 분은 email 주세요.<br>
// =====================================================================================<br>
	<br>
	<center>설치할 준비가 되었으면 NEXT 버튼을 누르세요.<br><br>
		<a href='$PHP_SELF?step=2'><img src='admin/img/next.gif' border=0></a>
	</center>
";
}

function step2()
{
	global $PHP_SELF;

	echo "<script language=javascript>
			function check_submit()
			{
				if( install.host_name.value == ''){
					alert(\"Mysql 이 설치된 HOSTNAME을 입력하세요.\");
					install.host_name.focus();
					return false;
				}

				if( install.user_name.value == ''){
					alert(\"Mysql DB 아이디를 입력하세요.\");
					install.user_name.focus();
					return false;
				}

				if( install.db_name.value == ''){
					alert(\"Mysql DB 이름을 입력하세요.\");
					install.db_name.focus();
					return false;
				}

				if( install.db_password.value == ''){
					alert(\"Mysql DB 암호를 입력하세요.\");
					install.db_password.focus();
					return false;
				}
				return true;
			}
			</script>
		
	
	
	
	<br><b><li> 사랑비 BGM 이 있는 디렉토리의 권한(퍼미션)을 777 혹은 707 로 변경해주세요.</b><br>
	<br>
	<b><li> 여러분 계정의 Mysql 정보를 아래에 적어 주세요.</b><br>
	<br>
	<form method=post action=$PHP_SELF name=install>
	<input type=hidden name=step value='3'>
	<center>
	<TABLE cellspacing=0 cellpadding=0 border=0 width=280>
	<tr>
		<td width=80 align=center>
		HOSTNAME
		</td>
		<td align=left>
		<input type=text name=host_name size=35 maxlength=255 value='localhost' class=input>
		</td>
	</tr>
	<tr>
		<td width=80 align=center>
		DB 아이디
		</td>
		<td align=left>
		<input type=text name=user_name size=35 maxlength=255 class=input>
		</td>
	</tr>
	<tr>
		<td width=80 align=center>
		DB 이름
		</td>
		<td align=left>
		<input type=text name=db_name size=35 maxlength=255 class=input>
		</td>
	</tr>
	<tr>
		<td width=80 align=center>
		DB 암호
		</td>
		<td align=left>
		<input type=text name=db_password size=35 maxlength=255 class=input>
		</td>
	</tr>
	</table>
	<br>
	위의 정보를 모두 적었으면 아래의 NEXT 버튼을 눌러 주세요.<br>
	<br>
	<input type=image name='submit' src='admin/img/next.gif' onclick='return check_submit();'>
	</form>
	";

}

function step3()
{
	global $PHP_SELF, $host_name, $user_name, $db_name, $db_password;

	if(isBlank($host_name)) error_msg("Mysql 이 설치된 HOSTNAME을 입력하세요");
	if(isBlank($user_name)) error_msg("Mysql DB 아이디를 입력하세요");
	if(isBlank($db_name)) error_msg("Mysql DB 이름을 입력하세요");
	if(isBlank($db_password)) error_msg("Mysql DB 암호를 입력하세요");


	echo "<br>";

	// 퍼미션 체크
	if(fileperms(".")==16839||fileperms(".")==16895)
		echo "<li> 퍼미션 설정 체크 - OK";
	else
		error_msg("사랑비 BGM 이 있는 디렉토리의 권한(퍼미션)이 707 혹은 777 이 아닙니다.<br> 퍼미션을 조절 해 주세요");

	include "schema.php";

	// DB 연결
	$connect = @mysql_connect($host_name,$user_name,$db_password) or error_msg("Mysql DB 연결 실패. DB 정보를 다시 적으세요.");

	mysql_select_db($db_name, $connect ) or error_msg("Mysql DB 선택 실패. Mysql DB 이름을 다시 적으세요.");

	// 테이블 생성
	if(!isTable("sarangbi_setup_".$table ,$db_name)) @mysql_query($sarangbi_bgm_query1, $connect) or error_msg("테이블 생성 실패");
	else echo "<li> 설정 정보를 저장할 테이블이 이미 존재합니다.<br>";

	if(!isTable("sarangbi_category_".$table ,$db_name)) @mysql_query($sarangbi_bgm_query2, $connect) or error_msg("테이블 생성 실패");
	else echo "<li> 카테고리 정보를 저장할 테이블이 이미 존재합니다.<br>";

	if(!isTable("sarangbi_music_".$table ,$db_name)) @mysql_query($sarangbi_bgm_query3, $connect) or error_msg("테이블 생성 실패");
	else echo "<li> 음악 정보를 정보를 저장할 테이블이 이미 존재합니다.<br>";

	if(!isTable("sarangbi_ftp_".$table ,$db_name)) @mysql_query($sarangbi_bgm_query4, $connect) or error_msg("테이블 생성 실패");
	else echo "<li> FTP 정보를 저장할 테이블이 이미 존재합니다.<br>";

	// 초기값 넣기 
	@mysql_query($sarangbi_bgm_query5, $connect);
	@mysql_query($sarangbi_bgm_query6, $connect);
	

	$file=@fopen("db_conn.php","w") or error_msg("파일 생성 실패<br>사랑비 BGM 이 있는 디렉토리의 권한을 707 혹은 777 로 해주세요");

	@fwrite($file,"<?\n\$table=\"$table\";\n\$host_name=\"$host_name\";\n\$user_name=\"$user_name\";\n\$db_name=\"$db_name\";\n\$db_password=\"$db_password\";\n?>\n") or error_msg("파일 생성 실패<br>사랑비 BGM 이 있는 디렉토리의 권한을 707 혹은 777 로 해주세요");

	@fclose($file);
	@mkdir("file",0707);
	@mkdir("temp_ftp",0707);
	@chmod("file",0707);
	@chmod("temp_ftp",0707);
	@chmod("db_conn.php",0707);

	echo "<br><br>
		<li> <b>사랑비 BGM 설치가 완료 되었습니다.</b>
		<li> 사랑비 BGM 관리 도구의 초기 <font color=red>암호는 sarangbi</font> 입니다. 로그인 하신 후 꼭 변경하세요.
		<li> 사랑비 BGM 의 자세한 사용 방법은 <a href='http://www.sarangbi.net' target=_blank>http://www.sarangbi.net<a/> 에 있습니다.
		<li> 사랑비 BGM 실행 하기 ==> <a href='sarangbi_bgm.php'>sarangbi_bgm.php</a><br><br>";

	echo "<li> <b>사랑비 BGM 을 홈페이지에 넣는 방법</b><br>
		1. frame 을 분리하여 넣는 방법<br>
		&lt;HTML&gt;<br>
&lt;head&gt;<br>
&lt;/head&gt;<br>
&lt;frameset rows=\"*,20\" frameborder=0 frame=0 border=0&gt;<br>
&nbsp;&nbsp;&nbsp;&lt;frame src=\"홈페이지 문서\" scrolling=\"auto\" marginwidth=0&gt;<br>
&nbsp;&nbsp;&nbsp;&lt;frame src=\"BGM이설치된경로/sarangbi_bgm.php\" scrolling=\"no\" marginwidth=0&gt;<br>
&lt;/frameset&gt;<br>
&lt;/HTML&gt;<br><br>
		2. iframe 을 사용하는 방법<br>
		&lt;iframe src=\"BGM이설치된경로/sarangbi_bgm.php\" frameborder=0 bordercolor=black height=20 width=400 scrolling=no marginheight=0 marginwidth=0&gt;<br>
     inline frame을 볼 수 있는 웹브라우저가 필요합니다. <br>
&lt;/iframe&gt;<br><br>
		<li> <b>사랑비 BGM 의 디자인을 변경하는 방법</b><br>
		사랑비 BGM 의 디자인은 skin 에서 변경 할 수 있습니다. 자세한 사항은 사랑비닷넷 홈페이지를 참고하세요.";

}

?>
<html>
<head>
<title>사랑비 BGM 설치</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<meta name="Description" content="사랑비 BGM, SARANGBI BGM">
<meta name="classification" content="사랑비 BGM, SARANGBI BGM">
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

.input {BACKGROUND-COLOR: #F7F7F7; BORDER-LEFT: #777777 1px solid; BORDER-TOP: #444444 1px solid; BORDER-RIGHT: #FFFFFF 1px solid; BORDER-BOTTOM: #FFFFFF 1px solid; COLOR: #000000; FONT-FAMILY: Tahoma; FONT-SIZE: 9pt}
</style>
</head>
<? top();
if( $step == '') $step=1;

switch( $step){
	case 1	: step1(); break;
	case 2	: step2(); break;
	case 3	: step3(); break;
}
bottom();
?>
