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
// 사랑비 BGM Player 본체
// * 주 의 * 이 파일은 수정 하지 마세요.
// 모든 설정과 디자인은 스킨 파일에서 할 수 있습니다.
///////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////
//                     변수 초기화
///////////////////////////////////////////////////////////

// 이미지 파일 경로 선언
$img_equl_play = '';
$img_equl_pause = '';
$img_equl_stop = '';

$img_play = '';
$img_play_over = '';

$img_back = '';
$img_back_over = '';

$img_forward = '';
$img_forward_over = '';

$img_stop = '';
$img_stop_over = '';

$img_pause = '';
$img_pause_over = '';

$img_vol_up = '';
$img_vol_up_over = '';

$img_vol_down = '';
$img_vol_down_over = '';

$img_random = '';
$img_random_over = '';

$img_sequence = '';
$img_sequence_over = '';

$img_loop = '';
$img_loop_over = '';

$img_oneplay = '';
$img_oneplay_over = '';

$img_sound_on = '';
$img_sound_on_over = '';
$img_sound_off = '';
$img_sound_off_over = '';

$img_list = '';
$img_list_over = '';

$img_admin = '';
$img_admin_over = '';

// 스킨에 저장된 변수 초기화
$default_caption="SARANGBI BGM CAPTION";
$sarangbi_media_width=0;
$sarangbi_media_height=0;
$subject_style='';
$blend = 0;
$blend_time = '0.5';
$list_width = 300;
$list_height = 90;
$list_one_music_height = 19;

// sarangbi_bgm.php 에만 사용하는 변수
$media_show=false;
$use_context=0;
$music_sort=0;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<meta name="Description" content="사랑비 BGM, SARANGBI BGM">
<meta name="classification" content="사랑비 BGM, SARANGBI BGM">
<SCRIPT language=Javascript src="sarangbi_bgm.js"></SCRIPT>
<script language=javascript>
function bt(id,after) 
{ 
	eval(id+'.filters.blendTrans.stop();'); 
	eval(id+'.filters.blendTrans.Apply();'); 
	eval(id+'.src="'+after+'";'); 
	eval(id+'.filters.blendTrans.Play();'); 
} 
</script>
<?
///////////////////////////////////////////////////////////
//               DB 에서 데이터를 읽어 옮
///////////////////////////////////////////////////////////

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
$db_data[list_frame]=stripslashes($db_data[list_frame]);
$db_data[skin_dir]=stripslashes($db_data[skin_dir]);
$db_data[play_alt]=stripslashes($db_data[play_alt]);
$db_data[stop_alt]=stripslashes($db_data[stop_alt]);
$db_data[back_alt]=stripslashes($db_data[back_alt]);
$db_data[forward_alt]=stripslashes($db_data[forward_alt]);
$db_data[pause_alt]=stripslashes($db_data[pause_alt]);
$db_data[vol_up_alt]=stripslashes($db_data[vol_up_alt]);
$db_data[vol_down_alt]=stripslashes($db_data[vol_down_alt]);
$db_data[one_alt]=stripslashes($db_data[one_alt]);
$db_data[loop_alt]=stripslashes($db_data[loop_alt]);
$db_data[sound_on_alt]=stripslashes($db_data[sound_on_alt]);
$db_data[sound_off_alt]=stripslashes($db_data[sound_off_alt]);
$db_data[sequence_alt]=stripslashes($db_data[sequence_alt]);
$db_data[random_alt]=stripslashes($db_data[random_alt]);
$db_data[list_alt]=stripslashes($db_data[list_alt]);
$db_data[admin_alt]=stripslashes($db_data[admin_alt]);

$skin_dir="skin/".$db_data[skin_dir]."/";		// 스킨 디렉토리
$music_sort=$db_data[use_sort];
$use_context=$db_data[use_context];

// 스킨 디렉토리의 파일 유무 검사
if(!file_exists($skin_dir."bgm_setting.php")) 
	error("스킨 디렉토리 : $skin_dir<br>스킨 디렉토리에 bgm_setting.php 파일이 없습니다.");
if(!file_exists($skin_dir."bgm_head.php")) 
	error("스킨 디렉토리 : $skin_dir<br>스킨 디렉토리에 bgm_head.php 파일이 없습니다.");
if(!file_exists($skin_dir."bgm_body.php")) 
	error("스킨 디렉토리 : $skin_dir<br>스킨 디렉토리에 bgm_body.php 파일이 없습니다.");
if(!file_exists($skin_dir."list_head.php")) 
	error("스킨 디렉토리 : $skin_dir<br>스킨 디렉토리에 list_head.php 파일이 없습니다.");
if(!file_exists($skin_dir."list_top.php")) 
	error("스킨 디렉토리 : $skin_dir<br>스킨 디렉토리에 list_top.php 파일이 없습니다.");
if(!file_exists($skin_dir."list_body.php")) 
	error("스킨 디렉토리 : $skin_dir<br>스킨 디렉토리에 list_body.php 파일이 없습니다.");
if(!file_exists($skin_dir."list_foot.php")) 
	error("스킨 디렉토리 : $skin_dir<br>스킨 디렉토리에 list_foot.php 파일이 없습니다.");


echo "
<script language=javascript>
invar_PlayAtStart=$db_data[use_start];				// 페이지 로딩시 배경음악 시작
invar_RandomPlay=$db_data[use_random];			// Random Play
invar_use_category=$db_data[use_category];		// 카테고리 사용
invar_use_Browser_Status=$db_data[use_status];	// 상태 창에 출력
invar_use_context=$use_context;						// 메모 사용 여부
invar_Loop=false;												// Loop
</script>";

// 프레임 정보 읽어 옮
$invar_use_frame=$db_data[use_frame];			// 1:프레임 사용 0:프레임 사용 안함
$invar_list_frame=$db_data[list_frame];			// 리스트가 출력될 프레임

$init_volume=$db_data[init_volume];				// 초기 볼륨
$init_volume=-2000 + $init_volume * 200;

$num_list = $db_data[num_list];						// BGM List 노래 출력 개수

// 버튼 alt 문장
$play_alt=$db_data[play_alt];
$stop_alt=$db_data[stop_alt];
$back_alt=$db_data[back_alt];
$forward_alt=$db_data[forward_alt];
$pause_alt=$db_data[pause_alt];
$vol_up_alt=$db_data[vol_up_alt];
$vol_down_alt=$db_data[vol_down_alt];
$one_alt=$db_data[one_alt];
$loop_alt=$db_data[loop_alt];
$sound_on_alt=$db_data[sound_on_alt];
$sound_off_alt=$db_data[sound_off_alt];
$sequence_alt=$db_data[sequence_alt];
$random_alt=$db_data[random_alt];
$list_alt=$db_data[list_alt];
$admin_alt=$db_data[admin_alt];

require $skin_dir.'bgm_setting.php';

///////////////////////////////////////////////////////////
//                      함수 선언
///////////////////////////////////////////////////////////

// 버튼 이미지가 없을 때 출력 메시지 (주석으로 출력)
function missing_img($a)
{
	echo "<!-- $a 버튼 이미지가 설정되지 않았습니다. 스킨 디렉토리의 bgm_setting.php 를 확인하세요. //-->";
}

// 버튼 이미지 출력 함수
// button_view(아이디, 버튼 이미지, 마우스 over 버튼 이미지, alt 메시지, 호출 함수)
function button_view( $btn_id, $img1, $img2, $msg, $call_function)
{
	global $blend, $skin_dir, $blend_time;

	echo "<img id='$btn_id' src=\"$skin_dir$img1\"";

	if( $blend){
		echo " onmouseout=\"bt('$btn_id', '$skin_dir$img1');\" onmouseover=\"bt('$btn_id', '$skin_dir$img2'); private_btn_status('$msg');\" ";
	}else{
		echo " onmouseout=\"$btn_id.src='$skin_dir$img1'\" onmouseover=\"$btn_id.src='$skin_dir$img2'; private_btn_status('$msg');\" ";
	}

	echo "alt='$msg' style=\"cursor:hand; filter:blendTrans(duration=$blend_time);\" onClick=\"$call_function; private_btn_status('$msg');\" >\n\n";
}

function media()
{
	global $sarangbi_media_width, $sarangbi_media_height, $media_show, $init_volume;

	$media_show=true;
	echo '<!-- =========================== mediaplayer 개체 =========================== //-->
<object classid="clsid:22D6F312-B0F6-11D0-94AB-0080C74C7E95" align="middle" id="Sarangbi_Bgm"  style="width:'.$sarangbi_media_width.'px; height:'.$sarangbi_media_height.'px; visibility:hidden z-index:1;">
<param name="AllowChangeDisplaySize" value="true">
<param name="AllowScan" value="true">
<param name="AnimationAtStart" value="false">
<param name="AudioStream" value="false">
<param name="AutoRewind" value="true">
<param name="AutoSize" value="false">
<param name="AutoStart" value="true">
<param name="Balance" value="0">
<param name="BufferingTime" value="7">
<param name="ClickToPlay" value="true">
<param name="CurrentMarker" value="0">
<param name="CurrentPosition" value="-1">
<param name="CursorType" value="0">
<param name="DisplayBackColor" value="0">
<param name="DisplayForeColor" value="16777215">
<param name="DisplayMode" value="0">
<param name="DisplaySize" value="2">
<param name="EnableContextMenu" value="true">
<param name="Enabled" value="true">
<param name="EnableFullScreenControls" value="false">
<param name="EnablePositionControls" value="true">
<param name="EnableTracker" value="true">
<param name="InvokeURLs" value="true">
<param name="Language" value="-1">
<param name="Mute" value="false">
<param name="PlayCount" value="1">
<param name="PreviewMode" value="false">
<param name="Rate" value="1">
<param name="SelectionEnd" value="-1">
<param name="SelectionStart" value="-1">
<param name="SendErrorEvents" value="true">
<param name="SendKeyboardEvents" value="false">
<param name="SendMouseClickEvents" value="true">
<param name="SendMouseMoveEvents" value="false">
<param name="SendOpenStateChangeEvents" value="true">
<param name="SendPlayStateChangeEvents" value="true">
<param name="SendWarningEvents" value="true">
<param name="ShowAudioControls" value="true">
<param name="ShowCaptioning" value="false">';
if( $sarangbi_media_width == 0){
	echo '<param name="ShowControls" value="true">';
}else{
	echo '<param name="ShowControls" value="false">';
}
echo '<param name="ShowDisplay" value="false">
<param name="ShowGotoBar" value="false">
<param name="ShowPositionControls" value="false">
<param name="ShowStatusBar" value="true">
<param name="ShowTracker" value="false">
<param name="TransparentAtStart" value="false">
<param name="VideoBorder3D" value="false">
<param name="VideoBorderColor" value="0">
<param name="VideoBorderWidth" value="0">
<param name="Volume" value="'.$init_volume.'">
<param name="WindowlessVideo" value="false">
</object>';
}

// 이퀄라이저 출력 함수
function equal()
{
	global $skin_dir, $img_equl_play, $img_equl_pause, $img_equl_stop;

	echo "<script LANGAUGE=javascript>
	      invar_equal_image_show=true;
	      function sub_ChangeEqualImage(show_mode)
	      {
		if( show_mode == -1){
			switch( private_GetObjectState()){
			case 1:
				sarangbi_bgm_equal_image.src=\"$skin_dir$img_equl_pause\";
				break;
			case 2:
				sarangbi_bgm_equal_image.src=\"$skin_dir$img_equl_play\";
				break;
			case 0:
				sarangbi_bgm_equal_image.src=\"$skin_dir$img_equl_stop\";
			break;
			}
		}else{
			switch( show_mode){
			case 1:
				sarangbi_bgm_equal_image.src=\"$skin_dir$img_equl_pause\";
				break;
			case 2:
				sarangbi_bgm_equal_image.src=\"$skin_dir$img_equl_play\";
				break;
			case 0:
				sarangbi_bgm_equal_image.src=\"$skin_dir$img_equl_stop\";
			break;
			}
		}
	}\n";
	echo "document.write(\"<img id='sarangbi_bgm_equal_image' src='$skin_dir$img_equl_stop'>\");\n</script>\n\n";
}


// 제목을 출력하는 함수 (input 폼 이용)
function subject()
{
	global $subject_style;
	echo "<script LANGUAGE=javascript> 
		invar_subject_show=true; 
		document.write(\"<input type='text' READONLY name='sarangbi_bgm_subject' value='::SARANGBI BGM::' style='";
	echo $subject_style."'>\");\n</script>\n\n";
}

// 제목을 출력하는 함수 (레이어 이용)
function subject2()
{
	echo "<script LANGUAGE=javascript>
		invar_subject2_show=true;
		document.write(\"<span id=sarangbi_bgm_subject2>::SARANGBI BGM::</span>\")</script>";
}

// 내용을 출력하는 함수
function memo()
{
	global $use_context;

	if( $use_context==1){
		echo "<script LANGUAGE=javascript>
			invar_context_show=true;
			document.write('<span id=sarangbi_bgm_context>::SARANGBI BGM::</span>');</script>";
	}else{
		echo "<!-- 사랑비 BGM 관리도구에서 메모 기능을 OFF 하였습니다.//-->";
	}
}

// 연주 중인 곡의 총 길이
function all_time()
{
	echo "<script LANGUAGE=javascript>
		invar_alltime_show=true;
		document.write(\"<span id=sarangbi_bgm_alltime>00:00</span>\")</script>";
}

// 연주 중인 곡의 현재 시간
function cur_time()
{
	echo "<script LANGUAGE=javascript>
		invar_curtime_show=true;
		document.write(\"<span id=sarangbi_bgm_curtime>00:00</span>\")</script>";
}

// 캡션 출력 함수
function caption()
{
	echo "<script language=javascript> invar_caption_show=true;</script>";
	echo "<span id=sarangbi_bgm_caption>SARANGBI BGM CAPTION</span>";
}

// play 버튼 출력 함수
function play()
{
	global $img_play, $img_play_over, $play_alt;

	if( $img_play == '')
		missing_img('Play');
	else
		button_view( 'sarangbi_bgm_play_image', $img_play, $img_play_over, $play_alt, 'method_PlayButtonPush()');
}

// back 버튼 출력 함수 (이전곡 play)
function back()
{
	global $img_back, $img_back_over, $back_alt;

	if( $img_back == '')
		missing_img('Back');
	else
		button_view( 'sarangbi_bgm_back_image', $img_back, $img_back_over, $back_alt, 'method_PreviousButtonPush()');
}

// next 버튼 출력 함수 (다음곡 play)
function forward()
{
	global $img_forward, $img_forward_over, $forward_alt;

	if( $img_forward == '')
		missing_img('Forward');
	else
		button_view( 'sarangbi_bgm_forward_image', $img_forward, $img_forward_over, $forward_alt, 'method_NextButtonPush()');
}

// pause 버튼 출력 함수 (다음곡 play)
function pause()
{
	global $img_pause, $img_pause_over, $pause_alt;

	if( $img_pause == '')
		missing_img('Pause');
	else
		button_view( 'sarangbi_bgm_pause_image', $img_pause, $img_pause_over, $pause_alt, 'method_PauseButtonPush()');
}

// stop 버튼 출력 함수
function stop()
{
	global $img_stop, $img_stop_over, $stop_alt;

	if( $img_stop == '')
		missing_img('Stop');
	else
		button_view( 'sarangbi_bgm_stop_image', $img_stop, $img_stop_over, $stop_alt, 'method_StopButtonPush()');
}

// volume up 버튼 출력 함수
function vol_up()
{
	global $img_vol_up, $img_vol_up_over, $vol_up_alt;

	if( $img_vol_up == '')
		missing_img('Volume Up');
	else
		button_view( 'sarangbi_bgm_vol_up_image', $img_vol_up, $img_vol_up_over, $vol_up_alt, 'method_VolumnUpButtonPush()');
}

// volume down 버튼 출력 함수
function vol_down()
{
	global $img_vol_down, $img_vol_down_over, $vol_down_alt;

	if( $img_vol_down == '')
		missing_img('Volume Down');
	else
		button_view( 'sarangbi_bgm_vol_down_image', $img_vol_down, $img_vol_down_over, $vol_down_alt, 'method_VolumnDownButtonPush()');
}

// random, sequence 선택 버튼 출력 함수
function random_sequence()
{
	global $img_random, $img_random_over, $img_sequence, $img_sequence_over, $random_alt, $sequence_alt, $skin_dir, $blend, $blend_time;;

	if( $img_random == '' || $img_sequence == ''){
		missing_img('Random 버튼 혹은 Sequence');
	}else{
		echo "<script LANGAUGE=javascript>
		var mouse_position_random=1;  // onmouseout=1  onmouseover=0
		
		function sub_ChangeRandomImage()
		{	
			
			if( invar_RandomPlay){
				if( mouse_position_random){
					if( $blend)
						bt('sarangbi_bgm_random_image', '$skin_dir$img_random');
					else
						sarangbi_bgm_random_image.src=\"$skin_dir$img_random\";
				}else{
					if( $blend)
						bt('sarangbi_bgm_random_image', '$skin_dir$img_random_over');
					else
						sarangbi_bgm_random_image.src=\"$skin_dir$img_random_over\";
					private_btn_status('$random_alt');
				}
				sarangbi_bgm_random_image.alt=\"$random_alt\";
			}else{
				if( mouse_position_random){
					if( $blend)
						bt('sarangbi_bgm_random_image', '$skin_dir$img_sequence');
					else
						sarangbi_bgm_random_image.src=\"$skin_dir$img_sequence\";
				}else{
					if( $blend)
						bt('sarangbi_bgm_random_image', '$skin_dir$img_sequence_over');
					else
						sarangbi_bgm_random_image.src=\"$skin_dir$img_sequence_over\";
					private_btn_status('$sequence_alt');
				}
				sarangbi_bgm_random_image.alt=\"$sequence_alt\";
			}
		} //end of function

		// tmp == 1 onmouseout
		// tmp == 0 onmouseover
		function image_change_random(tmp)
		{
			mouse_position_random=tmp;
			sub_ChangeRandomImage();
		}

		document.write(\"<img id='sarangbi_bgm_random_image' src='$skin_dir$img_random' onmouseover='image_change_random(0);' onmouseout='image_change_random(1);' style='cursor:hand; filter:blendTrans(duration=$blend_time);' onClick='method_RandomButtonPush();'>\");
		
		if( invar_RandomPlay) sarangbi_bgm_random_image.src='$skin_dir$img_random';
		else sarangbi_bgm_random_image.src='$skin_dir$img_sequence';
		\n</script>\n\n";		
	}
}

// one play, loop 선택 버튼 출력 함수
function loop()
{
	global $img_loop, $img_loop_over, $img_oneplay, $img_oneplay_over, $loop_alt, $one_alt, $skin_dir, $blend, $blend_time;

	if( $img_loop == '' || $img_oneplay == ''){
		missing_img('Loop 버튼 혹은 One play');
	}else{
		echo "<script LANGAUGE=javascript>
		var mouse_position_loop=1;	// onmouseout=1  onmouseover=0
		
		function sub_ChangeLoopImage()
		{	
			if( invar_Loop){
				if( mouse_position_loop){
					if( $blend)
						bt('sarangbi_bgm_loop_image', '$skin_dir$img_loop');
					else
						sarangbi_bgm_loop_image.src=\"$skin_dir$img_loop\";
				}else{
					if( $blend)
						bt('sarangbi_bgm_loop_image', '$skin_dir$img_loop_over');
					else
						sarangbi_bgm_loop_image.src=\"$skin_dir$img_loop_over\";
					private_btn_status('$loop_alt');
				}
				sarangbi_bgm_loop_image.alt=\"$loop_alt\";
			}else{
				if( mouse_position_loop){
					if( $blend)
						bt('sarangbi_bgm_loop_image', '$skin_dir$img_oneplay');
					else
						sarangbi_bgm_loop_image.src=\"$skin_dir$img_oneplay\";
				}else{
					if( $blend)
						bt('sarangbi_bgm_loop_image', '$skin_dir$img_oneplay_over');
					else
						sarangbi_bgm_loop_image.src=\"$skin_dir$img_oneplay_over\";
					private_btn_status('$one_alt');
				}
				sarangbi_bgm_loop_image.alt=\"$one_alt\";
			}
		}

		// tmp == 1 onmouseout
		// tmp == 0 onmouseover
		function image_change_loop(tmp)
		{
			mouse_position_loop=tmp;
			sub_ChangeLoopImage();
		}

		document.write(\"<img id='sarangbi_bgm_loop_image' src='$skin_dir$img_oneplay' onmouseover='image_change_loop(0);' onmouseout='image_change_loop(1);' style='cursor:hand; filter:blendTrans(duration=$blend_time);' onClick='method_LoopButtonPush();'>\");
		
		if( invar_Loop) sarangbi_bgm_loop_image.src='$skin_dir$img_loop';
		else sarangbi_bgm_loop_image.src='$skin_dir$img_oneplay';
		</script>\n\n";
	}
}

// Play Stop 토글 버튼 출력 함수
function play_stop()
{
	global $img_play, $img_play_over, $img_stop, $img_stop_over, $play_alt, $stop_alt, $skin_dir, $blend, $blend_time;

	if( $img_play == '' || $img_stop == ''){
		missing_img('Play 버튼 혹은 Stop');
	}else{
		echo "<script LANGAUGE=javascript>
		var mouse_position_playstop=1;	// onmouseout=1  onmouseover=0
		invar_play_stop_show=true;
		
		// tmp=3 play  tmp=2 pause  tmp=1 stop
		function sub_ChangePlayStopImage(tmp)
		{	
			if( tmp == -1) tmp = private_GetObjectState();

			if( tmp == 2 || tmp == 1){
				if( mouse_position_playstop){
					if( $blend)
						bt('sarangbi_bgm_playstop_image', '$skin_dir$img_stop');
					else
						sarangbi_bgm_playstop_image.src=\"$skin_dir$img_stop\";
				}else{
					if( $blend)
						bt('sarangbi_bgm_playstop_image', '$skin_dir$img_stop_over');
					else
						sarangbi_bgm_playstop_image.src=\"$skin_dir$img_stop_over\";
					private_btn_status('$stop_alt');
				}
				sarangbi_bgm_playstop_image.alt=\"$stop_alt\";
			}else if( tmp == 0){
				if( mouse_position_playstop){
					if( $blend)
						bt('sarangbi_bgm_playstop_image', '$skin_dir$img_play');
					else
						sarangbi_bgm_playstop_image.src=\"$skin_dir$img_play\";
				}else{
					if( $blend)
						bt('sarangbi_bgm_playstop_image', '$skin_dir$img_play_over');
					else
						sarangbi_bgm_playstop_image.src=\"$skin_dir$img_play_over\";
					private_btn_status('$play_alt');
				}
				sarangbi_bgm_playstop_image.alt=\"$play_alt\";
			}
		}

		// tmp == 1 onmouseout
		// tmp == 0 onmouseover
		function image_change_playstop(tmp)
		{
			mouse_position_playstop=tmp;
			sub_ChangePlayStopImage(-1);
		}

		document.write(\"<img id='sarangbi_bgm_playstop_image' src='$skin_dir$img_play' onmouseover='image_change_playstop(0);' onmouseout='image_change_playstop(1);' style='cursor:hand; filter:blendTrans(duration=$blend_time);' onClick='method_PlayStopButtonPush();'>\");
		
		if( invar_PlayAtStart) sarangbi_bgm_playstop_image.src='$skin_dir$img_stop';
		else sarangbi_bgm_playstop_image.src='$skin_dir$img_play';
		</script>\n\n";
	}
}

// mute 기능 출력 버튼
function mute()
{
	global $img_sound_on, $img_sound_on_over, $img_sound_off, $img_sound_off_over, $sound_on_alt, $sound_off_alt, $skin_dir, $blend, $blend_time;

	if( $img_sound_on == '' || $img_sound_off == ''){
		missing_img('Loop 버튼 혹은 One play');
	}else{
		echo "<script LANGAUGE=javascript>
		var mouse_position_mute=1;	// onmouseout=1  onmouseover=0
		invar_mute_image_show=true;

		function sub_ChangeMuteImage()
		{	
			if( document.Sarangbi_Bgm.mute){
				if( mouse_position_mute){
					if( $blend)
						bt('sarangbi_bgm_mute_image', '$skin_dir$img_sound_off');
					else
						sarangbi_bgm_mute_image.src=\"$skin_dir$img_sound_off\";
				}else{
					if( $blend)
						bt('sarangbi_bgm_mute_image', '$skin_dir$img_sound_off_over');
					else
						sarangbi_bgm_mute_image.src=\"$skin_dir$img_sound_off_over\";
					private_btn_status('$sound_off_alt');
				}
				sarangbi_bgm_mute_image.alt=\"$sound_off_alt\";
			}else{
				if( mouse_position_mute){
					if( $blend)
						bt('sarangbi_bgm_mute_image', '$skin_dir$img_sound_on');
					else
						sarangbi_bgm_mute_image.src=\"$skin_dir$img_sound_on\";
				}else{
					if( $blend)
						bt('sarangbi_bgm_mute_image', '$skin_dir$img_sound_on_over');
					else
						sarangbi_bgm_mute_image.src=\"$skin_dir$img_sound_on_over\";
					private_btn_status('$sound_on_alt');
				}
				sarangbi_bgm_mute_image.alt=\"$sound_on_alt\";
			}
		}

		// tmp == 1 onmouseout
		// tmp == 0 onmouseover
		function image_change_mute(tmp)
		{
			mouse_position_mute=tmp;
			sub_ChangeMuteImage();
		}

		document.write(\"<img id='sarangbi_bgm_mute_image' src='$skin_dir$img_sound_on' onmouseover='image_change_mute(0);' onmouseout='image_change_mute(1);' style='cursor:hand; filter:blendTrans(duration=$blend_time);' onClick='method_MuteButtonPush();'>\");\n</script>\n\n";
	}
}

// 음악 리스트 출력 함수
function bgm_list()
{
	global $img_list, $img_list_over, $list_alt, $blend, $blend_time, $skin_dir, $list_width, $list_height, $list_one_music_height, $invar_use_frame, $invar_list_frame, $num_list;

	if( $img_list == '')
		missing_img('Music List 출력');
	else{
		echo "<script language=javascript>
		function method_BGMListButtonPush()
		{
			if( $invar_use_frame){
				$invar_list_frame.location.href='sarangbi_bgm_list.php';
			}else{
			var w = $list_width;
			var h = $list_height;
			var sw = window.screen.availWidth;
			var sh = window.screen.availHeight;

			if( invar_MusicCount > $num_list)
						h+=$list_one_music_height*$num_list;
			else
						h+=$list_one_music_height*invar_MusicCount;
	
			var sarangbi_bgm_list=window.open('sarangbi_bgm_list.php','Sarangbi_BGM_MusicList','scrollbars=yes,resizable=yes,width='+w+',height='+h);
	
			sarangbi_bgm_list.moveTo((sw - w) / 2, (sh - h) / 2);
			}
		}

		function bgmlist_over(){
			if( $blend)
				bt('sarangbi_bgm_list_image', '$skin_dir$img_list_over');
			else
				sarangbi_bgm_list_image.src=\"$skin_dir$img_list_over\";
			private_btn_status('$list_alt');

		}

		function bgmlist_out(){
			if( $blend)
				bt('sarangbi_bgm_list_image', '$skin_dir$img_list');
			else
				sarangbi_bgm_list_image.src=\"$skin_dir$img_list\";
		}

		document.write(\"<img id='sarangbi_bgm_list_image' src='$skin_dir$img_list' onmouseover='bgmlist_over();' onmouseout='bgmlist_out();' style='cursor:hand; filter:blendTrans(duration=$blend_time);' alt='$list_alt' onClick='method_BGMListButtonPush();'>\");\n</script>\n\n";
	}
}

// pause 버튼 출력 함수 (다음곡 play)
function bgm_admin()
{
	global $img_admin, $img_admin_over, $admin_alt, $skin_dir, $blend, $blend_time;

	if( $img_admin == '')
		missing_img('사랑비 BGM 관리 도구 출력');
	else{
		echo "<script language=javascript>
		function method_SetupButtonPush()
		{
			var w = 620;
			var h = 620;
			var sw = window.screen.availWidth;
			var sh = window.screen.availHeight;

			var sarangbi_setup=window.open('sarangbi_bgm_admin.php','Sarangbi_BGM_Setup','scrollbars=yes, resizable=yes,width='+w+',height='+h);

			sarangbi_setup.moveTo((sw - w) / 2, (sh - h) / 2);
		}

		function bgmadmin_over(){
			if( $blend)
				bt('sarangbi_bgm_admin_image', '$skin_dir$img_admin_over');
			else
				sarangbi_bgm_admin_image.src=\"$skin_dir$img_admin_over\";
			private_btn_status('$admin_alt');

		}

		function bgmadmin_out(){
			if( $blend)
				bt('sarangbi_bgm_admin_image', '$skin_dir$img_admin');
			else
				sarangbi_bgm_admin_image.src=\"$skin_dir$img_admin\";
		}

		document.write(\"<img id='sarangbi_bgm_admin_image' src='$skin_dir$img_admin' onmouseover='bgmadmin_over();' onmouseout='bgmadmin_out();' style='cursor:hand; filter:blendTrans(duration=$blend_time);' alt='$admin_alt' onClick='method_SetupButtonPush();'>\");\n</script>\n\n";
	}
}

?>

<script language=javascript for=Sarangbi_Bgm Event=EndOfStream>
	private_AutoPlayAnother();
</script>

<script language=javascript for=Sarangbi_Bgm Event=Error>
	private_Error();
</script>

<script language=javascript for=Sarangbi_Bgm Event="PlayStateChange(lOldState, lNewState)">
	private_PlayStateChange( lNewState);
</script>

<script language=javascript for=Sarangbi_Bgm Event="Buffering(bStart)">
	private_Buffring( bStart);
</script>


<? require $skin_dir.'bgm_head.php'; ?>
</head>
<? require $skin_dir.'bgm_body.php';
///////////////////////////////////////////////////////////
//                      초기화 모듈
///////////////////////////////////////////////////////////

if( $media_show == false){
	$sarangbi_media_width=0;
	$sarangbi_media_height=0;
	media();
}

echo"<script language=javascript>";
$query="select * from sarangbi_music_".$table." where use_this=1";
switch( $music_sort){
	case 0	:	$query=$query." order by no desc"; break;
	case 1	:	$query=$query." order by no"; break;
	case 2	:	$query=$query." order by subject"; break;
	case 3	:	$query=$query." order by subject desc"; break;
}
$data = mysql_query($query, $connect) or error(mysql_error());

$sarangbi_url = "http://".$HTTP_HOST.$REQUEST_URI;
$sarangbi_url = eregi_replace("sarangbi_bgm.php", "", $sarangbi_url);

while($db_data=mysql_fetch_array($data)){
	$category_query="select * from sarangbi_category_".$table." where no=".$db_data[category];
	$category_data = mysql_query($category_query, $connect) or error(mysql_error());
	$category_db_data = mysql_fetch_array($category_data);

	$tmp_context = $db_data[context];
	$tmp_context = str_replace("\r\n","<br>", $tmp_context);

	if( $db_data[use_caption] == 1){
		if( $db_data[linkfile] == 1)
			$caption_url = $sarangbi_url.$db_data[caption_filename];
		else
			$caption_url = $db_data[caption_url];
	}else{
		$caption_url="";
	}

	if( $db_data[linkfile] == 1)
		echo "private_loadMusicList( '$category_db_data[name]', '$db_data[filename]', '$db_data[subject]','$tmp_context', '$category_db_data[no]', '$caption_url');";
	else
		echo "private_loadMusicList( '$category_db_data[name]', '$db_data[link]', '$db_data[subject]','$tmp_context', '$category_db_data[no]', '$caption_url');";
}

echo "private_Browser_Status( '::SARANGBI BGM::');
invar_default_caption='$default_caption';				// 디폴트 캡션
private_caption_control('');

if( invar_PlayAtStart && invar_MusicCount != 0) method_PlayButtonPush();
else method_StopButtonPush();
</script>";
if( $connet) mysql_close($connect);
?>
<div id=playstatusshow></div><br>
<br>
<br>
<div id=PlayStateChangeshow></div><br>
<br>
<br>
<div id=buf></div>
</body>
</html>
<!--============================================================================//-->