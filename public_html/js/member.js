// 2016.8.21 �ǡ����ܹ�����ɲ�
var poptext = "";
var popvisible = 0;
document.write("<div id='PopupText' style='visibility:hidden;'></div>");
window.document.onmousemove = getMouseXY;
//�Ȥ��ϰϤ���ꤷ�������ϡ�������ʬ��ʲ��Τ褦�ˤ��Ƥ���������(��ID̾�פ�Ǥ��)
//window.document.getElementById("ID̾").onmousemove = getMouseXY;
//�����ƻȤ����ˤϡ��ʲ��Τ褦�ˡ����Ѥ�������ʬ��ϤäƤ���������
//<div id="ID̾">���Ѥ�������ʬ</div>
function getMouseXY(PopEvent){
  Popup=document.getElementById("PopupText");
  if(popvisible == 1){
    if (undefined !== window.ActiveXObject) {//IE
      var __base__scroll__;
      if(document.compatMode=='CSS1Compat') {//IE�⡼��1
        __base__scroll__ = document.documentElement;
        x = __base__scroll__.scrollLeft + event.clientX;
        y = __base__scroll__.scrollTop + event.clientY;
      }
      else {//IE�⡼��2
        x = document.body.scrollLeft + event.clientX;
        y = document.body.scrollTop + event.clientY;
      }
    }
    else{//IE�ʳ�
      x = PopEvent.pageX + 0; //�������Ͽ��ͤ��Ѥ��Ƥ�������
      y = PopEvent.pageY + 0;
    }
    Popup=document.getElementById("PopupText");
    Popup.innerHTML = poptext;
    Popup.style.position = "absolute";
    Popup.style.zIndex = 10000;
    Popup.style.margin = 0 + "px";
    //----- ��ͳ���ѹ��ʿ᤭�Ф��ǥ�����ˡ��������� -----
    //�ѹ��������ʤ���ʬ�ϡ�����å��売�ġ�//�ˤǥ����ȥ����Ȥ��Ƥ���������
    Popup.style.left = x + 0 + "px"; //�ޥ�������β���ɸ�ʿ᤭�Ф����֡�
    Popup.style.top = y + 15 + "px"; //�ޥ�������νĺ�ɸ�ʿ᤭�Ф����֡�
    Popup.style.maxWidth = 300 + "px"; //�����κ�����
    Popup.style.border = "solid #45A966 2px"; //�ȿ������� #bb7f44
    Popup.style.padding = 3 + "px"; //�����;��
    Popup.style.color = "#333333"; //ʸ����
    Popup.style.fontSize = 13 + "px"; //ʸ��������
    Popup.style.fontFamily = "Osaka","�ͣ� �Х����å�","sans-serif"; //ʸ������ʺ�����ͥ���
    Popup.style.lineHeight = '1.25'; //�ԤȹԤδֳ�
    Popup.style.backgroundColor = "#F1FED8"; //�طʿ� #eeeeaa
    //----- ��ͳ���ѹ��ʿ᤭�Ф��ǥ�����ˡ������ޤ� -----
    Popup.style.visibility = "visible";
  }
  else{ Popup.style.visibility = "hidden"; }
}

