//ブラウザ判別
var ie=document.all?1:0
var ns6=document.getElementById&&!document.all?1:0
var opera=window.opera?1:0

//グローバル変数の宣言
var folder=''
var image=''
var sw="show.gif"		//フォルダ表示時のアイコン画像
var hd="hide.gif"		//フォルダ非表示時のアイコン画像

//フォルダの表示・非表示を実行する処理
function showFolder(subobj) {
	if (ie||ns6||opera) {
		folder=ns6?document.getElementById(subobj).style:document.all(subobj).style
		if (folder.display=="none") {
			folder.display=""
			image.src=sw
		} else {
			folder.display="none"
			image.src=hd
		}
	}
}

function KaraWindow(){
	popup = window.open("reload.php","UpWindow","width=640,height=500,resizable=no,directories=no,scrollbars=no,screenX=1,left=370,screenY=1,top=40");
}

function lockkaijo(semi_id) {
    location.replace("./admincl/unlock.php?id=" + semi_id);
}

function AdminClear() {
	document.formMembersSearch.searchField.value = "";
	document.formMembersSearch.SpInfo[0].checked=false;
	document.formMembersSearch.SpInfo[1].checked=false;
	document.formMembersSearch.SpInfo[2].checked=false;
	document.formMembersSearch.SpInfo[3].checked=false;
	document.formMembersSearch.SpInfo[4].checked=false;
	document.formMembersSearch.searchMode.selectedIndex = 0;
}

function moveto(n) {
	window.scrollTo(0, n);
}

