function animate(obj, fn) {//2.减少了参数接收个数，让函数调用时使用更方便。
	if (typeof obj.speedTime == "undefined") {//3.对时间毫秒数的处理，调用时可传可不传。
		obj.speedTime = 30;
	} else if (obj.speedTime == "slow") {
		obj.speedTime = 50;
	} else if (obj.speedTime == "quickly") {
		obj.speedTime = 20;
	} else if (obj.speedTime == "fast") {
		obj.speedTime = 10;
	}

	clearInterval(obj.ele.timer);
	obj.ele.timer = setInterval(function () {
		var flag = true;//所有样式都到了目标值
		for (var attrKey in obj.param) {//4.把样式和目标值作了一个整合
			var current = 0;
			if (attrKey == "opacity") {//透明度的当前值
				current = getStyle(obj.ele, attrKey) * 100;
			} else {//其它样式的当前值
				current = parseInt(getStyle(obj.ele, attrKey));
			}
			var speed = (obj.param[attrKey] - current) / 10;
			speed = speed > 0 ? Math.ceil(speed) : Math.floor(speed);
			if (current != obj.param[attrKey]) {//1.当前值等于目标值
				//当最早到达目标值的这个样式，到这会删除定时器，也停止了其它属性的运动，所有会出来 其它样式达不到目标值的现象
				//解决办法是，只要要有一个样式没有达到目标值，让一个控制器flag为false,当flag一直为false时，不需要清除
				//定时器，只有所有的样式达到目标值后，清除定时器==flag为true时
				/*clearInterval(obj.ele.timer);
				if(typeof fn != "undefined"){
					fn();
				}*/
				flag = false;
			}
			if (attrKey == "opacity") {//透明度的赋值
				obj.ele.style[attrKey] = (current + speed) / 100;
			} else if (attrKey == "zIndex") {
				obj.ele.style[attrKey] = obj.param[attrKey];
			} else {//其它样式赋值。
				obj.ele.style[attrKey] = current + speed + "px";
			}
		}
		if (flag) {//清除定时器
			clearInterval(obj.ele.timer);
			if (typeof fn != "undefined") {
				fn();
			}
		}
	}, obj.speedTime);
}
function getStyle(ele, attr) {//返回的是一个字符串
	return window.getComputedStyle ? window.getComputedStyle(ele)[attr] : ele.currentStyle[attr];
}