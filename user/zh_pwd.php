<?php
session_start();
include_once("./Config/Config.php");
if(!$isFP) die("�ܱ�Ǹ,�һ����빦���ѹر�.");
if($_POST){
	//�ύ
	include_once("./Class/function_common.php");	
	$illegal=illegalsubmit();
	if(!$illegal) die("��ֹ�Ƿ��ύ");
	$POST=Addslashess($_POST);
	//��֤��
	if($isPin){
		if($POST['Pin']!=$_SESSION['Pin'])
		{
			die("<script>alert('��֤�����,����������');history.back();</script>");	
		} 
	}
	include_once("./Class/mysql_new_class.php");	
	$connobj=new mysql_class($SQLhost,$SQLuser,$SQLPWD,$DATABASE);
	//�˺��Ƿ����
	$sql="select passport,super from sys_user where passport='$POST[_user_name]'";
	$arr=$connobj->queryrow($sql);
	if(!$arr)
	{
		die("<script>alert('�˺Ų�����,�һ�����ʧ��');history.back();</script>");;	
	}elseif($POST['_user_superpwd']!=$arr['super']){
		die("<script>alert('�������벻��ȷ,�һ�����ʧ��');history.back();</script>");	
	}
	$newpwd=$POST['_user_newpasswd'];
	$sql="update sys_user set password='$newpwd' where passport='$arr[passport]'";
	$connobj->querysql($sql);
	die("<script>alert('�һ�����ɹ�,���μ����������');window.close();</script>");		
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml"><HEAD id=Head1><TITLE>�һ�����</TITLE>
<META http-equiv=Content-Type content="text/html; charset=gb2312">
<LINK 
href="images/user_basic2.0.css" 
type=text/css rel=stylesheet><LINK 
href="images/user_zhgl2.0.css" 
type=text/css rel=stylesheet>
<STYLE>.tl {
	COLOR: #000; TEXT-DECORATION: none
}
.tlon {
	COLOR: red; TEXT-DECORATION: underline
}
</STYLE>
<META content="MSHTML 6.00.6000.21228" name=GENERATOR></HEAD>
<BODY>
<FORM id="form1" name="form1" onSubmit="return frmCheck()" action="" method="post">
<DIV class=ctn>
<DIV class=top_1>
<DIV id=mian>
  <DIV class=ctn_right>
<DIV class=wel></DIV>
<DIV class=fm-item><LABEL class=fm-label><SPAN 
class=required>*</SPAN>��Ϸ�˺ţ�</LABEL> <INPUT class="i-text f_l" id=_user_name name="_user_name"> 
<DIV class=fm-explain id=_user_name_info>����дע��ʱ����д����Ϸ�˺�.</DIV>
</DIV>
<DIV class=fm-part>
<DIV class=fm-part>
<DIV class=fm-item><LABEL class=fm-label><SPAN 
class=required>*</SPAN>�������룺</LABEL> <INPUT class="i-text f_l" id=_user_superpwd 
type=password name=_user_superpwd> 
<DIV class=fm-explain id=_user_superpwd_info>����дע��ʱ����д�ĳ�������.</DIV>
</DIV>
<DIV class=fm-item><LABEL class=fm-label><SPAN 
class=required>*</SPAN>�� �� �룺</LABEL> <INPUT class="i-text f_l" id=_user_newpasswd 
type=password name=_user_newpasswd> 
<DIV class=fm-explain id=_user_passwd_info>4-16λ����ĸ���ִ�Сд�������÷��š�.��</DIV></DIV>
<?php if($isPin){ ?>
<DIV class="fm-item "><LABEL class="fm-label  f_l" for=check_code><SPAN 
class=required>*</SPAN>��֤�룺</LABEL> <INPUT class="i-text i-text-authcode  f_l" 
id=Pin alt=������ͼ�е�4λ���֡� maxLength=4 name=Pin><img src="Pin.php" style="cursor:pointer" onClick="this.src='Pin.php?'+Math.random()" /><span>������?�����֤��ˢ��</SPAN> 
<DIV class=fm-explain id=_rand_code_info>������ͼƬ����֤���������ִ�Сд��</DIV></DIV>
<DIV class=kg></DIV>
<?php } ?>
<DIV class=fm-item>
 <INPUT id=submitbutton style="CURSOR: hand" type=image 
src="images/sm_btn_xyb1.gif" 
name=_doreg> 
<DIV class=fm-explain></DIV></DIV><BR><BR></DIV></DIV>


<DIV class=foot></DIV></DIV>

</FORM>
</BODY></HTML>
<script language="javascript" type="text/javascript">
var aCity={11:"����",12:"���",13:"�ӱ�",14:"ɽ��",15:"���ɹ�",21:"����",22:"����",23:"������",31:"�Ϻ�",32:"����",33:"�㽭",34:"����",35:"����",36:"����",37:"ɽ��",41:"����",42:"����",43:"����",44:"�㶫",45:"����",46:"����",50:"����",51:"�Ĵ�",52:"����",53:"����",54:"����",61:"����",62:"����",63:"�ຣ",64:"����",65:"�½�",71:"̨��",81:"���",82:"����",91:"����"}  
function cidInfo(sId)
{
    var iSum=0
    var info=""
    if(!/^\d{17}(\d|x)$/i.test(sId))
 {
        return false;
 }
    sId=sId.replace(/x$/i,"a");
    if(aCity[parseInt(sId.substr(0,2))]==null)
 {
     return false; 
 }
    sBirthday=sId.substr(6,4)+"-"+Number(sId.substr(10,2))+"-"+Number(sId.substr(12,2));
    var d=new Date(sBirthday.replace(/-/g,"/"))
    if(sBirthday!=(d.getFullYear()+"-"+ (d.getMonth()+1) + "-" + d.getDate()))
 {
     return false; 
 }
 
    for(var i = 17;i>=0;i --) 
 {
     iSum += (Math.pow(2,i) % 11) * parseInt(sId.charAt(17 - i),11) 
 }
    if(iSum%11!=1)
 {
     return false; 
 }
    return true;
}

</script>

<script language="JavaScript" type="text/javascript"> 
function $(obj)
{
	if(typeof obj == 'string') return document.getElementById(obj);
	else if(typeof obj == 'object') return obj;
	else return false;
}
function frmCheck()
{
	var un=$("_user_name").value;
	var re=/^[0-9a-zA-Z]{4,16}$/; //ֻ�������ֺ���ĸ������	   
	if(un.search(re)==-1)
	{
		alert("�˺����������ֺ���ĸ���ַ�����4��ʮ����");
		$("_user_name").focus();		
		return false;
	}
	var idcard=$("_user_idcard").value;
	var iscd=cidInfo(idcard);
	if(!iscd){
		alert("���֤��ʽ����");
		$("_user_idcard").focus();
		 return false; 				
	}	
	var ue = $("_user_email").value;
	if(ue == ""){ 
		 alert("��ȫ���䲻��Ϊ��");
		$("_user_email").focus();			  
		return false; 
	 }
	if (ue.charAt(0) == "." || ue.charAt(0) == "@" || ue.indexOf('@', 0) == -1|| ue.indexOf('.', 0) == -1 || ue.lastIndexOf("@") == ue.length-1 || ue.lastIndexOf(".") == ue.length-1){ 
		  alert("��ȫ�����ʽ����");
		  $("_user_email").focus();			  
		  return false; 		   	  	 		
	}
	var us=$("_user_superpwd").value;
	if(us.length<4 || us.length>16){
		  alert("����������4-16λ֮��");
		  $("_user_superpwd").focus();              
		  return false; 	
	}
	var unew=$("_user_newpasswd").value;
	if(unew.length<4 || unew.length>16)
	{
		  alert("�����������4-16λ֮��");	
		  $("_user_newpasswd").focus();
		  return false; 		  
	}
	if(unew.indexOf(".")>=0)
	{
		  alert("�����벻�ܺ� . ");	
		  $("_user_newpasswd").focus();	
		  return false; 		  	
	}
	//$("form1").submit();						 
	//return true;
}
</script>