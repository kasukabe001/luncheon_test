// 2016.8.21 データ移行中に追加
var poptext = "";
var popvisible = 0;
document.write("<div id='PopupText' style='visibility:hidden;'></div>");
window.document.onmousemove = getMouseXY;
//使う範囲を限定したい場合は、この部分を以下のようにしてください。(「ID名」は任意)
//window.document.getElementById("ID名").onmousemove = getMouseXY;
//そして使う時には、以下のように、使用したい部分を囲ってください。
//<div id="ID名">使用したい部分</div>
function getMouseXY(PopEvent){
  Popup=document.getElementById("PopupText");
  if(popvisible == 1){
    if (undefined !== window.ActiveXObject) {//IE
      var __base__scroll__;
      if(document.compatMode=='CSS1Compat') {//IEモード1
        __base__scroll__ = document.documentElement;
        x = __base__scroll__.scrollLeft + event.clientX;
        y = __base__scroll__.scrollTop + event.clientY;
      }
      else {//IEモード2
        x = document.body.scrollLeft + event.clientX;
        y = document.body.scrollTop + event.clientY;
      }
    }
    else{//IE以外
      x = PopEvent.pageX + 0; //ズレる場合は数値を変えてください
      y = PopEvent.pageY + 0;
    }
    Popup=document.getElementById("PopupText");
    Popup.innerHTML = poptext;
    Popup.style.position = "absolute";
    Popup.style.zIndex = 10000;
    Popup.style.margin = 0 + "px";
    //----- 自由に変更（吹き出しデザイン）　ここから -----
    //変更したくない部分は、スラッシュ２個（//）でコメントアウトしてください。
    Popup.style.left = x + 0 + "px"; //マウスからの横座標（吹き出し位置）
    Popup.style.top = y + 15 + "px"; //マウスからの縦座標（吹き出し位置）
    Popup.style.maxWidth = 300 + "px"; //横幅の最大値
    Popup.style.border = "solid #45A966 2px"; //枠色・太さ #bb7f44
    Popup.style.padding = 3 + "px"; //枠内の余白
    Popup.style.color = "#333333"; //文字色
    Popup.style.fontSize = 13 + "px"; //文字サイズ
    Popup.style.fontFamily = "Osaka","ＭＳ Ｐゴシック","sans-serif"; //文字種類（左から優先）
    Popup.style.lineHeight = '1.25'; //行と行の間隔
    Popup.style.backgroundColor = "#F1FED8"; //背景色 #eeeeaa
    //----- 自由に変更（吹き出しデザイン）　ここまで -----
    Popup.style.visibility = "visible";
  }
  else{ Popup.style.visibility = "hidden"; }
}

