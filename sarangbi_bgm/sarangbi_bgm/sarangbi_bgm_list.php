<!--
// ================================<< License(저작권) >>================================
// SARANGBI BGM Player 2.1
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
<?
///////////////////////////////////////////////////////////
// 사랑비 BGM List 출력
// ================================
// * 주 의 * 이 파일은 수정 하지 마세요.
// 모든 설정과 디자인은 스킨 파일에서 할 수 있습니다.
///////////////////////////////////////////////////////////
global $category_num;
if( $category_num == '') $category_num=-1;

// 에러 출력 함수
function error($message)
{
	echo "<br><font color=red>$message</font>";
	exit;
}

// db_conn.php 파일이 있는지 체크
if(!file_exists("db_conn.php")){
 echo"<meta http-equiv=\"refresh\" content=\"0; url=install.php\">";
 exit;
}

require "db_conn.php";
$connect = @mysql_connect($host_name, $user_name,$db_password) or error("DB 접속 에러가 발생 했습니다.");  
@mysql_select_db($db_name, $connect ) or error("DB SELECT 에러가 발생 했습니다.");

$data = mysql_query( "select * from sarangbi_setup_".$table." where no=1", $connect) or error(mysql_error());

$db_data=mysql_fetch_array($data);

$db_data[bgm_frame]=stripslashes($db_data[bgm_frame]);

if( $invar_use_frame == '')
	$invar_use_frame=$db_data[use_frame];					// 프레임 사용

// 사랑비 BGM 이 설치된 프레임
if( $invar_use_frame == 1){
	if( $invar_bgm_frame == '') $invar_bgm_frame=$db_data[bgm_frame];
}else{
	if( $invar_bgm_frame == '')	$invar_bgm_frame='opener';
}

if( $use_category == '')
	$use_category=$db_data[use_category];	// 카테고리 사용

if( $use_check == '')
	$use_check=$db_data[use_user];			// 체크 박스 사용

if( $skin_dir == '')
	$skin_dir="skin/".$db_data[skin_dir]."/";	// 스킨 디렉토리 읽어 옮

if( $from_db_max_music_num == '')				// BGM List 출력 노래 개수 읽어 옮
	$from_db_max_music_num=$db_data[num_list];

// 개수를 못 받으면 DB 에서 읽음
if( $use_category == 0 || $category_num == -1 || $list_music_num ==''){
	if( $list_music_num == ''){
		$query="select count(*) from sarangbi_music_".$table." where use_this=1";

	$category_num=-1;

	$db_data = mysql_fetch_array( mysql_query($query, $connect));
	$list_music_num = $db_data["count(*)"];
	}
}

$max_music_num=$from_db_max_music_num;

if( $page_num == '') $page_num=1;

if (($list_music_num - ($page_num-1)*$max_music_num) < $max_music_num) 
	$max_music_num=$list_music_num - ($page_num-1)*$max_music_num;

if( $connet) mysql_close($connect);

///////////////////////////////////////////////////////////
//                       함수
///////////////////////////////////////////////////////////

// 페이지 번호 출력 함수
function print_page()
{
	global $page_num, $list_music_num, $use_category, $invar_use_frame, $invar_bgm_frame, $use_check, $skin_dir, $from_db_max_music_num, $category_num;

	$all_page_num = $list_music_num/$from_db_max_music_num + 1;

	for( $i=1; $i < $all_page_num; $i++){
		if( $i == $page_num)
			echo "$i";
		else
			echo "<a href=$PHP_SELF?use_category=$use_category&invar_use_frame=$invar_use_frame&invar_bgm_frame=$invar_bgm_frame&use_check=$use_check&skin_dir=$skin_dir&category_num=$category_num&page_num=$i&list_music_num=$list_music_num&from_db_max_music_num=$from_db_max_music_num>[$i]</a>";
	}
}

// 카테고리 이름 출력 함수
function print_category_name()
{

}

// 모든 노래 개수
function all_music_num()
{
	global $list_music_num;
	echo $list_music_num;
}

// 노래 제목 출력 함수
function show_list()
{
	global $invar_use_frame, $invar_bgm_frame, $category_num;

		echo "<script language=javascript>
		var temp_str;

		if( $category_num == -1 ||( $category_num >= 0 && $category_num < $invar_bgm_frame.invar_category_num)){
			if( list_current_music >= 0){
				temp_str=$invar_bgm_frame.invar_MusicTitle[list_current_music];
				temp_str=stringReplace2( temp_str);
				document.write(\"<a href='javascript:$invar_bgm_frame.private_PlayMusic\");
				document.write(\"(\");
				document.write(list_current_music);
				document.write(\")'>\");
				document.write(temp_str);
				document.write(\"</a>\");
			}else{
				document.write(\"<font color=red>Append Music. Reload BGM frame.</font>\");
			}
		}
		</script>";

}


// 체크 이미지 출력 함수
function show_check()
{
	global $invar_bgm_frame, $category_num, $skin_dir, $img_checked, $img_unchecked, $list_num, $use_check;

	if( $use_check ){
		echo "<script language=javascript>
		var temp;
		temp = \"checked_img\" + list_current_music;

		if( $category_num == -1 ||( $category_num >= 0 && $category_num < $invar_bgm_frame.invar_category_num)){
			if( list_current_music >= 0){
				document.write(\"<img src='$skin_dir$img_checked' id='check_img_\");
				document.write($list_num);
				document.write(\"' style='cursor:hand;' onclick=change_check_$list_num('\");
				document.write(list_current_music);
				document.write(\"')>\");
			}else{
				document.write(\"<img src='$skin_dir$img_unchecked' id='check_img_\");
				document.write($list_num);
				document.write(\"'>\");
			}
		}

		function change_check_$list_num(num){ 
			if( $invar_bgm_frame.invar_MusicUse[num] == true)
				$invar_bgm_frame.invar_MusicUse[num] = false;
			else
				$invar_bgm_frame.invar_MusicUse[num] = true;
			change_img_$list_num(num);
		}

		function change_img_$list_num(num){
			if( $invar_bgm_frame.invar_MusicUse[num] == true)
				check_img_$list_num.src=\"$skin_dir$img_checked\";
			else
				check_img_$list_num.src=\"$skin_dir$img_unchecked\";
		}

		change_img_$list_num(list_current_music);
		</script>";
	}


}

function category_select()
{
	global $invar_bgm_frame, $category_num, $PHP_SELF, $use_category, $invar_use_frame, $use_check, $skin_dir, $from_db_max_music_num;
	
	if( $use_category == 1){
		echo "<script language=javascript>
		var tmp;
		tmp=$category_num;

		document.write(\"<select name=music_category onchange=music_category_change()>\");
		document.write(\"<option value='-1'>모두 보기</option>\");
		for( i=0; i < $invar_bgm_frame.invar_category_num; i++){
			document.write(\"<option value='\");
			document.write(i);
			document.write(\"'\");
			if( tmp == i) document.write(\" selected\");
			document.write(\">\");
			document.write($invar_bgm_frame.invar_category_name[i]);
			document.write(\"</option>\");
		}
		document.write(\"</select>\");


		function music_category_change()
		{
			var tmp;
			var next_url;
		
			next_url='$PHP_SELF?category_num=' + music_category.options[music_category.selectedIndex].value;

			if( music_category.options[music_category.selectedIndex].value != -1){
				tmp=$invar_bgm_frame.invar_category_count[music_category.options[music_category.selectedIndex].value];
			}else{
				tmp= $invar_bgm_frame.invar_MusicCount;
			}
			next_url=next_url + '&list_music_num=' + tmp;
			next_url=next_url + '&invar_use_frame=$invar_use_frame';
			next_url=next_url + '&invar_bgm_frame=$invar_bgm_frame';
			next_url=next_url + '&use_category=$use_category';
			next_url=next_url + '&use_check=$use_check';
			next_url=next_url + '&skin_dir=$skin_dir';
			next_url=next_url + '&from_db_max_music_num=$from_db_max_music_num';

			self.location.href=next_url;
		}
		</script>";
	};

}

?>
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<meta name="Description" content="사랑비 BGM, SARANGBI BGM">
<meta name="classification" content="사랑비 BGM, SARANGBI BGM">
<? require $skin_dir.'list_head.php'; ?>
<script langauge=javascript>

// 현재 카테고리 음악만 듣기
function only_this_category()
{
	var reload_url;
	if( <?=$use_category?> == 1){
		<?=$invar_bgm_frame?>.method_only_this_category(<?=$category_num?>);
		reload_url = "<?=$PHP_SELF?>?category_num=<?=$category_num?>";
		reload_url = reload_url + "&list_music_num=<?=$list_music_num?>";
		reload_url = reload_url + "&invar_use_frame=<?=$invar_use_frame?>";
		reload_url = reload_url + "&invar_bgm_frame=<?=$invar_bgm_frame?>";
		reload_url = reload_url + "&use_category=<?=$use_category?>";
		reload_url = reload_url + "&use_check=<?=$use_check?>";
		reload_url = reload_url + "&skin_dir=<?=$skin_dir?>";
		reload_url = reload_url + "&from_db_max_music_num=<?=$from_db_max_music_num?>";
		reload_url = reload_url + "&page_num=<?=$page_num?>";

		if( <?=$category_num?> == '-1')	alert("모든 카테고리의 음악을 듣습니다.");
		self.location.href=reload_url;
	}else{
		alert("카테고리 목록을 출력하지 않았습니다.");
	}
}

// 문자열 치환 함수
function stringReplace( originalString, findText, replaceText)
{
	var pos=0;
	pos=originalString.indexOf( findText);
	while( pos != -1){
		preString = originalString.substring( 0, pos);
		postString = originalString.substring( pos+1, originalString.length);
		originalString = preString + replaceText + postString;
		pos = originalString.indexOf(findText);
	}
	return originalString;
}

// 특수 문자 제거
function stringReplace2( temp_str)
{
		temp_str = stringReplace( temp_str, ">", "&gt;");
		temp_str = stringReplace( temp_str, "<", "&lt;");
		temp_str = stringReplace( temp_str, "\"", "&quot;");
		return temp_str;
}


var list_current_music=-1;

// 카테고리별 음악 검색
function search_music(cm)
{
	var i;

	if( <?=$category_num?> == -1){
		if( cm < <?=$invar_bgm_frame?>.invar_MusicCount-1)
			return ++cm;
		else
			return -2;
	}else{
		for( i=cm+1; i < <?=$invar_bgm_frame?>.invar_MusicCount; i++)
			if( <?=$category_num?> == <?=$invar_bgm_frame?>.invar_MusicCategory[i]) return i;
	}

	return -2;
}

if( <?=$page_num?> > 1)
	for(i=0; i < (<?=$page_num?>-1)*<?=$from_db_max_music_num?>; i++)
		list_current_music=search_music( list_current_music);
</script>
</head>

<?
require $skin_dir.'list_top.php';

for( $list_num=0; $list_num<$max_music_num; $list_num++){
	echo "<script laguage=javascript>
		if( list_current_music != -2)
			list_current_music=search_music( list_current_music);
		</script>
		";
	include $skin_dir.'list_body.php';
}

require $skin_dir.'list_foot.php';
?>
</body></html>