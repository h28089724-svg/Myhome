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
			if(file_exists("file/".$s_file_name1[$i])){
				@mkdir("file/".$reg_date,0777);
				//copy($file1[$i],"file/".$reg_date."/".$s_file_name1[$i]);
				move_uploaded_file($file1[$i],"file/".$reg_date."/".$s_file_name1[$i]);
				$file_name1[$i]="file/".$reg_date."/".$s_file_name1[$i];
				@chmod($file_name1[$i],0706);
				@chmod("file/".$reg_date,0707);
			}else{
				//copy($file1[$i],"file/".$s_file_name1[$i]);
				move_uploaded_file($file1[$i],"file/".$s_file_name1[$i]);
				$file_name1[$i]="file/".$s_file_name1[$i];
				@chmod($file_name1[$i],0706);
			}	

			if( $use_caption[$i] == 1){
				$caption_file1[$i]=eregi_replace("\\\\","\\",$caption_file1[$i]);
				$caption_s_file_name1[$i]=str_replace(" ","_",$caption_s_file_name1[$i]);
				$caption_s_file_name1[$i]=str_replace("\\'","_",$caption_s_file_name1[$i]);

				// 중복 파일이 있을 때
				if(file_exists("file/".$caption_s_file_name1[$i])){
					@mkdir("file/".$reg_date,0777);
					//copy($caption_file1[$i],"file/".$reg_date."/".$caption_s_file_name1[$i]);
					move_uploaded_file($caption_file1[$i],"file/".$reg_date."/".$caption_s_file_name1[$i]);
					$caption_file_name1[$i]="file/".$reg_date."/".$caption_s_file_name1[$i];
					@chmod($caption_file_name1[$i],0706);
					@chmod("file/".$reg_date,0707);
				}else{
					//copy($caption_file1[$i],"file/".$caption_s_file_name1[$i]);
					move_uploaded_file($caption_file1[$i],"file/".$caption_s_file_name1[$i]);
					$caption_file_name1[$i]="file/".$caption_s_file_name1[$i];
					@chmod($caption_file_name1[$i],0706);
				}	
			}

		$upload_ok[$i]="ok";
		}
	}
	$i++;
} // end of while
		
echo "<br>";
$success_count=0;
for( $i=0; $i<$max_write; $i++){
	if( $upload_ok[$i] != "ok") continue;

	if( isblank($subject[$i])) $subject[$i]=$s_file_name1[$i];
	if( isblank($context[$i])) $context[$i]="NONE";

	$subject[$i]=addslashes($subject[$i]);
	$context[$i]=addslashes($context[$i]);

	$upload_query="insert into sarangbi_music_".$table." values(
		'',
		'$subject[$i]',
		'$context[$i]',
		'$file_name1[$i]',
		'$s_file_name1[$i]',		
		0,
		NULL,
		1,
		1,
		'$category[$i]',
		'$use_caption[$i]',
		NULL,
		'$caption_file_name1[$i]',
		'$caption_s_file_name1[$i]')";

	mysql_query( $upload_query, $connect) or error(mysql_error());
	$success_count++;

	$subject[$i] = stripslashes($subject[$i]);
	$context[$i] = stripslashes($context[$i]);
	$subject[$i] = stripslashes($subject[$i]);
	$context[$i] = stripslashes($context[$i]);

	$subject[$i] = del_html($subject[$i]);
	$context[$i] = del_html($context[$i]);
	$context[$i] = str_replace("\r\n","<br>", $context[$i]);

	echo "
		<TABLE cellspacing=1 cellpadding=3 border=0 bgcolor=#DDE8FA  width=400>
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
<br>
<?=$success_count?> 개의 음악 파일을 업로드 했습니다.
<br><br>
<a href='<?=$PHP_SELF?>?mode=upload'><img src='admin/img/ok.gif' border=0></a>