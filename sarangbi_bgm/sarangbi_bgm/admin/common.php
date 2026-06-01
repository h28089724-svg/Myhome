<?
//====================================================================
// DB 관련 함수
//====================================================================

// DB 접속 함수
function db_conn()
{
	global $connect, $table, $host_name, $user_name, $db_name, $db_password;

	if(!$connect) $connect = @mysql_connect($host_name, $user_name,$db_password) or error("DB 접속 에러가 발생 했습니다.");  
	@mysql_select_db($db_name, $connect ) or error("DB SELECT 에러가 발생 했습니다.");

	return $connect;
}

// DB 접속 종료 함수
function db_close()
{
	global $connect;

	if( $connet) mysql_close($connect);
}

// ERROR 출력 함수 (DB 에러 출력)
function error($message)
{
	echo "<br><br><br><font color=red>** ERROR 가 발생 했습니다.</font><br><br>
	$message";
	include "admin/tail.php";
	exit;
}

// 일반적인 에러 출력 (Back 버튼 출력)
function error_msg($message)
{
	echo "<br><br><br><br><br><br><br><br><br><br><font color=red>$message</font>";
	echo "<br><br><a href='javascript:history.go(-1)'><img src='admin/img/ok.gif' border=0></a>";
	include "admin/tail.php";
	exit;
}

//====================================================================
// 일반 함수
//====================================================================

// 페이지 이동
function movepage($url)
{
	global $connect;
	db_close();
	echo"<meta http-equiv=\"refresh\" content=\"0; url=$url\">";
	exit;
}

// HTML 태그 제거 함수
function del_html( $str )
{
	$str = str_replace( ">", "&gt;",$str );
	$str = str_replace( "<", "&lt;",$str );
	$str = str_replace( "\"", "&quot;",$str );
	return $str;
}

// 빈 문자열 검사. (빈 문자열일 경우 1리턴)
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

// 킬로바이트, 메가바이트를 바이트 단위로 변환
function ConvertByte($size)
{
	if( strstr($size, 'K')){
		$size=$size*1024;
		return $size;
	}else if( strstr($size, 'M')){
		$size=$size*1024*1024;
		return $size;
	}
	return $size;
}

// 같은 파일이 있으면 true 를 리턴, 파일이 다르면 false 를 리턴.
function same_file_check( $file1_name, $index)
{
	if( $index >= 1){
		$i=0;
		while( $i < $index){
			if( $file1_name[$i] == $file1_name[$index])
				return true;
		$i++;
		}
	}
	return false;
}

?>