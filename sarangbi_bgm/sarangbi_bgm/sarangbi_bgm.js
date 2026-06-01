// ================================<< License(저작권) >>================================
// SARANGBI BGM Player 2.1 (Using Windows Media Player 6.4)
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

///////////////////////////////////////////////////////////
// 사랑비 BGM 자바 스크립터
// * 주 의 * 이 파일은 수정 하지 마세요.
///////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////
// 변수 설정
////////////////////////////////////////////////////////////////////

var invar_LocalStatus=0;			// Player 상태
var invar_Error=0;					// Error 탐지
var invar_Buffring=false;			// 버퍼링 상태 탐지

var invar_PlayAtStart=false;		// 페이지 로딩시 배경음악 시작(true, false)
var invar_Loop=false;				// Loop(true, false)
var invar_RandomPlay=false;		// Random Play (true, false)

var invar_use_Browser_Status=false;	// 브라우저 상태창에 출력 여부
var invar_use_category=false;			// 카테고리 사용
var invar_use_context=false;				// 메모 사용 여부

var invar_MusicUrl=null;				// 노래 경로
var invar_MusicCaptionUrl=null;	// 노래 가사 경로
var invar_MusicTitle=null;			// 노래 제목
var invar_MusicContext=null;		// 노래 내용
var invar_MusicCount=0;			// 개수
var invar_CurrentTrack=0;			// 현재 실행중인 트랙 (0,1,2...)
var invar_MusicUse=null;			// 사용할 음악
var invar_MusicCategory=null;	// 카테고리 번호 저장

var invar_total_min="00";			// 연주 중인 노래의 총 시간(분)
var invar_total_sec="00";			// 연주 중인 노래의 총 시간(초)
var invar_cur_min="00";				// 연주 중인 노래의 현재 시간(분)
var invar_cur_sec="00";				// 연주 중인 노래의 현재 시간(초)
var invar_timer=-1;					// 타이머 아이디

var invar_equal_image_show=false;	// 이퀄라이저 이미지 출력 부분이 설정
var invar_context_show=false;		// 스킨에 노래 내용 출력하는 부분이 있는지 설정
var invar_subject_show=false;		// 노래 제목 출력창이 있는지 설정
var invar_subject2_show=false;		// 레이어 이용한 노래 제목 출력
var invar_mute_image_show=false;	// Mute 버튼이 있는지 설정
var invar_alltime_show=false;			// 연주 중인 곡의 총 시간
var invar_curtime_show=false;		// 연주 중인 곡의 현재 시간
var invar_play_stop_show=false;		// Play, Stop 토글 버튼
var invar_caption_show=false;		// Caption 출력
var invar_default_caption="";			// 디폴트 캡션

var invar_category_num=0;			// 카테고리 번호
var invar_category_name=null;		// 카테고리 이름
var invar_category_count=null;		// 카테고리에 저장된 음악 개수
var invar_category_db_no=null;		// DB 에 저장된 카테고리 번호

////////////////////////////////////////////////////////////////////
// 내부 함수
////////////////////////////////////////////////////////////////////

// 웹브라우저 상태창에 출력
function private_Browser_Status( msg)
{
	if( invar_use_Browser_Status)
	{
		if( msg == '::SARANGBI BGM::')
			window.defaultStatus = msg;
		else
			window.defaultStatus = '[배경 음악] ' + msg;
	}
}

// 버튼에 마우스 over 했을 때 상태창에 출력
function private_btn_status( msg)
{
	if( invar_use_Browser_Status && (invar_timer == -1))
	{
		window.status = msg;
	}
}

// 시간 표시 함수
function private_time()
{
	total_time=Math.floor( document.Sarangbi_Bgm.Duration);
	cur_time=Math.floor( document.Sarangbi_Bgm.currentPosition);

	if( invar_Error > 0){
		if( invar_Error <= 3){
			private_subject_show(11);
			invar_Error++;
		}else 
			method_NextButtonPush();
	}else 
		
	if( invar_Buffring == true)
		private_subject_show(6);
	else{
		invar_total_min=Math.floor( total_time/60);
		invar_total_sec=total_time - invar_total_min*60;

		invar_cur_min=Math.floor( cur_time/60);
		invar_cur_sec=cur_time - invar_cur_min*60;

		if( invar_total_min < 10) invar_total_min = "0" + invar_total_min;
		if( invar_total_sec < 10) invar_total_sec = "0" + invar_total_sec;
		if( invar_cur_min < 10) invar_cur_min = "0" + invar_cur_min;
		if( invar_cur_sec < 10)	invar_cur_sec = "0" + invar_cur_sec;

		if( private_GetMediaState() == 2 && invar_use_Browser_Status) window.defaultStatus = '[배경 음악] ' + invar_MusicTitle[invar_CurrentTrack] + " (" + invar_cur_min + ":" + invar_cur_sec + ")";
	
		if( invar_alltime_show) document.all.sarangbi_bgm_alltime.innerHTML = invar_total_min + ":" + invar_total_sec;
		if( invar_curtime_show) document.all.sarangbi_bgm_curtime.innerHTML = invar_cur_min + ":" + invar_cur_sec;
	}
}

// 시간 표시 함수 종료 함수(안전을 위하여...)
function private_clear_time()
{
	if( invar_timer != -1){
		clearInterval( invar_timer);
		invar_timer=-1
	}
	if( invar_alltime_show) document.all.sarangbi_bgm_alltime.innerHTML = "00:00";
	if( invar_curtime_show) document.all.sarangbi_bgm_curtime.innerHTML = "00:00";
}

// 시간 표시 함수 시작
function private_start_time()
{
	if( invar_timer != -1){
			clearInterval( invar_timer);
			invar_timer=-1
		}
		invar_Error=0;
		invar_timer=setInterval("private_time();", 1000);
}

// 미디어 플레이어 개체의 현재 상태 반환( return value : 0:stop, 1:pause, 2:play)
function private_GetMediaState()
{
	if( navigator.appName == "Netscape")
		return ( document.Sarangbi_Bgm.GetPlayState());
	else
		return ( document.Sarangbi_Bgm.PlayState);
}

// 현재 상태 반환( return value : 0:stop, 1:pause, 2:playing)
function private_GetObjectState()
{
	return invar_LocalStatus;
}

// 현재 상태 저장 (0:stop, 1:pause, 2:playing)
function private_SetObjectState( new_state)
{
	invar_LocalStatus = new_state;
}

// 이퀄라이저 이미지를 상황에 맞게 변경
function private_ChangeEqual(show_mode)
{
	if( invar_equal_image_show == true)
		sub_ChangeEqualImage(show_mode);
}

// 스킨 디렉토리의 디폴트 캡션 파일을 출력. (출력 해야 할 때만..)
function private_caption_control( caption_file)
{
	if( invar_caption_show){
		if( caption_file != ""){
			document.Sarangbi_Bgm.CaptioningID = 'sarangbi_bgm_caption';
			document.Sarangbi_Bgm.SAMIFileName = caption_file;
		}else{
			document.Sarangbi_Bgm.CaptioningID = '';
			document.all.sarangbi_bgm_caption.innerHTML = invar_default_caption;
		}
	}
}

// 지정한 음악 플레이 하기
function private_PlayMusic(track)
{
	if( (invar_MusicCount == 0) || (private_use_count() == 0) || ( track == -1)){
		method_StopButtonPush();
		alert("저장된 배경 음악이 없거나, 선택한 배경 음악이 없습니다.");
	}else{
		if( track >= 0 && track < invar_MusicCount){
			document.Sarangbi_Bgm.stop();
			private_caption_control("");
			private_ChangeEqual(1);
			invar_CurrentTrack=track;
			document.Sarangbi_Bgm.Open( invar_MusicUrl[invar_CurrentTrack]);
			private_caption_control(invar_MusicCaptionUrl[invar_CurrentTrack]);
			private_SetObjectState(2);
			private_ChangeEqual(-1);
			private_subject_show(-1);
			private_context_show(-1);
			if( invar_play_stop_show) sub_ChangePlayStopImage(-1);
			private_start_time();
		}
	}
}

// 내용 출력 부분
function private_context_show(show_mode)
{
	if( invar_context_show && invar_use_context){
		if( show_mode == -1) show_mode=private_GetObjectState();
		if( show_mode == 2 || show_mode == 1)
			document.all.sarangbi_bgm_context.innerHTML = invar_MusicContext[invar_CurrentTrack];
		else
			document.all.sarangbi_bgm_context.innerHTML = "::SARANGBI BGM::";
	}
}

// 제목 표시 부분
function private_subject_show(show_mode)
{
	temp="::SARANGBI BGM::";
	if( show_mode == -1) show_mode=private_GetObjectState();

	
	switch( show_mode){
		case 0:
			temp ="::SARANGBI BGM::";
			break;
		case 1:
			temp =invar_MusicTitle[invar_CurrentTrack] + '-잠시멈춤';
			break;
		case 2:
			temp =invar_MusicTitle[invar_CurrentTrack];
			break;
		case 6:
			temp ="버퍼링 중입니다.";
			break;
		case 10:
			temp="서버에 접속 시도 중입니다.";
			break;
		case 11:
			temp="음악 파일을 로딩 할 수 없습니다. 다음 곡을 연주합니다.";
			break;
	}

	if( document.Sarangbi_Bgm.mute == true)	temp+="-소리 끔";

	if( invar_subject_show)	sarangbi_bgm_subject.value =temp;
	if( invar_subject2_show) document.all.sarangbi_bgm_subject2.innerHTML = temp;
	private_Browser_Status( temp);
}

// 에러 메시지
function private_Error()
{
	invar_Error++;
}

// 다음 음악을 선곡하여 플레이
function private_AutoPlayAnother()
{
	private_SetObjectState(8);

	if( invar_Loop) private_PlayMusic( invar_CurrentTrack);
	else
		method_NextButtonPush();
}

// 개체의 상태 변화 체크 함수 (ESC 키 사용을 위해)
function private_PlayStateChange( lNewState)
{
	if( private_GetObjectState() != 8 && lNewState == 0)
		method_StopButtonPush();
}

// 버퍼링
function private_Buffring( bStart)
{
	invar_Buffring = bStart;
	if( invar_Buffring == false)	private_subject_show(-1);
}

// 등록 되어 있는 카테고리가 있는지 체크
function private_category_search( ca_name)
{
	var i=0;

	for( i=0; i<invar_category_num; i++)
		if( invar_category_name[i] == ca_name) return i;
	return -1;
}

// 음악 배열 구성
function private_loadMusicList( category, url, title, context, no, caption_url)
{
	var tmp;

	if( invar_MusicCount == 0){
		invar_MusicUrl = new Array();
		invar_MusicCaptionUrl = new Array();
		invar_MusicTitle = new Array();
		invar_MusicContext = new Array();
		invar_MusicUse = new Array();
		invar_MusicCategory = new Array();
		invar_CurrentTrack=0;
	}

	if( invar_category_num == 0){
		invar_category_num=1;
		invar_category_name = new Array();
		invar_category_count = new Array();
		invar_category_db_no = new Array();

		invar_category_name[invar_category_num-1]=category;
		invar_category_count[invar_category_num-1]=1;
		invar_category_db_no[invar_category_num-1]=no;
		invar_MusicCategory[invar_MusicCount]=invar_category_num-1;
	}else{
		tmp=private_category_search( category);
		
		if( tmp != -1){
			invar_category_count[tmp]++;
			invar_MusicCategory[invar_MusicCount]=tmp;
		}else{
			invar_category_name[invar_category_num]=category;
			invar_category_count[invar_category_num]=1;
			invar_category_db_no[invar_category_num]=no;
			invar_MusicCategory[invar_MusicCount]=invar_category_num;
			invar_category_num++;
		}
	}

	invar_MusicUrl[invar_MusicCount]=url;
	invar_MusicCaptionUrl[invar_MusicCount]=caption_url;
	invar_MusicTitle[invar_MusicCount]=title;
	if( invar_context_show && invar_use_context) invar_MusicContext[invar_MusicCount]=context;
	invar_MusicUse[invar_MusicCount]=true;
	invar_MusicCount++;
}

// 선택한 음악의 개수 리턴.
function private_use_count()
{
	var tmp=0;
	for( i=0; i<invar_MusicCount; i++)
		if( invar_MusicUse[i] == true) tmp++;
	return tmp;	
}

// 선택한 음악이 사용자가 선택한 것인가를 체크. 만약 부당한 것이면 다른 곡 리턴
function private_Check_Use(select_num, positive)
{
	var tmp=select_num;

	if( tmp >= 0 && tmp < invar_MusicCount){
		do{
			if( invar_MusicUse[tmp] == false){		
				tmp+=positive;
				if( tmp == invar_MusicCount) tmp=0;
				if( tmp == -1) tmp=invar_MusicCount-1;
			}else return tmp;
		}while( tmp != select_num);

		return tmp;
	}else
		return -1;
}

// Random Play
function private_RandomPlay()
{
	var tmp, tmp2;

	if( invar_MusicCount <= 1){
		private_PlayMusic( invar_CurrentTrack);		
	}else{
		if( private_use_count() <= 1){
			private_PlayMusic( invar_CurrentTrack);
		}else{
			do{
				tmp = Math.floor( Math.random() * invar_MusicCount);
				if( tmp != invar_CurrentTrack) break;
			}while(1);

			tmp2 = private_Check_Use( tmp, 1);
			if( tmp2 == invar_CurrentTrack) tmp2 = private_Check_Use(tmp,-1);
			private_PlayMusic( tmp2);
		}
	}
}

// Mute off (소리를 켠다)
function private_Sound_On()
{
	document.Sarangbi_Bgm.mute = false;
	if( invar_mute_image_show) sub_ChangeMuteImage();
	private_subject_show(-1);
}


// Mute On (소리를 끈다.)
function private_Sound_Off()
{
	document.Sarangbi_Bgm.mute = true;
	sub_ChangeMuteImage();
	private_subject_show(-1);

}


////////////////////////////////////////////////////////////////////
// 외부 함수
////////////////////////////////////////////////////////////////////

// 현재 카테고리의 음악만 듣기 체크
function method_only_this_category( select_category)
{
	var i;

	for( i=0; i<invar_MusicCount; i++){
		if( select_category == '-1') invar_MusicUse[i] = true;
		else{
			if( invar_MusicCategory[i] == select_category) invar_MusicUse[i] = true;
			else
				invar_MusicUse[i] = false;
		}
	}
}

// Next 버튼 눌렀을 때 실행하는 함수
function method_NextButtonPush()
{
	private_Sound_On();

	if( invar_RandomPlay)
		private_RandomPlay();
	else{
		if( invar_CurrentTrack == invar_MusicCount-1)
			invar_CurrentTrack = 0;
		else
			invar_CurrentTrack++;

		invar_CurrentTrack=private_Check_Use( invar_CurrentTrack,1);
		private_PlayMusic( invar_CurrentTrack);
	}
}

// Previous 버튼 눌렀을 때 실행하는 함수
function method_PreviousButtonPush()
{
	private_Sound_On();

	if( invar_RandomPlay)
		private_RandomPlay();
	else{
		if( invar_CurrentTrack == 0)
			invar_CurrentTrack=invar_MusicCount-1;
		else
			invar_CurrentTrack--;

		invar_CurrentTrack=private_Check_Use( invar_CurrentTrack,-1);
		private_PlayMusic( invar_CurrentTrack);
	}
}

// Mute 버튼 눌렀을 때 실행하는 함수
function method_MuteButtonPush()
{
	if( document.Sarangbi_Bgm.mute == true)
		private_Sound_On();
	else
		private_Sound_Off();
}

// Pause 버튼 눌렀을 때 실행하는 함수
function method_PauseButtonPush()
{
	var tmp = private_GetObjectState();

	if( tmp == 1){
		document.Sarangbi_Bgm.Play();
		private_start_time();
		private_SetObjectState(2);
	}else if( tmp == 2){
		document.Sarangbi_Bgm.Pause();
		private_SetObjectState(1);
		if( invar_timer != -1){
			clearInterval( invar_timer);
			invar_timer=-1;
		}
	}
	private_Sound_On();
	private_ChangeEqual(-1)
}

// Stop 버튼 눌렀을 때 실행하는 함수
function method_StopButtonPush()
{
	document.Sarangbi_Bgm.stop();
	private_SetObjectState(0);
	private_ChangeEqual(-1);
	private_subject_show(-1);
	private_context_show(-1);
	private_clear_time();
	private_caption_control("");
	if( invar_play_stop_show) sub_ChangePlayStopImage(0);
}

// Volumn Up 버튼 눌렀을 때 실행하는 함수
function method_VolumnUpButtonPush()
{
	private_Sound_On();

	if( document.Sarangbi_Bgm.Volume < 0)
		document.Sarangbi_Bgm.Volume +=200;

	private_ChangeEqual(-1);
}

// Volumn Down 버튼 눌렀을 때 실행하는 함수
function method_VolumnDownButtonPush()
{
	private_Sound_On();

	if( document.Sarangbi_Bgm.Volume > -4000)
		document.Sarangbi_Bgm.Volume -=200;

	private_ChangeEqual(-1);
}

// Play 버튼 눌렀을 때 실행하는 함수
function method_PlayButtonPush()
{
	private_Sound_On();

	switch( private_GetObjectState()){
		case 1: document.Sarangbi_Bgm.Play();
				private_start_time();
				private_SetObjectState(2);
				private_ChangeEqual(-1);
				break;
		case 2: break;
		case 0: 
				if( invar_RandomPlay){
					private_RandomPlay();
				}else{
					invar_CurrentTrack=private_Check_Use( invar_CurrentTrack,1);
					private_PlayMusic(invar_CurrentTrack);
				}
				break;
	}
}

// Loop 버튼 눌렀을 때 실행하는 함수
function method_LoopButtonPush()
{
	if( invar_Loop)
		invar_Loop=false;
	else
		invar_Loop=true;

	sub_ChangeLoopImage();
}

// Random 버튼 눌렀을 때 실행하는 함수
function method_RandomButtonPush()
{
	if( invar_RandomPlay)
		invar_RandomPlay=false;
	else
		invar_RandomPlay=true;
	sub_ChangeRandomImage();

}

// Play, Stop 토글 버튼
function method_PlayStopButtonPush()
{
	switch( private_GetObjectState()){
		case 2: method_StopButtonPush();
				break;
		default: method_PlayButtonPush();
				break;
	}
}
// =====================================================================================