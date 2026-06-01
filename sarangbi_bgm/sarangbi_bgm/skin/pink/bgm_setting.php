<?
///////////////////////////////////////////////////////////
// 윈도우 미디어 인코더의 크기 설정
// ================================
// 윈도우의 미디어 크기를 설정합니다.
// 배경 음악으로 사용할 경우는 0
// 동영상을 출력할 경우에는 적당한 크기를 설정하세요.
///////////////////////////////////////////////////////////

$sarangbi_media_width=0;
$sarangbi_media_height=0;


///////////////////////////////////////////////////////////
// 제목 출력 INPUT FORM 스타일
// ===========================
// play 되는 노래 제목 출력 함수 subject() 에서 사용하는
// style 을 지정합니다. input form 의 style 을 설정합니다.
///////////////////////////////////////////////////////////

$subject_style = 'font-famlily:돋움, 굴림, vdrdana; width:150; height:17; font-size:9pt; color:000000; border-width:1px; border-color:rgb(255,189, 206); border-style:none;';


///////////////////////////////////////////////////////////
// 버튼 이미지의 블랜드 트랜지션 효과 설정
// =======================================
// blend 효과 사용      --> $blend = 1
// blend 효과 사용 안함 --> $blend = 0
// $blend_time 은 블랜딩 되는 시간
///////////////////////////////////////////////////////////

$blend = 1;
$blend_time = '0.5';


///////////////////////////////////////////////////////////
// 음악 리스트 출력 창 크기 설정
// =============================
// $list_width            : 가로 크기
// $list_height           : 음악 제목 출력 부분을 제외한 세로 크기
// $list_one_music_height : 음악 한곡의 세로 크기
///////////////////////////////////////////////////////////

$list_width = 300;
$list_height = 130;
$list_one_music_height = 19;


///////////////////////////////////////////////////////////
// 버튼 이미지의 블랜드 트랜지션 효과 설정
// =======================================
// 가사 파일이 없을 때나 음악이 멈추었을 때 가사 대신 출력
// $default_caption = "출력하고자 하는 문자열";
///////////////////////////////////////////////////////////

$default_caption = "SARANGBI BGM CAPTION";


///////////////////////////////////////////////////////////
// 버튼 이미지 파일 설정
// =====================
// 각각의 버튼 이미지 파일을 지정합니다.
// 이미지 파일은 현재의 스킨 디렉토리 안에 있습니다.
///////////////////////////////////////////////////////////

$img_equl_play = 'button/equal.gif';
$img_equl_pause = 'button/equalpause.gif';
$img_equl_stop = 'button/equalstop.gif';

$img_play = 'button/play.gif';
$img_play_over = 'button/play_over.gif';

$img_back = 'button/back.gif';
$img_back_over = 'button/back_over.gif';

$img_forward = 'button/forward.gif';
$img_forward_over = 'button/forward_over.gif';

$img_stop = 'button/stop.gif';
$img_stop_over = 'button/stop_over.gif';

$img_pause = 'button/pause.gif';
$img_pause_over = 'button/pause_over.gif';

$img_vol_up = 'button/volume_up.gif';
$img_vol_up_over = 'button/volume_up_over.gif';

$img_vol_down = 'button/volume_down.gif';
$img_vol_down_over = 'button/volume_down_over.gif';

$img_random = 'button/random.gif';
$img_random_over = 'button/random_over.gif';

$img_sequence = 'button/sequence.gif';
$img_sequence_over = 'button/sequence_over.gif';

$img_loop = 'button/loop.gif';
$img_loop_over = 'button/loop_over.gif';

$img_oneplay = 'button/one_play.gif';
$img_oneplay_over = 'button/one_play_over.gif';

$img_sound_on = 'button/sound_on.gif';
$img_sound_on_over = 'button/sound_on_over.gif';
$img_sound_off = 'button/sound_off.gif';
$img_sound_off_over = 'button/sound_off_over.gif';

$img_list = 'button/list.gif';
$img_list_over = 'button/list_over.gif';

$img_admin = 'button/admin.gif';
$img_admin_over = 'button/admin_over.gif';
?>