function sethash(){

var oldHash=0;

var urlC = "http://frame.com/agent.html";

var iframe=document.createElement('iframe');

iframe.id="iframeC"

iframe.name="iframeC";

iframe.width=0;

iframe.height=0;

iframe.style.display="none";

document.body.appendChild(iframe);

//document.body.innerHTML+=’<iframe id="iframeC" name="iframeC" src="" width="0″ height="0″ style="display:none;" ></iframe>’;

 

setInterval(function(){

var bHeight = document.body.scrollHeight;

var dHeight = document.documentElement.scrollHeight;

var oHeight = document.body.offsetHeight;

var hashH =Math.min(oHeight,Math.min(bHeight,dHeight));

 

if(oldHash!=hashH){

 

document.getElementById("iframeC").src=urlC+"?"+Math.random()+"#"+hashH;

}

oldHash=hashH;

},200);

 

}

if(window.addEventListener){

window.addEventListener("load",sethash,false);

}else{

window.attachEvent("onload",sethash);

}