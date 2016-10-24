function begin() {

	show.onclick = function() {
		var gatewayname = document.getElementById('gatewayname');
		var dns1 = document.getElementById('dns1');
		var dns2 = document.getElementById('dns2');
		var ntp1 = document.getElementById('ntp1');
		var wanip = document.getElementById('wanip');
		var wanmask = document.getElementById('wanmask');
		var wangateway = document.getElementById('wangateway');
		var lanip = document.getElementById('lanip');
		var lanmask = document.getElementById('lanmask');

		var config = document.getElementById('config');
		var config_template = generate_template;

		config_template = config_template.replace(new RegExp('{{gatewayname}}','g'),gatewayname.value);
		config_template = config_template.replace(new RegExp('{{dns1}}','g'),dns1.value);
		config_template = config_template.replace(new RegExp('{{dns2}}','g'),dns2.value);
		config_template = config_template.replace(new RegExp('{{ntp1}}','g'),ntp1.value);
		config_template = config_template.replace(new RegExp('{{wanip}}','g'),wanip.value);
		config_template = config_template.replace(new RegExp('{{wanmask}}','g'),wanmask.value);
		config_template = config_template.replace(new RegExp('{{wangateway}}','g'),wangateway.value);
		config_template = config_template.replace(new RegExp('{{lanip}}','g'),lanip.value);
		config_template = config_template.replace(new RegExp('{{lanmask}}','g'),lanmask.value);

		config.innerText = config_template;
	};

	download.onclick = function() {
		downloadCfg('patton_config.cfg', 'config');
	};

	function downloadCfg(cfgname, cfgid) {
		var elcfg = document.getElementById(cfgid);
		var link = document.createElement('a');
		link.setAttribute('download', cfgname);
		link.setAttribute('href', 'data:' + 'text/plain' + ';charset=utf-8,' + encodeURIComponent(elcfg.innerText));
		
		document.body.appendChild(link);
		link.click();
		document.body.removeChild(link);
	}	
};
document.addEventListener("DOMContentLoaded", begin);
