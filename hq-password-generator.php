<?php
/*
Plugin Name: HQ Password Generator
Plugin URI: https://login.plus/
Description: HQ Password Generator can be embedded in post or page with shortcodes. 
Author: LogHQ
Author URI: https://login.plus/
Version: 1.0.1
Text Domain: hqpasswordgenerator
*/
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/* Enable shortcodes in widget area */
add_filter('widget_text', 'do_shortcode');
// add css in footer
// add_action( 'wp_footer','hqpasswordgenerator_assets');
// add css @ header
 add_action( 'wp_head','hqpasswordgenerator_assets');
function hqpasswordgenerator_assets(){
	
		$pluginassets = '
<style>
.dragdealer {
position: relative;
height: 48px;
background: #EEE;
}
.dragdealer .handle {
position: absolute;
cursor: pointer;
}
.dragdealer .red-bar {
width: 100px;
height: 48px;
background: #CC0000;
color: #FFF;
line-height: 48px;
text-align: center;
}
.dragdealer .disabled {
background: #898989;
}

/* CSS Document */
HTML, BODY, .h100 {
    height: 100%;
}
div.main{
    background: #efefef;
    border-radius: 4px;
    padding: 20px;
    font-size: 18px;
}
small{
    font-size: 13px;
}
.input1{
    background-color: #ffffff;
    border: 1px solid #CCCCCC;
    border-radius: 4px;
    color: #363636;
    font-size: 24px;
    width: 618px;
    height: 50px;
    padding: 0 8px;
    text-align: center;
}
.input2{
    margin-top: 15px;
    font-size: 18px;
    color: #ffffff;
    padding: 0 15px 0 15px;
    height: 50px;
    border-radius: 4px;
    cursor: pointer;
    background-color: #0074CC;
    background-image: -moz-linear-gradient(center top , #0088CC, #0055CC);
    background-repeat: repeat-x;
    border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
    -moz-border-bottom-colors: none;
    -moz-border-image: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    border-style: solid;
    border-width: 1px;
    box-shadow: 0 1px 0 rgba(255, 255, 255, 0.2) inset, 0 1px 2px rgba(0, 0, 0, 0.05);
}

#my-slider {
    margin-top: 15px;
    border: #ffffff 1px solid;
    border-radius: 4px;
}
#drag-helper {
    border-radius: 4px;
}
label{
    width: 148px;
    display: inline-block;
    cursor: pointer;
    line-height: 48px;
    border: 1px #ffffff solid;
    border-radius: 4px;
    background-color: #dddddd;
}
#footer {
    padding: 30px 0 0 0;
}
#boxes {
    margin-top: 15px;
    padding: 1px 0 1px 0;
}


    </style>
    <script type="text/javascript">
var Cursor={x:0,y:0,init:function(){this.setEvent("mouse"),this.setEvent("touch")},setEvent:function(t){var s=document["on"+t+"move"]||function(){};document["on"+t+"move"]=function(t){s(t),Cursor.refresh(t)}},refresh:function(t){t||(t=window.event),"mousemove"==t.type?this.set(t):t.touches&&this.set(t.touches[0])},set:function(t){t.pageX||t.pageY?(this.x=t.pageX,this.y=t.pageY):(t.clientX||t.clientY)&&(this.x=t.clientX+document.body.scrollLeft+document.documentElement.scrollLeft,this.y=t.clientY+document.body.scrollTop+document.documentElement.scrollTop)}};Cursor.init();var Position={get:function(t){var s=curtop=0;if(t.offsetParent)do{s+=t.offsetLeft,curtop+=t.offsetTop}while(t=t.offsetParent);return[s,curtop]}},Dragdealer=function(t,s){if("string"==typeof t&&(t=document.getElementById(t)),t){var e=t.getElementsByTagName("div")[0];e&&-1!=e.className.search(/(^|\s)handle(\s|$)/)&&(this.init(t,e,s||{}),this.setup())}};Dragdealer.prototype={init:function(t,s,e){this.wrapper=t,this.handle=s,this.options=e,this.disabled=this.getOption("disabled",!1),this.horizontal=this.getOption("horizontal",!0),this.vertical=this.getOption("vertical",!1),this.slide=this.getOption("slide",!0),this.steps=this.getOption("steps",0),this.snap=this.getOption("snap",!1),this.loose=this.getOption("loose",!1),this.speed=this.getOption("speed",10)/100,this.xPrecision=this.getOption("xPrecision",0),this.yPrecision=this.getOption("yPrecision",0),this.callback=e.callback||null,this.animationCallback=e.animationCallback||null,this.bounds={left:e.left||0,right:-(e.right||0),top:e.top||0,bottom:-(e.bottom||0),x0:0,x1:0,xRange:0,y0:0,y1:0,yRange:0},this.value={prev:[-1,-1],current:[e.x||0,e.y||0],target:[e.x||0,e.y||0]},this.offset={wrapper:[0,0],mouse:[0,0],prev:[-999999,-999999],current:[0,0],target:[0,0]},this.change=[0,0],this.activity=!1,this.dragging=!1,this.tapping=!1},getOption:function(t,s){return void 0!==this.options[t]?this.options[t]:s},setup:function(){this.setWrapperOffset(),this.setBoundsPadding(),this.setBounds(),this.setSteps(),this.addListeners()},setWrapperOffset:function(){this.offset.wrapper=Position.get(this.wrapper)},setBoundsPadding:function(){this.bounds.left||this.bounds.right||(this.bounds.left=Position.get(this.handle)[0]-this.offset.wrapper[0],this.bounds.right=-this.bounds.left),this.bounds.top||this.bounds.bottom||(this.bounds.top=Position.get(this.handle)[1]-this.offset.wrapper[1],this.bounds.bottom=-this.bounds.top)},setBounds:function(){this.bounds.x0=this.bounds.left,this.bounds.x1=this.wrapper.offsetWidth+this.bounds.right,this.bounds.xRange=this.bounds.x1-this.bounds.x0-this.handle.offsetWidth,this.bounds.y0=this.bounds.top,this.bounds.y1=this.wrapper.offsetHeight+this.bounds.bottom,this.bounds.yRange=this.bounds.y1-this.bounds.y0-this.handle.offsetHeight,this.bounds.xStep=1/(this.xPrecision||Math.max(this.wrapper.offsetWidth,this.handle.offsetWidth)),this.bounds.yStep=1/(this.yPrecision||Math.max(this.wrapper.offsetHeight,this.handle.offsetHeight))},setSteps:function(){if(this.steps>1){this.stepRatios=[];for(var t=0;t<=this.steps-1;t++)this.stepRatios[t]=t/(this.steps-1)}},addListeners:function(){var t=this;this.wrapper.onselectstart=function(){return!1},this.handle.onmousedown=this.handle.ontouchstart=function(s){t.handleDownHandler(s)},this.wrapper.onmousedown=this.wrapper.ontouchstart=function(s){t.wrapperDownHandler(s)};var s=document.onmouseup||function(){};document.onmouseup=function(e){s(e),t.documentUpHandler(e)};var e=document.ontouchend||function(){};document.ontouchend=function(s){e(s),t.documentUpHandler(s)};var i=window.onresize||function(){};window.onresize=function(s){i(s),t.documentResizeHandler(s)},this.wrapper.onmousemove=function(s){t.activity=!0},this.wrapper.onclick=function(s){return!t.activity},this.interval=setInterval(function(){t.animate()},25),t.animate(!1,!0)},handleDownHandler:function(t){this.activity=!1,Cursor.refresh(t),this.preventDefaults(t,!0),this.startDrag(),this.cancelEvent(t)},wrapperDownHandler:function(t){Cursor.refresh(t),this.preventDefaults(t,!0),this.startTap()},documentUpHandler:function(t){this.stopDrag(),this.stopTap()},documentResizeHandler:function(t){this.setWrapperOffset(),this.setBounds(),this.update()},enable:function(){this.disabled=!1,this.handle.className=this.handle.className.replace(/\s?disabled/g,"")},disable:function(){this.disabled=!0,this.handle.className+=" disabled"},setStep:function(t,s,e){this.setValue(this.steps&&t>1?(t-1)/(this.steps-1):0,this.steps&&s>1?(s-1)/(this.steps-1):0,e)},setValue:function(t,s,e){this.setTargetValue([t,s||0]),e&&this.groupCopy(this.value.current,this.value.target)},startTap:function(t){this.disabled||(this.tapping=!0,void 0===t&&(t=[Cursor.x-this.offset.wrapper[0]-this.handle.offsetWidth/2,Cursor.y-this.offset.wrapper[1]-this.handle.offsetHeight/2]),this.setTargetOffset(t))},stopTap:function(){!this.disabled&&this.tapping&&(this.tapping=!1,this.setTargetValue(this.value.current),this.result())},startDrag:function(){this.disabled||(this.offset.mouse=[Cursor.x-Position.get(this.handle)[0],Cursor.y-Position.get(this.handle)[1]],this.dragging=!0)},stopDrag:function(){if(!this.disabled&&this.dragging){this.dragging=!1;var t=this.groupClone(this.value.current);if(this.slide){var s=this.change;t[0]+=4*s[0],t[1]+=4*s[1]}this.setTargetValue(t),this.result()}},feedback:function(){var t=this.value.current;this.snap&&this.steps>1&&(t=this.getClosestSteps(t)),this.groupCompare(t,this.value.prev)||("function"==typeof this.animationCallback&&this.animationCallback(t[0],t[1]),this.groupCopy(this.value.prev,t))},result:function(){"function"==typeof this.callback&&this.callback(this.value.target[0],this.value.target[1])},animate:function(t,s){if(!t||this.dragging){if(this.dragging){var e=this.groupClone(this.value.target),i=[Cursor.x-this.offset.wrapper[0]-this.offset.mouse[0],Cursor.y-this.offset.wrapper[1]-this.offset.mouse[1]];this.setTargetOffset(i,this.loose),this.change=[this.value.target[0]-e[0],this.value.target[1]-e[1]]}(this.dragging||s)&&this.groupCopy(this.value.current,this.value.target),(this.dragging||this.glide()||s)&&(this.update(),this.feedback())}},glide:function(){var t=[this.value.target[0]-this.value.current[0],this.value.target[1]-this.value.current[1]];return!(!t[0]&&!t[1])&&(Math.abs(t[0])>this.bounds.xStep||Math.abs(t[1])>this.bounds.yStep?(this.value.current[0]+=t[0]*this.speed,this.value.current[1]+=t[1]*this.speed):this.groupCopy(this.value.current,this.value.target),!0)},update:function(){this.snap?this.offset.current=this.getOffsetsByRatios(this.getClosestSteps(this.value.current)):this.offset.current=this.getOffsetsByRatios(this.value.current),this.show()},show:function(){this.groupCompare(this.offset.current,this.offset.prev)||(this.horizontal&&(this.handle.style.left=String(this.offset.current[0])+"px"),this.vertical&&(this.handle.style.top=String(this.offset.current[1])+"px"),this.groupCopy(this.offset.prev,this.offset.current))},setTargetValue:function(t,s){var e=s?this.getLooseValue(t):this.getProperValue(t);this.groupCopy(this.value.target,e),this.offset.target=this.getOffsetsByRatios(e)},setTargetOffset:function(t,s){var e=this.getRatiosByOffsets(t),i=s?this.getLooseValue(e):this.getProperValue(e);this.groupCopy(this.value.target,i),this.offset.target=this.getOffsetsByRatios(i)},getLooseValue:function(t){var s=this.getProperValue(t);return[s[0]+(t[0]-s[0])/4,s[1]+(t[1]-s[1])/4]},getProperValue:function(t){var s=this.groupClone(t);return s[0]=Math.max(s[0],0),s[1]=Math.max(s[1],0),s[0]=Math.min(s[0],1),s[1]=Math.min(s[1],1),(!this.dragging&&!this.tapping||this.snap)&&this.steps>1&&(s=this.getClosestSteps(s)),s},getRatiosByOffsets:function(t){return[this.getRatioByOffset(t[0],this.bounds.xRange,this.bounds.x0),this.getRatioByOffset(t[1],this.bounds.yRange,this.bounds.y0)]},getRatioByOffset:function(t,s,e){return s?(t-e)/s:0},getOffsetsByRatios:function(t){return[this.getOffsetByRatio(t[0],this.bounds.xRange,this.bounds.x0),this.getOffsetByRatio(t[1],this.bounds.yRange,this.bounds.y0)]},getOffsetByRatio:function(t,s,e){return Math.round(t*s)+e},getClosestSteps:function(t){return[this.getClosestStep(t[0]),this.getClosestStep(t[1])]},getClosestStep:function(t){for(var s=0,e=1,i=0;i<=this.steps-1;i++)Math.abs(this.stepRatios[i]-t)<e&&(e=Math.abs(this.stepRatios[i]-t),s=i);return this.stepRatios[s]},groupCompare:function(t,s){return t[0]==s[0]&&t[1]==s[1]},groupCopy:function(t,s){t[0]=s[0],t[1]=s[1]},groupClone:function(t){return[t[0],t[1]]},preventDefaults:function(t,s){t||(t=window.event),t.preventDefault&&t.preventDefault(),t.returnValue=!1,s&&document.selection&&document.selection.empty()},cancelEvent:function(t){t||(t=window.event),t.stopPropagation&&t.stopPropagation(),t.cancelBubble=!0}};

    </script>
    <script type="text/javascript">
function genpw(e,t,n,d,c,o){obj=document.getElementById(e),n=document.getElementById(n),d=document.getElementById(d),c=document.getElementById(c),o=document.getElementById(o),obj.value=GeneratePassword(t,n.checked,d.checked,c.checked,o.checked)}function GeneratePassword(e,t,n,d,c){var o="",m="";for(t&&(m+="qwertyuioplkjhgfdsazxcvbnm"),n&&(m+="QWERTYUIOPLKJHGFDSAZXCVBNM"),d&&(m+="1234567890"),c&&(m+="!@#$%^&*.,"),i=0;i<e;i++)j=getRandomNum(m.length),o+=m.charAt(j);return o}function getRandomNum(e){var t=Math.random();return t=parseInt(t*e)}
    </script>
		';
		
		echo $pluginassets;
}
function generate_password($atts) {
	// Attributes
	$atts = shortcode_atts(
		array(
			'msg' 		=> '',
		),
		$atts,
		'passwordgenerator'
	);
	// message 
	$msg = $atts['msg'];
	
	// OUTPUT
	$pluginhtml = '

    <table cellpadding="0" cellspacing="0" border="0" align="center" class="h100">
    <tr>
    <td valign="middle" align="center">
        <div class="main" align="center">
            <input type="text" id="pw" class="input1">
            <div id="my-slider" class="dragdealer" title="Password length">
                <div class="red-bar handle" id="drag-helper">drag me</div>
            </div>
            <div id="boxes">
                <label id="l1" title="Use small letters"><input onChange="refreshpw();" type="checkbox" id="arg1" name="arg1" checked>small letters</label>
                <label id="l2" title="Use big letters"><input onChange="refreshpw();" type="checkbox" id="arg2" name="arg2">big letters</label>
                <label id="l3" title="Use numbers"><input onChange="refreshpw();" type="checkbox" id="arg3" name="arg3" checked>numbers</label>
                <label id="l4" title="Use punctuation"><input onChange="refreshpw();" type="checkbox" id="arg4" name="arg4">punctuation</label>
            </div>
            
            <button id=re class="input2" onClick="refreshpw();return false;" title="Generate!">Generate password</button>
            
            <div id="footer">
                <small>by <a href="https://login.plus/" title="Login.plus" rel="noopener">Login.plus</a></small>
            </div>
        </div>
    </td>
    </tr>
    </table>
    
<script type="text/javascript">
    var pw_len;
    function refreshpw(){
	genpw(\'pw\',pw_len,\'arg1\',\'arg2\',\'arg3\',\'arg4\');
    }
    new Dragdealer(\'my-slider\',
    {
        x : 0.09,
        steps: 57,
        snap : true,
        animationCallback: function(x, y){
            pw_len=parseInt(3 + x * 57);
            document.getElementById(\'drag-helper\').innerHTML=pw_len + \' signs\';
            refreshpw(\'pw\');
        }
    });
    labels=[\'l1\',\'l2\',\'l3\',\'l4\'];
    labels.forEach(function (el_id){
        el=document.getElementById(el_id);
        el.onselectstart = function () { return false; } // ie
        el.onmousedown = function () { return false; } // mozilla
    });
</script>
    ';
	
	return $pluginhtml;
}

add_shortcode( 'hqpasswordgenerator', 'generate_password' );
?>
