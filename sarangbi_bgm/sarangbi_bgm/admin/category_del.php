<? require "admin/login_check.php";
$connect=db_conn();

$delete_query = "delete from sarangbi_category_".$table." where no=".$num;

mysql_query( $delete_query, $connect) or error(mysql_error());
?>
<br><br><br><br><br>
카테고리를 삭제 하였습니다.<br>
<br>
<a href='<?=$PHP_SELF?>?mode=category'><img src='admin/img/ok.gif' border=0></a>

<?
db_close();
?>