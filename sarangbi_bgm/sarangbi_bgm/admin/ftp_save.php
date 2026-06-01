<? require "admin/login_check.php"; 

// 공백 체크
if( isblank($new_name))	error_msg("FTP 이름이 공백입니다.");
if( isblank($new_address)) error_msg("FTP 주소가 공백입니다.");
if( isblank($new_id))	error_msg("FTP 접속 아이디가 공백입니다.");
if( isblank($new_pw))	error_msg("FTP 암호가 공백입니다.");
if( isblank($new_port))	error_msg("FTP Port가 공백입니다.");

// 작은 따옴표 제거
$new_name=str_replace("\'","",$new_name);
$new_address=str_replace("\'","",$new_address);
$new_directory=str_replace("\'","",$new_directory);
$new_port=str_replace("\'","",$new_port);

// 큰 따옴표 제거
$new_name=str_replace("\\\"","",$new_name);
$new_address=str_replace("\\\"","",$new_address);
$new_directory=str_replace("\\\"","",$new_directory);
$new_port=str_replace("\\\"","",$new_port);

// 슬래쉬 추가
$new_name=addslashes(del_html($new_name));
$new_address=addslashes(del_html($new_address));
$new_directory=addslashes(del_html($new_directory));
//$new_link=addslashes(del_html($new_link));
$new_link=addslashes($new_link);
$new_id=addslashes(del_html($new_id));
$new_pw=addslashes(del_html($new_pw));
$new_port=addslashes(del_html($new_port));

// DB 접속
$connect=db_conn();

// Query 생성
if( $mode2 == 'add'){
	$write_query="insert into sarangbi_ftp_".$table." values(
				'',
				'$new_name',
				'$new_address',
				'$new_directory',
				'$new_link',
				'$new_id',
				'$new_pw',
				'$new_port')";
}else{
	$write_query="update sarangbi_ftp_".$table." set 
		name='$new_name',
		address='$new_address',
		directory='$new_directory',
		link='$new_link',
		id='$new_id',
		pw='$new_pw',
		port='$new_port'
		where no='$no'";
}

// Query 실행
mysql_query( $write_query, $connect) or error(mysql_error());

// 결과 출력
echo "<br><br><br><br><br><br><br><br><br><br>";
if( $mode2 == 'add')
	echo "FTP 설정을 추가 하였습니다.";
else
	echo "FTP 설정을 변경 하였습니다.";
echo "<br><br>";
echo "<a href='$PHP_SELF?mode=ftp_set'><img src='admin/img/ok.gif' border=0></a>";

// DB 접속 종료
db_close();
?>