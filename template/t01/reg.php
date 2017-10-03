<?php
/**
 * @package base
 * @version 0.1.0.0
 * @author 田勇 Alias tybitsfox <tybitsfox@163.com>
 * @copyright (c) 2017 by tybitsfox
 * @license GPLv2
 * 
 * 本文件是土壤环境信息系统其中的一个文件
 * Available at http://202.102.134.68
 *
 * 这一程序是自由软件，你可以遵照自由软件基金会出版的GNU通用公共许可证条款来修改和重新
 * 发布这一程序。或者用许可证的第二版，或者（根据你的选择）用任何更新的版本。
 *
 * 发布这一程序的目的是希望它有用，但没有任何担保。甚至没有适合特定目的的隐含的担保。更
 * 详细的情况请参阅GNU通用公共许可证。
 *
 * 你应该已经和程序一起收到一份GNU通用公共许可证的副本。如果还没有，请查阅：
 * <http://www.gnu.org/licenses/>.
 * 或者写信给： The Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston,
 * MA  02111-1307  USA
 */
?>
<style>
#clear
{clear:both;}
ul li{list-style-type:none;}
div{text-align:center;}
.aas_class
{background-color:#F3F3F3;margin:0 auto;padding:0;width:40%;}
#div1
{background-color:#F3F3F3;width:40%;margin:0 auto;padding:20px 0;}
#da1
{background-color:#F3F3F3;width:30%;margin:0 auto;padding:0px 0;float:left;}
#da2
{background-color:#F3F3F3;width:70%;margin:0 auto;padding:0px 0;}
#da3
{background-color:#F3F3F3;width:100%;margin:0 auto;padding:0px 0;}
</style>
<?php
session_start();
if(!isset($_SESSION['leftcnt']))
	$_SESSION['leftcnt']=4;
else
{
	if($_SESSION['leftcnt']<=0)
		die("fuck you~");
}
if(!defined("FULL_PATH"))
{
	$s1=dirname(__FILE__);
	$s2=strstr($s1,"gis_hb");
	$i=strlen($s1)-strlen($s2);
	$s2=substr($s1,0,$i)."gis_hb/";
	define("FULL_PATH",$s2);
}
$str=constant("FULL_PATH")."config/main.php";
require_once($str);
$str=constant("FULL_PATH")."interface/main.php";
require_once($str);
?>
<?php
header("Content-Type:text/html;charset=UTF-8");
if($_SESSION['leftcnt'] < 0)
{
//	header("Refresh:2 url=./index.php");
	die("fuck you~");
}
global $tybitsfox;
?>
<html><head><title><?php echo $tybitsfox['title'];?></title></head><body>
<?php
die("<center><font color=blue size=5>新用户的密码获取，请与管理员联系</font></center>");
?>
<form name="register" method="post" action="./reg.php">
<div><h2><?php echo $tybitsfox['regmsg'];?></h2></div>
<div class='ass_class'>
<div id='div1'>
<ul><li id='da1'>用户名：</li><li id='da2'><input type='text' name='user' size=30 /></li></ul>
<ul><li id='da1'>密码：</li><li id='da2'><input type='password' name='password' size=30 /></li></ul>
<ul><li id='da1'>再次输入密码：</li><li id='da2'><input type='password' name='password1' size=30 /></li></ul>
<ul><li id='da3'><input type='submit' name='submit' value='确定'/></li></ul>
</div></div>
</form>
</body></html>
<?php
if($_POST['submit'] == true)
{
	$_SESSION['leftcnt']-=1;
	$a=$_POST['user'];$b=$_POST['password'];$c=$_POST['password1'];
	$len=strlen($a);
	if(($len<3) || ($len>15))
	{
		die("<div>用户名输入有误</div>");
	}
	$len=strlen($b);
	if(($len<3) || ($len>15))
	{
		die("<div>密码输入有误</div>");
	}
	if(strcmp($b,$c) !=0)
	{
		die("<div>两次输入的密码不一致</div>");
	}
	if(_reg_db($_POST['user'],$_POST['password']) != 0)
	{
		die("<div>该用户已存在，请另选用户名</div>");
	}
	else
	{
		$_SESSION['logok'] = $tybitsfox['corename'];
		$_SESSION['leftcnt'] = 4;	$_SESSION['user']	= $_POST['user'];
		echo "<div>恭喜你注册成功！系统3秒钟后自动跳转</div>";
		header("Refresh:3 url=../../index.php");
	}
}
else
{
	if(!isset($_SESSION['leftcnt']))
		$_SESSION['leftcnt']=4;
}
?>






<?php
/*
 <?php
$db = new DBConnection;
$settings = new Settings_XML;
$user = new User;
// Register objects
$registry =& Registry::getInstance();
$registry->set ('db', $db);
$registry->set ('settings', $settings);
$registry->set ('user', $user);
function test() {
    $registry =& Registry::getInstance();
    $db =& $registry->get('db');
    $settings =& $registry->get('settings');
    $user =& $registry->get('user');
    // Do something with the objects
}
?>
 */
?>









