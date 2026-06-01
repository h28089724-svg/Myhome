<?
/////////////////////////////////////////////////////////// 
/*
// BODY 에 들어갈 내용을 적습니다.
// 사용할 수 있는 함수는 다음과 같습니다.
// 아래 함수들을 적어도 되고 적지 않아도 됩니다. 출력할 함수만 적으세요.
// 각각의 함수에서 사용하는 이미지 파일의 설정은 bgm_setting.php 에 있습니다.
// 
// <?=$skin_dir?>				환경 변수(스킨 디렉토리의 경로)
//
// <? media(); ?>				미디어 플레이어 개체
// <? equal(); ?>				이퀄라이저 출력 함수
// <? play(); ?>				PLAY 버튼 출력 함수
// <? stop(); ?>				STOP 버튼 출력 함수
// <? play_stop(); ?>			PLAY ,STOP 토글 버튼 출력 함수
// <? back(); ?>				이전 곡 play 버튼 출력 함수
// <? forward(); ?>				다음 곡 play 버튼 출력 함수
// <? pause(); ?>				일시 정지 버튼 출력 함수
// <? vol_up(); ?>				볼륨 업 버튼 출력 함수
// <? vol_down(); ?>			볼륨 다운 버튼 출력 함수
// <? random_sequence(); ?>		Random, Sequence 선택 버튼 출력 함수
// <? loop(); ?>				Loop 버튼 출력 함수
// <? mute(); ?>				소리 끔(Mute) 버튼 출력 함수
// <? bgm_list(); ?>			음악 리스트 창 출력 버튼 함수
// <? bgm_admin(); ?>			관리 도구 창 출력 버튼 함수
// <? all_time(); ?>			현재 Play 되는 노래의 총 play 시간 출력 함수
// <? cur_time(); ?>			현채 Play 되는 노래의 play 한 시간 출력 함수
// <? subject(); ?>				제목 출력 함수 (INPUT FORM 사용, style 설정은 bgm_setting.php 에 있음)
// <? subject2(); ?>			제목 출력 함수 (layer를 이용하여 출력)
// <? memo(); ?>				현재 Play 되는 노래의 설명 출력 함수 (layer 를 이용하여 출력)
// <? caption(); ?>			가사 출력
*/
///////////////////////////////////////////////////////////
?>

<BODY bgcolor=white topmargin='0'  leftmargin='0' marginwidth='0' marginheight='0'>
<? media(); ?>
<? subject(); ?>
<? equal(); ?>
<? back(); ?>
<? play_stop(); ?>
<? forward(); ?>
<? pause(); ?>
<? vol_up(); ?>
<? vol_down(); ?>
<? random_sequence(); ?>
<? loop(); ?>
<? mute(); ?>
<? bgm_list(); ?>
<? bgm_admin(); ?>
<? all_time(); ?>/<? cur_time(); ?>
<!-- </body> 는 적지 마세요. //-->