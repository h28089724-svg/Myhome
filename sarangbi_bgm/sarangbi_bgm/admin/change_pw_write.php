<? require "admin/login_check.php"; 


$tmp_error=false;

if( isblank($newpw1)){
	$tmp_error=true;
	$tmp_msg="새로운 비밀 번호가 공백입니다.";
}

$connect=db_conn();

$data = mysql_query( "select pw from sarangbi_setup_".$table." where no=1", $connect) or error(mysql_error());

$db_pw=mysql_fetch_array($data);

$oldpw=mysql_fetch_array(mysql_query("select password('$oldpw')"));
$newpw=mysql_fetch_array(mysql_query("select password('$newpw1')"));

if( $tmp_error == false && $oldpw[0] == $db_pw[pw]){
	$update_query="update sarangbi_setup_".$table." set pw='$newpw[0]'";
	mysql_query( $update_query, $connect) or error(mysql_error());
	db_close();
}else{
	if( $tmp_error == false) $tmp_msg="이전 비밀번호가 올바르지 않습니다.";
	$tmp_error=true;
}

echo "<br><br><br><br><br><br><br><br><br><br>";
if( $tmp_error){
	echo "<font color=red>".$tmp_msg;
	echo "<br>비밀 번호를 변경하지 못했습니다.</font>";
	echo "<br><br><a href='$PHP_SELF?mode=change_pw'><img src='admin/img/ok.gif' border=0></a>";
}else{
	echo "비밀 번호를 변경 하였습니다.";
	echo "<br><br><a href='$PHP_SELF?mode=setup'><img src='admin/img/ok.gif' border=0></a>";
}
db_close();