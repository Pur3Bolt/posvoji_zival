<div class="w3-dropdown-click">
	<button onclick="changeVisible('login')" class="w3-button w3-black"><i class="far fa-user-circle"></i> Prijava</button>
	<!-- TODO ce se prijavi in ne uspe, da prikaze se napako -->
	<div id="login" class="w3-dropdown-content w3-bar-block w3-border">
		<form class="form-horizontal"  method="post" accept-charset="UTF-8">
			<input class="w3-bar-item" type="email" name="email" placeholder="Elektronski naslov"/>
			<input class="w3-bar-item" type="password" name="pwd" placeholder="Geslo"/>
			<input class="w3-bar-item w3-button w3-green" type="submit" name="submit" value="Prijava"/>
		</form>
	</div>
</div>
<div class="w3-dropdown-click w3-margin-left">
	<button onclick="changeVisible('register')" class="w3-button w3-black"><i class="far fa-user-plus"></i> Registracija</button>
	<div id="register" class="w3-dropdown-content w3-bar-block w3-border" style="right: 16px;">
		<form class="form-horizontal"  method="post" accept-charset="UTF-8">
			<input class="w3-bar-item" type="email" name="email" placeholder="Elektronski naslov"/>
			<input class="w3-bar-item" type="text" name="name" placeholder="Ime"/>
			<input class="w3-bar-item" type="text" name="surname" placeholder="Priimek"/>
			<input class="w3-bar-item" type="tel" name="tel" placeholder="Telefonska številka"/>
			<input class="w3-bar-item" type="password" name="pwd" id="pwd" placeholder="Geslo" onkeyup="checkPwd();"/>
			<input class="w3-bar-item" type="password" name="pwdConfirm" id="pwdConfirm" placeholder="Ponovi geslo" onkeyup="checkPwd();"/>
			<input class="w3-bar-item w3-button w3-green" type="submit" name="submit" value="Ustvari račun"/>
		</form>
	</div>
</div>
<script>
	function changeVisible(location) {
		var x = document.getElementById(location);
		var y = "";
		if(location == "login")
			y = "register";
		else
			y = "login";
		y = document.getElementById(y);
		if (x.className.indexOf("w3-show") == -1) {
			x.className += " w3-show";
			y.className = y.className.replace(" w3-show", "");
		}
		else { 
			x.className = x.className.replace(" w3-show", "");
		}
	}
	function checkPwd(){
		var pw1 = document.getElementById("pwd");
		var pw2 = document.getElementById("pwdConfirm");
		if(pw1.value == pw2.value){
			pw2.classList.remove("w3-border-red"); 
			pw2.classList.remove("w3-pale-red");
		}
		else{
			if(!pw2.classList.contains("w3-border-red")){
				pw2.className += " w3-border-red w3-pale-red";
			}
		}
	}
</script>