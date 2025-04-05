<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
	<style>
		input {
			outline: none;
			width: 400px;
		}
	</style>
</head>
<body>
	<form autocomplete="off">
		<input type="text" id="text"> <span><b id="left">60</b> left</span>
	</form>
	<script>
		var text = document.getElementById('text');
		var left = document.getElementById('left');
		var max = 60;
		text.addEventListener('keyup', function(){
			if (text.value.length > max) {
				text.value = text.value.substring(0, 60);
				text.style.border = "2px solid red";
				text.style.padding = "10px 15px";
				text.style.borderRadius = "5px";
				//alert("Form won't get submitted once it exceeds the max input");
			} else {
				left.textContent = max - text.value.length;
				text.style.border = "2px solid green";
				text.style.padding = "10px 15px";
				text.style.borderRadius = "5px";
			}
		});
	</script>
</body>
</html>