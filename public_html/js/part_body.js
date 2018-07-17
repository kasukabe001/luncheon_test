function TopWindow(oid,cmod,token){
	var rand = Math.floor( Math.random() * 1000 ) + 1;
	if (cmod == 0) {
		if (token==1) {
			fname="../mypage.php?oid=" + oid + "&_act=Login&move=600";
		} else {
			fname="../mypage.php?oid=" + oid + "&_act=Login";
		}
	} else {
		fname="../mypage.php?oid=" + oid + "&_act=Login";
	}
	w=window.open(fname,"Detail","width=820,height=800,status=no,resizable=Yes,directories=no,scrollbars=yes,screenX=1,left=1,screenY=1,top=1");
}
function TopWindowClose(){
	w.close();
}

// *************************
// リロード
// *************************
function rCheck(){
//alert (window.name);
	if (window.name != "xyz")
	{
//		alert("リロードしました");
		window.location.reload();
		window.name = "xyz";
	}
}
function rCheck2(){
	window.name = "abc";
	rCheck();
}

function winscr(){
	window.name = "abc";
}

function show(e,popmsg) {
  if(document.all){ // IE
	x = event.clientX;
	y = event.clientY;
    var scrollLeft = document.body.scrollLeft; //スクロール量を取得
    var scrollTop  = document.body.scrollTop; // スクロール量を取得
    var hosei = 0;  //右側項目の画面切れ対応
    if (x>800) { hosei=250;}

	document.all("poplay").innerHTML = popmsg;

	document.all("poplay").style.pixelLeft = x+10+scrollLeft-hosei;
	document.all("poplay").style.pixelTop = y-20+scrollTop;
	document.all("poplay").style.pixelWidth = 220;
	document.all("poplay").style.visibility = "visible";
  } else if(document.layers||document.getElementById) {
	x = e.clientX;
	y = e.clientY;
//    var scrollLeft = window.pageXoffset; //スクロール量を取得
//    var scrollTop  = window.pageYoffset; // スクロール量を取得

    var hosei = 0;  //右側項目の画面切れ対応
    if (x>800) { hosei=200;}

//alert (scrollLeft);
//	document.layers["poplay"].innerHTML = popmsg;

//	document.layers["poplay"].left = x+10+scrollLeft-hosei;
//	document.layers["poplay"].top = y-20+scrollTop;
//	document.layers["poplay"].Width = 190;
//	document.layers["poplay"].visibility = "show";
  }
}

function hide(){
if(document.all){
	document.all("poplay").style.visibility = "hidden";
}
if(document.layers){
	document.layers["poplay"].visibility = "hidden";
}

}
//タグの書き込み

if(document.all){	
	document.write('<DIV id="poplay" align=left style="position:absolute;background-color:#ffcc66;font-size:11pt;border: double;padding: 5px;"></DIV>');
}
if(document.layers){
	document.write('<LAYER visibility="hide" bgcolor="#cccccc"></LAYER>');
}

function setcolor(obj0,sw1) {
  if (sw1 == 0) {
    fgc = '';
    bgc = '';
  } else {
    fgc = '#ff0000';
    bgc = '#EBEBEB';
  }
  obj0.style.color = fgc;
  obj0.style.backgroundColor = bgc;

}

// *************************
// 不正遷移チェック
// *************************
// 現在使用せず
function senichk(n) {
// 他サーバからIFRAMEを実行し、URLを取得エラーになった場合
alert (n);
  if (n==1) {
    var err = function(){
      window.location.replace("https://www.reg-clinkage.jp/kyousai/error.html");
    }

    window.onerror = err; // エラーハンドラ
    purl=parent.location.href;
    psearch=parent.location.search;

//document.write(purl);
// URLからpart_divを直接打ち込んだ場合を検出
    if (purl.search(/part_div.php/i) != -1) { // -1は該当データなし 
	window.location.replace("https://www.reg-clinkage.jp/kyousai/error.html");
    }
// 他サーバからIFRAMEを実行した場合を検出
    if (psearch.search(/p=a2056d89034875/i) == -1) { // -1は該当データなし 
	if (psearch.search(/p=5c549rw87867667/i) == -1) { // -1は該当データなし 
		if (psearch.search(/p=w601e05727868da/i) == -1) { // -1は該当データなし 
			window.location.replace("https://www.reg-clinkage.jp/kyousai/error.html");
		}
	}
    }
  }
}

