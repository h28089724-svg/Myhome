<?
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

///////////////////////////////////////////////////////////
// 사랑비 BGM 관리 도구
// ================================
// * 주 의 * 이 파일은 수정 하지 마세요.
///////////////////////////////////////////////////////////

if( $mode=='') $mode='main';

// DB가 설정이 되었는지를 검사
if(!file_exists("db_conn.php")){
 echo"<meta http-equiv=\"refresh\" content=\"0; url=install.php\">";
 exit;
}
require "db_conn.php";
require "admin/common.php";

// 변수 선언
$max_write = 5;

// 로그인 처리
if( $mode == 'login_check'){
	global $pw;

	$connect=db_conn();
	$data = mysql_query( "select pw from sarangbi_setup_".$table." where no=1", $connect) or error(mysql_error());

	$db_pw=mysql_fetch_array($data);

	db_close();
	$pw=mysql_fetch_array(mysql_query("select password('$pw')"));

	if( $pw[0] == $db_pw[pw] && $pw != ''){
		setcookie("sarangbi_bgm_chk_".$table,"ok",0);
		movepage($PHP_SELF."?mode=main");
	}else{
		include "admin/top.php";
		echo "<br><br><br><br><br><br><br><br><br><font color=red>암호가 틀렸습니다. 다시 입력하세요.";
		include "admin/login.php";
		include "admin/tail.php";
		exit;
	}


}

// 로그 아웃 처리
if( $mode == 'logout'){
	setcookie("sarangbi_bgm_chk_".$table,"logout",0);
	echo "
		<script language=javascript>
		window.close();
		</script>";
}

include "admin/top.php";

switch( $mode){
	case "main"			: include "admin/main.php"; break;
	case "setup"		: include "admin/setup.php"; break;
	case "setup_write"	: include "admin/setup_write.php"; break;
	case "change_pw"	: include "admin/change_pw.php"; break;
	case "pw_write"		: include "admin/change_pw_write.php"; break;
	case "list"			: include "admin/list.php";	break;
	case "category"		: include "admin/category.php"; break;
	case "category_wrt"	: include "admin/category_wrt.php"; break;
	case "category_mod" : include "admin/category_mod.php"; break;
	case "category_del"	: include "admin/category_del.php"; break;
	case "ftp_set"		: include "admin/ftp_set.php"; break;
	case "ftp_add"		: include "admin/ftp_add.php"; break;
	case "ftp_save"		: include "admin/ftp_save.php"; break;
	case "ftp_test"		: include "admin/ftp_test.php"; break;
	case "ftp_del"		: include "admin/ftp_del.php"; break;
	case "link"			: include "admin/link.php"; break;
	case "link_write"	: include "admin/link_write.php"; break;
	case "upload"		: include "admin/upload.php"; break;
	case "upload_write"	: include "admin/upload_write.php"; break;
	case "ftp_upload"	: include "admin/upload.php"; break;
	case "ftp_write"	: include "admin/ftp_write.php"; break;
	case "list_del"		: include "admin/list_del.php"; break;
	case "list_del_ok"	: include "admin/list_del_ok.php"; break;
	case "list_mc"		: include "admin/list_mc.php"; break;
	case "list_mc_ok"	: include "admin/list_mc_ok.php"; break;
	case "list_use_o"	: include "admin/list_use.php"; break;
	case "list_use_x"	: include "admin/list_use.php"; break;
	case "list_mod"		: include "admin/list_mod.php"; break;
	case "list_mod_ok"	: include "admin/list_mod_ok.php"; break;
	case "list_up"	: include "admin/list_up.php"; break;
	default				: include "admin/main.php"; break;
}

include "admin/tail.php";
?>