function SndWindow(i){
	if (i==0) {
		fname="../admincl/regform.html";
		if(confirm('新規データを追加します\n (2018年度,進行中,開催日は未定)\n\nよろしいですか？\n\n追加後はすみやかに正しい内容に更新してください')) {
			location.replace("../admincl/newdata.php");
			return true;
		} else {
			return false;
		}
		
	} else if (i==1) {
			fname="https://linkage-staff.jp/kyousai/manual/index.html";
	w1=window.open(fname,"help","width=720,,status=no,resizable=Yes,directories=no,scrollbars=yes,screenX=1,left=1,screenY=1,top=1");
	} else if (i==3) { // 管理ページ
			fname="../mypage.php?_mod=Admin";
	w1=window.open(fname,"Detail","width=930,,status=no,resizable=Yes,directories=no,scrollbars=yes,screenX=1,left=1,screenY=1,top=1");
	} else {
		var jouken="0000000";
		jouken = paraMake() + encodeURI(document.headform.g.value) + "&hm=" + encodeURI(document.headform.h.value) ;
		jouken = jouken + "&pl=" + encodeURI(document.headform.p.value) ;;
		jouken = jouken + "&ze=" + encodeURI(document.headform.z.value) ;
		fname="./download.php?pm=" + jouken;
	w=window.open(fname,"Detail","width=720,height=800,status=no,resizable=Yes,directories=no,scrollbars=yes,screenX=1,left=1,screenY=1,top=1");
	}
}

function SndWindowClose(){
	w.close();
//	parent.w.close();
}

////////////////////////////////////////////////////////////////////
// データ表示:インラインフレーム
////////////////////////////////////////////////////////////////////
function doAction( strValue ) {
// 全スクロールページに戻す場合
// obj.setAttributeをYesにする

	var base;
	var obj;

//	base = document.getElementById(strValue);
	base = boxC;
	base.innerHTML = "";

	// IFRAME 作成
	obj = document.createElement("iframe");
	// IFRAME の見栄え属性をセット
	obj.setAttribute("frameBorder", "0");
	obj.setAttribute("scrolling", "No");

	// IFRAME の配置属性をセット
	obj.style.position = "relative";
	obj.style.width = "100%";
	obj.style.height = "100%";
//	obj.style.scrolling = "auto";

	// IFRAME の内容をセット
	var jouken="00000000";
	if (strValue == 0) {

	} else {
		jouken = paraMake() + encodeURI(document.headform.g.value) + "&hm=" + encodeURI(document.headform.h.value) ;
		jouken = jouken + "&pl=" + encodeURI(document.headform.p.value) ;
		jouken = jouken + "&ze=" + encodeURI(document.headform.z.value) ;
		jouken = jouken + "&se=" + encodeURI(document.headform.seihin.value) ;
		jouken = jouken + "&sk=" + encodeURI(document.headform.soshiki.value) ;
		jouken = jouken + "&cl=" + encodeURI(document.headform.cl.value) ;
	}

	var rand = Math.floor( Math.random() * 1000 ) + 1;
	obj.src = "./part_div.php?ifra=" + jouken + "&p2=" + rand;

	// IFRAME を実装
	base.appendChild(obj);

}

////////////////////////////////////////////////////////////////////
// データ検索条件:パラメータ作成
////////////////////////////////////////////////////////////////////
function paraMake() {
  nnum="0";
  tnum="0";
  snum="0";
  rnum="0";
  znum="0";
  phase="0";

// 年度
	if (document.headform.n.selectedIndex <= 9 ) {
	  nnum="0" + document.headform.n.selectedIndex;
	} else if (document.headform.n.selectedIndex > 9 ) {
	  nnum= document.headform.n.selectedIndex;
	}


// 進捗
	if (document.headform.s.selectedIndex == 1 ) {
	  snum=1;
	} else if (document.headform.s.selectedIndex == 2 ) {
	  snum=2;
	}
//領域
	rnum=document.headform.r.selectedIndex;
// 月
	if (document.headform.t.selectedIndex <= 9 ) {
	  tnum="0" + document.headform.t.selectedIndex;
	} else if (document.headform.t.selectedIndex > 9 ) {
	  tnum= document.headform.t.selectedIndex;
	}
// 座長/演者
	if (document.headform.r1[0].checked == true ) {
	  znum=1; // 座長
	} else if (document.headform.r1[1].checked == true ) {
	  znum=2; // 演者
	}

// 新旧モード
	if (document.headform.phase[0].checked == true ) {
	  phase=1; // 2008年モード
	} else if (document.headform.phase[1].checked == true ) {
	  phase=2; // 2018年モード
	}

	param = ""+nnum+snum+rnum+tnum+znum+phase;
	return (param);
}

////////////////////////////////////////////////////////////////////
// データ検索条件クリア
////////////////////////////////////////////////////////////////////
function clrbtn() {
//	document.headform.c.checked = false;
// 年度
	document.headform.n.selectedIndex=0;
// 月
	document.headform.t.selectedIndex=0;
// 進捗
	document.headform.s.selectedIndex = 0;
//領域
	document.headform.r.selectedIndex = 0;
//学会名
	document.headform.g.value = "";
//会場
	document.headform.p.value = "";
//品目
	document.headform.h.value = "";
//座長・演者
	document.headform.z.value = "";
	document.headform.r1[0].checked=false;
	document.headform.r1[1].checked=false;
//製品担当
	document.headform.seihin.value = "";
//織化担当
	document.headform.soshiki.value = "";
//CL担当
	document.headform.cl.value = "";
}
