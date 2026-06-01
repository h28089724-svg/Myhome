<? require "admin/login_check.php"; 

// DB 접속
$connect=db_conn();
$success_count=0;

echo "<br>";
for( $i=0; $i<$max_write; $i++){
	if( isblank($link[$i]))	continue;

	if( isblank($subject[$i])) $subject[$i]="MUSIC";
	if( isblank($context[$i])) $context[$i]="NONE";

	if( isblank($caption_link[$i])) $use_caption=0;
	else $use_caption=1;

	$subject[$i]=addslashes($subject[$i]);
	$context[$i]=addslashes($context[$i]);
	$link[$i]=addslashes($link[$i]);
	$caption_link[$i]=addslashes($caption_link[$i]);



	$upload_query="insert into sarangbi_music_".$table." values(
		'',
		'$subject[$i]',
		'$context[$i]',
		NULL,
		NULL,
		0,
		'$link[$i]',
		0,
		1,
		'$category[$i]',
		'$use_caption',
		'$caption_link[$i]',
		NULL,
		NULL)";

	mysql_query( $upload_query, $connect) or error(mysql_error());
	$success_count++;
	
	$subject[$i] = stripslashes($subject[$i]);
	$link[$i] = stripslashes($link[$i]);
	$caption_link[$i] = stripslashes($caption_link[$i]);
	$context[$i] = stripslashes($context[$i]);
	$subject[$i] = stripslashes($subject[$i]);
	$link[$i] = stripslashes($link[$i]);
	$caption_link[$i] = stripslashes($caption_link[$i]);
	$context[$i] = stripslashes($context[$i]);

	$subject[$i] = del_html($subject[$i]);
	$link[$i] = del_html($link[$i]);
	$caption_link[$i] = del_html($caption_link[$i]);

	$context[$i] = del_html($context[$i]);
	$context[$i] = str_replace("\r\n","<br>", $context[$i]);

	echo "
		<TABLE cellspacing=1 cellpadding=3 border=0 bgcolor=#DDE8FA  width=400>
		<tr><td width=50 align=center bgcolor=white>제목</td>
			<td width=350 align=left bgcolor=white>$subject[$i]</td></tr>
		<tr><td width=50 align=center bgcolor=white>주소</td>
			<td width=350 align=left bgcolor=white>$link[$i]</td></tr>
		<tr><td width=50 align=center bgcolor=white>가사</td>
			<td width=350 align=left bgcolor=white>$caption_link[$i]</td></tr>
		<tr><td width=50 align=center bgcolor=white>메모</td>
			<td width=350 align=left bgcolor=white>$context[$i]</td></tr>
		</table>";
}
db_close();
?>
<br>
<?=$success_count?> 개의 음악 파일을 링크 했습니다.
<br><br>
<a href='<?=$PHP_SELF?>?mode=link'><img src='admin/img/ok.gif' border=0></a>