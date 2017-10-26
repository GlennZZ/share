//设置垂直居中
function fBodyVericalAlign(){
	var nBodyHeight = 730;
	var nClientHeight = document.documentElement.clientHeight;
	if(nClientHeight >= nBodyHeight + 2){
		var nDis = (nClientHeight - nBodyHeight)/2;
		document.body.style.paddingTop = nDis + 'px';
	}else{
		document.body.style.paddingTop = '0px';
	}
}
fBodyVericalAlign();
window.onresize = function()
   {   
    fBodyVericalAlign(); 
   }
var drag = document.getElementById('loginBlock');
var drag2 = document.getElementById('lbNormal');

if(document.attachEvent){
drag2.attachEvent('onmousedown',dragHandle);
}else{
drag2.addEventListener('mousedown', dragHandle,false);
}
function dragHandle(event){
	var event = event||window.event;
	var startX = drag.offsetLeft;
	var startY = drag.offsetTop;
	var mouseX = event.clientX;
	var mouseY = event.clientY;
	var deltaX = mouseX - startX;
	var deltaY = mouseY - startY;
	if(document.attachEvent){
		drag.attachEvent('onmousemove',moveHandle);
		drag.attachEvent('onmouseup',upHandle);
		drag.attachEvent('onlosecapture',upHandle);
		drag.setCapture();
	}else{
		document.addEventListener('mousemove',moveHandle,true);
		document.addEventListener('mouseup',upHandle,true);
	}
	function moveHandle(event){
		var event = event||window.event;
		if((event.clientX - deltaX)>0&&((event.clientX - deltaX)<=(window.screen.availWidth-340)))drag.style.left = (event.clientX - deltaX)+"px";
		
		if((event.clientY - deltaY)>0&&((event.clientY - deltaY)<=(window.screen.availHeight-500)))drag.style.top = (event.clientY - deltaY)+"px";
		
	}
	function upHandle(){
		if(document.attachEvent){
			drag.detachEvent('onmousemove',moveHandle);
			drag.detachEvent('onmouseup',upHandle);
			drag.detachEvent('onlosecapture',upHandle);
			drag.releaseCapture();
		}else{
			document.removeEventListener('mousemove',moveHandle,true);
			document.removeEventListener('mouseup',upHandle,true);
		}
	}

}