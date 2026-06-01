<? require "admin/login_check.php"; 
$connect=db_conn();

$selected_no=explode(";",$selected_no);
$selected_count=count($selected_no)-1;


// 삭제한 노래 제목, 종류, DB성공, FILE 성공, 자막 파일 성공
function del_result_show( $tmp1, $tmp2, $tmp3, $tmp4, $tmp5)
{
	echo "<TABLE cellspacing=1 cellpadding=3 border=0 bgcolor='#00A2F7' width=300>
			<tr>
				<td align=center bgcolo='#00A2F7' width=80>
					<font color=white>노래 제목</font>
				</td>
				<td align=left bgcolor='white' height=18>
					&nbsp;$tmp1
				</td>
			</tr>
			<tr>
				<td align=center bgcolo='#00A2F7' width=80>
					<font color=white>등록 종류</font>
				</td>
				<td align=left bgcolor=white height=18>
					&nbsp;$tmp2
				</td>
			</tr>
			<tr>
				<td align=center bgcolo='#00A2F7' width=80>
					<font color=white>DB 삭제</font>
				</td>
				<td align=left bgcolor=white height=18>
					&nbsp;$tmp3
				</td>
			</tr>
			<tr>
				<td align=center bgcolo='#00A2F7' width=80>
					<font color=white>FILE 삭제</font>
				</td>
				<td align=left bgcolor=white height=18>
					&nbsp;$tmp4
				</td>
			</tr>
			<tr>
				<td align=center bgcolo='#00A2F7' width=80>
					<font color=white>가사 삭제</font>
				</td>
				<td align=left bgcolor=white height=18>
					&nbsp;$tmp5
				</td>
			</tr>
			</table>
		<TABLE cellspacing=0 cellpadding=0 border=0><tr height=2><td></td></tr></table>";
}
	
// FTP 에 접근하여 파일 삭제 (FTP 번호, 삭제할 파일명, 가사 유무, 가사 파일명, 삭제한 노래 제목)
function del_ftp_file( $tmp1, $tmp2, $tmp_uc, $tmp_ucf, $tmp3)
{
	global $table, $connect;

	$data = mysql_query( "select * from sarangbi_ftp_".$table." where no='$tmp1'", $connect) or error(mysql_error());

	$db_data=mysql_fetch_array($data);

	$name=stripslashes($db_data[name]);
	$name = del_html($name);

	$address=stripslashes($db_data[address]);
	$address = del_html($address);

	$directory=stripslashes($db_data[directory]);
	$directory = del_html($directory);

	$id=stripslashes($db_data[id]);
	$id = del_html($id);

	$pw=stripslashes($db_data[pw]);
	$pw = del_html($pw);

	$port=$db_data[port];

	if( $address != ''){
		$ftp = @ftp_connect( $address, $port);
		@ftp_login( $ftp, $id, $pw);
		if( $directory != '') @ftp_chdir( $ftp, $directory);
		if( @ftp_delete( $ftp, $tmp2))
			$tmp_success='OK'; 
		else
			$tmp_success='FTP 접근 OR 파일 삭제 에러';

		if( $tmp_uc == 1){
			if( @ftp_delete( $ftp, $tmp_ucf))
				$tmp_success2='OK'; 
			else
				$tmp_success2='FTP 접근 OR 파일 삭제 에러';
		}else
			$tmp_success2='';

			del_result_show( $tmp3, '외부 FTP', 'OK', $tmp_success, $tmp_success2);

		@ftp_quit($ftp);
	}else{
		del_result_show( $tmp3, '외부 FTP', 'OK', 'FTP 설정 없음','');
	}
}


echo "<br>삭제 결과<br><br>";
for( $i=0; $i<$selected_count; $i++){
	$query="select * from sarangbi_music_".$table." where no=".$selected_no[$i];
	$data = mysql_query( $query, $connect) or error(mysql_error());
	$db_data=mysql_fetch_array($data);

	$print_subject = $db_data[subject];
	$print_subject = stripslashes($print_subject);
	$print_subject = del_html($print_subject);

	$use_caption = $db_data[use_caption];

	// DB 삭제
	$delete_query = "delete from sarangbi_music_".$table." where no=".$selected_no[$i];
	mysql_query( $delete_query, $connect) or error(mysql_error());

	switch( $db_data[linkfile]){
		case 0:	del_result_show( $print_subject, '외부 링크', 'OK', '','OK');
				break;
		case 1:	if( @unlink($db_data[filename])) $tmp_success='OK';
				else $tmp_success='파일 삭제 에러';
				if( $use_caption == 1){
					if( @unlink($db_data[caption_filename])) $tmp_success2='OK';
					else $tmp_success2='파일 삭제 에러';
				}else
					$tmp_success2='';				
				del_result_show( $print_subject, '업로드 파일', 'OK', $tmp_success, $tmp_success2);
				break;
		case 2:	
				del_ftp_file( $db_data[ftp], $db_data[s_filename], $use_caption, $db_data[caption_s_filename], $print_subject);
				break;
	}
}
?>
		<form method=post action=<?=$PHP_SELF?>>
		<input type=hidden name=mode value='list'>
		<input type=hidden name=page value='<?=$page?>'>
		<input type=hidden name=select_page_num value='<?=$select_page_num?>'>
		<input type=hidden name=select_linkfile value='<?=$select_linkfile?>'>
		<input type=hidden name=select_category value='<?=$select_category?>'>
		<input type=hidden name=select_use value='<?=$select_use?>'>
		<input type=hidden name=search_string value='<?=$search_string?>'>
		<input type=image name='submit' src='admin/img/ok.gif'>
		</form>		

<?
db_close();
?>