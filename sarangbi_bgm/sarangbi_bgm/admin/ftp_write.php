<? require "admin/login_check.php"; 

// DB 접속
$connect=db_conn();
$success_count=0;

$upload_limit_size = ConvertByte(get_cfg_var("upload_max_filesize"));

$temp_filesize = get_cfg_var("upload_max_filesize");

if( $upload_limit_size == 0 ){
	$upload_limit_size=2097152;
}

$reg_date=time();

// 업로드 임시 디렉토리의 지정. 지정이 안되어 있으면 /tmp 로 지정
//if(get_cfg_var("upload_tmp_dir")) $temp_dir=get_cfg_var("upload_tmp_dir");
//else $temp_dir="/tmp";

$upload_success=0;
$i=0;
while($i < $max_write){
	$upload_ok[$i]="no";
	$use_caption[$i]=0;
	if($file1_size[$i]>0 && $file1[$i]){
		//$file1[$i]=eregi_replace($temp_dir,"",$file1[$i]);
		//$file1[$i]=$temp_dir.$file1[$i];
		$file1_size[$i]=filesize($file1[$i]);

		if( $caption_file1_size[$i]>0 && $caption_file1[$i]) $use_caption[$i]=1;
		else $use_caption[$i]=0;

		if( $use_caption[$i] == 1){
			//$caption_file1[$i]=eregi_replace($temp_dir,"",$caption_file1[$i]);
			//$caption_file1[$i]=$temp_dir.$caption_file1[$i];
			$caption_file1_size[$i]=filesize($caption_file1[$i]);
		}

		if( $use_caption[$i] == 1)
			if( $file1_name[$i] == $caption_file1_name[$i]){
				echo "가사 파일명이 음악 파일명과 같아서 가사는 등록 할 수 없습니다.";
				$use_caption[$i]=0;
		    }

		// 같은 파일 체크
		if( $i >= 1){
			if( same_file_check($file1_name, $i)){
				echo "같은 파일은 등록할 수 없습니다.<br>
					파일 : $file1_name[$i]<br>";
				$i++;
				continue;
			}
		}

		if( $i >= 1){
			if( $use_caption[$i] == 1)
				if( same_file_check($caption_file1_name, $i)){
					echo "같은 파일은 등록할 수 없습니다.<br>
						파일 : $caption_file1_name[$i]<br>";
					$i++;
					continue;
				}
		}

		if( $upload_limit_size<$file1_size[$i]){
			echo "파일 사이즈가 너무 큽니다.<br>
				파일 : $file1_name[$i]<br>";

			$i++;
			continue;
		}

		if( $use_caption[$i] == 1){
			if( $upload_limit_size<$caption_file1_size[$i]){
				echo "가사 파일 사이즈가 너무 큽니다.<br>
					파일 : $caption_file1_name[$i]<br>";

				$i++;
				continue;
			}
		}

		if($file1_size[$i]>0){
			$s_file_name1[$i]=$file1_name[$i];
			if( $use_caption[$i] == 1){
				$caption_s_file_name1[$i] = $caption_file1_name[$i];
		
				if(eregi("\.inc",$caption_s_file_name1[$i])||eregi("\.phtm",$caption_s_file_name1[$i])||eregi("\.htm",$caption_s_file_name1[$i])||eregi("\.shtm",$caption_s_file_name1[$i])||eregi("\.ztx",$caption_s_file_name1[$i])||eregi("\.php",$caption_s_file_name1[$i])||eregi("\.dot",$caption_s_file_name1[$i])||eregi("\.asp",$caption_s_file_name1[$i])||eregi("\.cgi",$caption_s_file_name1[$i])||eregi("\.pl",$caption_s_file_name1[$i])){
				echo "Html, PHP 관련파일은 업로드할수 없습니다<br>
					파일 : $caption_s_file_name1[$i]<br>";

				$use_caption[$i] = 0;
				}
			}
			if(eregi("\.inc",$s_file_name1[$i])||eregi("\.phtm",$s_file_name1[$i])||eregi("\.htm",$s_file_name1[$i])||eregi("\.shtm",$s_file_name1[$i])||eregi("\.ztx",$s_file_name1[$i])||eregi("\.php",$s_file_name1[$i])||eregi("\.dot",$s_file_name1[$i])||eregi("\.asp",$s_file_name1[$i])||eregi("\.cgi",$s_file_name1[$i])||eregi("\.pl",$s_file_name1[$i])){
				echo "Html, PHP 관련파일은 업로드할수 없습니다<br>
					파일 : $s_file_name1[$i]<br>";

				$i++;
				continue;
			}

			$file1[$i]=eregi_replace("\\\\","\\",$file1[$i]);
			$s_file_name1[$i]=str_replace(" ","_",$s_file_name1[$i]);
			$s_file_name1[$i]=str_replace("\\'","_",$s_file_name1[$i]);

			// 중복 파일이 있을 때
			if(file_exists("temp_ftp/".$s_file_name1[$i])){
				@mkdir("temp_ftp/".$reg_date,0777);
				//copy($file1[$i],"temp_ftp/".$reg_date."/".$s_file_name1[$i]);
				move_uploaded_file($file1[$i],"temp_ftp/".$reg_date."/".$s_file_name1[$i]);
				$file_name1[$i]="temp_ftp/".$reg_date."/".$s_file_name1[$i];
				@chmod($file_name1[$i],0706);
				@chmod("temp_ftp/".$reg_date,0707);
			}else{
				//copy($file1[$i],"temp_ftp/".$s_file_name1[$i]);
				move_uploaded_file($file1[$i],"temp_ftp/".$s_file_name1[$i]);
				$file_name1[$i]="temp_ftp/".$s_file_name1[$i];
				@chmod($file_name1[$i],0706);
			}	

			if( $use_caption[$i] == 1){
				$caption_file1[$i]=eregi_replace("\\\\","\\",$caption_file1[$i]);
				$caption_s_file_name1[$i]=str_replace(" ","_",$caption_s_file_name1[$i]);
				$caption_s_file_name1[$i]=str_replace("\\'","_",$caption_s_file_name1[$i]);

				// 중복 파일이 있을 때
				if(file_exists("temp_ftp/".$caption_s_file_name1[$i])){
					@mkdir("temp_ftp/".$reg_date,0777);
					//copy($caption_file1[$i],"temp_ftp/".$reg_date."/".$caption_s_file_name1[$i]);
					move_uploaded_file($caption_file1[$i],"temp_ftp/".$reg_date."/".$caption_s_file_name1[$i]);
					$caption_file_name1[$i]="temp_ftp/".$reg_date."/".$caption_s_file_name1[$i];
					@chmod($caption_file_name1[$i],0706);
					@chmod("temp_ftp/".$reg_date,0707);
				}else{
					//copy($caption_file1[$i],"temp_ftp/".$caption_s_file_name1[$i]);
					move_uploaded_file($caption_file1[$i],"temp_ftp/".$caption_s_file_name1[$i]);
					$caption_file_name1[$i]="temp_ftp/".$caption_s_file_name1[$i];
					@chmod($caption_file_name1[$i],0706);
				}	
			}

		$upload_ok[$i]="ok";
		$upload_success++;
		}
	}
	$i++;
} // end of while

if( $upload_success == 0) error_msg("업로드 한 파일이 없습니다.");
echo "<br><br>";
echo "$upload_success 개의 File 을 업로드 하였습니다.<br>";
echo "FTP 접속을 위한 준비를 하고 있습니다.<br>";
echo "접속하는 서버 정보는 아래와 같습니다.<br><br>";

// FTP 접속하여 저장 하기
$data = mysql_query( "select * from sarangbi_ftp_".$table." where no='$ftp_no'", $connect) or error(mysql_error());

$db_data=mysql_fetch_array($data);

$ftp_name=stripslashes($db_data[name]);
$ftp_name = del_html($ftp_name);

$ftp_address=stripslashes($db_data[address]);
$ftp_address = del_html($ftp_address);

$ftp_directory=stripslashes($db_data[directory]);
$ftp_directory=del_html($ftp_directory);

$ftp_link=stripslashes($db_data[link]);
$ftp_link=del_html($ftp_link);

$ftp_link2=$db_data[link];

$ftp_id=stripslashes($db_data[id]);
$ftp_id=del_html($ftp_id);

$ftp_pw=stripslashes($db_data[pw]);
$ftp_pw=del_html($ftp_pw);

$ftp_port=$db_data[port];

echo "
<TABLE cellspacing=1 cellpadding=3 border=0 bgcolor=#DDE8FA  width=400>
<tr><td width=80 align=center bgcolor=white>FTP 이름</td>
	<td width=320 align=left bgcolor=white>$ftp_name ($ftp_id)</td></tr>
<tr><td width=80 align=center bgcolor=white>FTP 주소</td>
	<td width=320 align=left bgcolor=white>$ftp_address/$ftp_directory ($ftp_port)</td></tr>
<tr><td width=80 align=center bgcolor=white>접속 경로</td>
	<td width=320 align=left bgcolor=white>$ftp_link</td></tr>
</table><br>";

// FTP 접속
$ftp_success=true;
if( !($ftp = @ftp_connect( $ftp_address, $port))){
	$ftp_success=false;
	echo "FTP 연결 실패<br>";
}
if( !@ftp_login( $ftp, $ftp_id, $ftp_pw)){
	$ftp_success=false;
	echo "Login 실패<br>";
}

if( $ftp_directory != ''){
	if( !@ftp_chdir( $ftp, $ftp_directory)){
		$ftp_success=false;
		echo "디렉토리 접근 실패<br>";
	}
}

// FTP 로 파일 전송
if( $ftp_success == true){
	echo "FTP 접속 성공했습니다. 파일을 전송합니다.<br><br>";
	for( $i=0; $i<$max_write; $i++){
		$ftp_ok[$i]="no";
		if( $upload_ok[$i] != "ok") continue;

		echo "현재 전송 중인 파일 : $s_file_name1[$i]";
		
		if( @ftp_put( $ftp, $s_file_name1[$i], $file_name1[$i], FTP_BINARY)){
			$link3[$i]=$ftp_link2."/".$s_file_name1[$i];
			$ftp_ok[$i]="ok";
		}

		if( $ftp_ok[$i] == "ok") echo "&nbsp;- 성공<br>";

		if( $use_caption[$i] == 1){
			echo "<br>현재 전송 중인 파일 : $caption_s_file_name1[$i]";
		
			if( @ftp_put( $ftp, $caption_s_file_name1[$i], $caption_file_name1[$i], FTP_BINARY)){
				$caption_link3[$i]=$ftp_link2."/".$caption_s_file_name1[$i];
				$caption_ftp_ok[$i]="ok";
			}

			if( $caption_ftp_ok[$i] == "ok") echo "&nbsp;- 성공<br>";
		}
	}
}

//연결 종료
@ftp_quit($ftp);

// 임시 디렉토리로 업로드 한 파일 삭제
for( $i=0; $i<$max_write; $i++){
	if( $upload_ok[$i] == "ok") @unlink( $file_name1[$i]);
	if( $use_caption[$i] == 1) @unlink( $caption_file_name1[$i]);
}

if( $ftp_success != true){
	echo "<br><br><font color=red>FTP 접속을 실패 하였습니다.</font>";
	echo "<br><br><a href='$PHP_SELF?mode=ftp_upload'><img src='admin/img/ok.gif' border=0></a>";
	include "admin/tail.php";
	exit;	
}

echo "<br>";
// DB 기록 하기
$success_count=0;
for( $i=0; $i<$max_write; $i++){
	if( $ftp_ok[$i] != "ok") continue;

	if( isblank($subject[$i])) $subject[$i]=$s_file_name1[$i];
	if( isblank($context[$i])) $context[$i]="NONE";

	$subject[$i]=addslashes($subject[$i]);
	$context[$i]=addslashes($context[$i]);
	
	$upload_query="insert into sarangbi_music_".$table." values(
		'',
		'$subject[$i]',
		'$context[$i]',
		NULL,
		'$s_file_name1[$i]',
		'$ftp_no',		
		'$link3[$i]',
		2,
		1,
		'$category[$i]',
		'$use_caption[$i]',
		'$caption_link3[$i]',
		NULL,
		'$caption_s_file_name1[$i]')";

	mysql_query( $upload_query, $connect) or error(mysql_error());
	$success_count++;

	$context[$i] = str_replace("\r\n","<br>", $context[$i]);

	echo "		<TABLE cellspacing=1 cellpadding=3 border=0 bgcolor=#DDE8FA  width=400>
	<tr><td width=50 align=center bgcolor=white>제목</td>
		<td width=350 align=left bgcolor=white>$subject[$i]</td></tr>
	<tr><td width=50 align=center bgcolor=white>파일명</td>
		<td width=350 align=left bgcolor=white>$s_file_name1[$i]</td></tr>";
		if( $use_caption[$i] == 1){
			echo "<tr><td width=50 align=center bgcolor=white>가사</td>
			<td width=350 align=left bgcolor=white>$caption_s_file_name1[$i]</td></tr>";
		}
		echo "<tr><td width=50 align=center bgcolor=white>메모</td>
		<td width=350 align=left bgcolor=white>$context[$i]</td></tr>
	</table>";
}
db_close();

?>
<br><br>
<?=$ftp_name?>에 <?=$success_count?> 개의 음악 파일을 <?=$ftp_name?> 으로 전송 하였습니다.
<br><br>
<a href='<?=$PHP_SELF?>?mode=ftp_upload'><img src='admin/img/ok.gif' border=0></a>