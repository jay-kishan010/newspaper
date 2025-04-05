<!DOCTYPE html>
<html>
<head>
	<title>File upload test</title>
	<script src="js/jquery/jquery-2.2.4.min.js"></script>
	<script>
		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$('#img').attr('src', e.target.result);
				}
				reader.readAsDataURL(input.files[0]);
			}
		}
	</script>
</head>
<body>
	<form id="form" runat="server" enctype="multipart/form-data">
		<input type="file" name="file" id="file" onchange="readURL(this);"><br><br>
		<img src="img/bg-img/1.jpg" alt="Image to be displayed here!" id="img" width="400" height="300">
	</form>
</body>
</html>