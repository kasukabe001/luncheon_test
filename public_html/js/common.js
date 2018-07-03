//
function reqAction(_act) {
    document.form1._act.value = _act;
    document.form1.submit();
return;
}

// 担当者 reload
function reqReload() {
    if(confirm('保存していないデータはクリアされます。\n よろしいですか？')) {
	location.href="?_mod=Tantou&_type=Edit&_act=Reload";
	return true;
    } else {
	return false;
    }
}


// 管理者ページで使用
// 担当者
function reqTantouList(_mod, _act, ta_id) {
    document.form1._mod.value       = _mod;
    document.form1._act.value        = _act;
    document.form1.ta_id.value = ta_id;
    document.form1.submit();
}

function coreponWindow(semi_id){
    fname2="./admincl/corepon.php?p=" + semi_id ;
    popup = window.open(fname2,"コレポン","width=520,height=580,resizable=no,directories=no,scrollbars=no,screenX=1,left=680,screenY=1,top=0");
}

function doDialog(){
    st="領域";
    var fname = "./admincl/ryoiki.html";
    var x=showModalDialog(fname,st,'status:no;resizable:yes;help:no;dialogWidth:190px;dialogHeight:300px');
//    d1.innerHTML= x;
    if (typeof(x) == "undefined") {
	return;
    }
    if (x != "" && x != null) {
	document.form1.ryoiki.value=x;
    }
}

function doDialogAll(objF,i){
    if (i<=10) {
        st="手配先";
        toName = "tehaisaki" + i;
	var fname = "./admincl/tehaisaki.html";
    } else if (i==11) {
        st="コプロ";
        toName = "syukan";
	var fname = "./admincl/copro.php";
    } else if (i==12) {
        st="コプロ";
        toName = "syukan2";
	var fname = "./admincl/copro.php";
    } else if (i>=14 && i<=16) {
        st="役職";
	j= i - 13;
        fromName = "chair" + j;
        toName = "cyaku" + j;
	var fname = "./admincl/yakushoku.php?name=" + encodeURI(objF.elements[fromName].value);
    } else if (i>=17 && i<=26) {
        st="役職";
	j= i - 16;
        fromName = "enshaname" + j;
        toName = "enshayaku" + j;
	var fname = "./admincl/yakushoku.php?name=" + encodeURI(objF.elements[fromName].value);
    } else if (i>=31 && i<=49) {
        st="手配物";
	j= i - 30;
        toName = "th_hinmei" + j;
	var fname = "./admincl/tehai_hikae.php?th_code=1";
    } else if (i>=61 && i<=79) {
        st="手配物";
        toName = "th_hinmei" + i;
	var fname = "./admincl/tehai_hikae.php?th_code=2";
    } else if (i>=91 && i<=99) {
        st="人員配置";
	j= i - 90;
        toName = "ji_yakuwari" + j;
	var fname = "./admincl/ji_haichi.php";
    }
    var x=showModalDialog(fname,st,'status:no;resizable:yes;help:no;dialogWidth:190px;dialogHeight:300px');

    if (typeof(x) == "undefined") {
	return;
    }
    if (x != "" && x != null) {
	objF.elements[toName].value=x; 
    }

}

// 手配物,人員配置の追加
function AddLine(i,id){

    if(confirm('データを追加します。保存していないデータはクリアされます。\n よろしいですか？')) {
//	return true;
    } else {
	return false;
    }

  if (i < 3 ) { // 手配物
    location.replace("./admincl/addtehai.php?sb=" + i + "&semi_id=" + id);
  } else if (i == 3 ) { // 人員
    location.replace("./admincl/addjinin.php?sb=" + i + "&semi_id=" + id);
  } else { // chair4 speaker5
    location.replace("./admincl/addzaen.php?sb=" + i + "&semi_id=" + id);
  }
}
// 手配物,人員配置の削除
function DelLine(i,id){

    if(confirm('データを削除します。\n よろしいですか？')) {
//	return true;
    } else {
	return false;
    }

  var val = "";
  if (i==1) {
    if (document.form1.th_del1.checked == true) val = "1:";
    if (document.form1.th_del2.checked == true) val = val + "2:";
    if (document.form1.th_del3.checked == true) val = val + "3:";
    if (document.form1.th_del4.checked == true) val = val + "4:";
    if (document.form1.th_del5.checked == true) val = val + "5:";
    if (!!document.form1.th_del6){
      if (document.form1.th_del6.checked == true) val = val + "6:";
    }
    if (!!document.form1.th_del7){
      if (document.form1.th_del7.checked == true) val = val + "7:";
    }
    if (!!document.form1.th_del8){
      if (document.form1.th_del8.checked == true) val = val + "8:";
    }
    if (!!document.form1.th_del9){
      if (document.form1.th_del9.checked == true) val = val + "9:";
    }
    if (!!document.form1.th_del10){
      if (document.form1.th_del10.checked == true) val = val + "10:";
    }
    if (!!document.form1.th_del11){
      if (document.form1.th_del11.checked == true) val = val + "11:";
    }
    if (!!document.form1.th_del12){
      if (document.form1.th_del12.checked == true) val = val + "12:";
    }
  } else if (i == 2) {
    if (document.form1.th_del61.checked == true) val = "61:";
    if (document.form1.th_del62.checked == true) val = val + "62:";
    if (document.form1.th_del63.checked == true) val = val + "63:";
    if (document.form1.th_del64.checked == true) val = val + "64:";
    if (document.form1.th_del65.checked == true) val = val + "65:";
    if (!!document.form1.th_del66){
      if (document.form1.th_del66.checked == true) val = val + "66:";
    }
    if (!!document.form1.th_del67){
      if (document.form1.th_del67.checked == true) val = val + "67:";
    }
    if (!!document.form1.th_del68){
      if (document.form1.th_del68.checked == true) val = val + "68:";
    }
    if (!!document.form1.th_del69){
      if (document.form1.th_del69.checked == true) val = val + "69:";
    }
    if (!!document.form1.th_del70){
      if (document.form1.th_del70.checked == true) val = val + "70:";
    }
    if (!!document.form1.th_del71){
      if (document.form1.th_del71.checked == true) val = val + "71:";
    }
    if (!!document.form1.th_del72){
      if (document.form1.th_del72.checked == true) val = val + "72:";
    }
    if (!!document.form1.th_del73){
      if (document.form1.th_del73.checked == true) val = val + "73:";
    }
    if (!!document.form1.th_del74){
      if (document.form1.th_del74.checked == true) val = val + "74:";
    }
    if (!!document.form1.th_del75){
      if (document.form1.th_del75.checked == true) val = val + "75:";
    }
    if (!!document.form1.th_del76){
      if (document.form1.th_del76.checked == true) val = val + "76:";
    }
    if (!!document.form1.th_del77){
      if (document.form1.th_del77.checked == true) val = val + "77:";
    }
  } else if (i == 3) {
    if (document.form1.ji_del1.checked == true) val = "1:";
    if (document.form1.ji_del2.checked == true) val = val + "2:";
    if (document.form1.ji_del3.checked == true) val = val + "3:";
    if (document.form1.ji_del4.checked == true) val = val + "4:";
    if (!!document.form1.ji_del5){
      if (document.form1.ji_del5.checked == true) val = val + "5:";
    }
    if (!!document.form1.ji_del6){
      if (document.form1.ji_del6.checked == true) val = val + "6:";
    }
    if (!!document.form1.ji_del7){
      if (document.form1.ji_del7.checked == true) val = val + "7:";
    }
    if (!!document.form1.ji_del8){
      if (document.form1.ji_del8.checked == true) val = val + "8:";
    }
    if (!!document.form1.ji_del9){
      if (document.form1.ji_del9.checked == true) val = val + "9:";
    }
  }

  if (val == "") {
    alert ("削除するデータが選択されていません!");
    return false;
  }

  if (i < 3 ) { // 手配物
    location.replace("./admincl/deltehai.php?sb=" + i + "&semi_id=" + id + "&val=" + val);
  } else if (i == 3 ) { // 人員
    location.replace("./admincl/deljinin.php?sb=" + i + "&semi_id=" + id + "&val=" + val);
  }
}

// 上の行の値をコピー
function doCopy(objF,fromName,toName){
    objF.elements[toName].value 
     = objF.elements[fromName].value;
}

