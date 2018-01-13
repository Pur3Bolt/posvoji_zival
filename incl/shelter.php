<?php
echo'
<div class="w3-container w3-deep-orange" style="margin-top: 55px;">
	<div class="w3-row-padding">
		<!-- podatki -->
		<div class="w3-col l3 m6 s12 admin-left">
		<form method="post">
			<h2 class="w3-center">Podatki o zavetišču</h2>
			<label>Naziv</label>
			<input class="w3-input" type="text" name="name">
			<label>Ulica</label>
			<input class="w3-input" type="text" name="address">
			<label>Hišna številka</label>
			<input class="w3-input" type="text" name="houseno">
			<label>Poštna številka</label>
			<input class="w3-input" type="text" name="postno">
			<label>Telefonska številka</label>
			<input class="w3-input" type="tel" name="tel">
			<label>Elektronski naslov</label>
			<input class="w3-input" type="email" name="email">
			<div class="w3-center">
				<input class="w3-button w3-green" style="margin-top: 16px; margin-bottom: 16px;" type="submit" value="Shrani">
			</div>
		</div>
		<!-- geslo -->
		<div class="w3-col l3 m6 s12">
			<h2 class="w3-center">Sprememba gesla</h2>
			<label>Staro geslo</label>
			<input class="w3-input" type="password" name="old">
			<label>Novo geslo</label>
			<input class="w3-input" type="password" name="new">
			<label>Ponovi novo geslo</label>
			<input class="w3-input" type="password" name="newrepeat">
			<div class="w3-center" style="clear: both;">
				<input class="w3-button w3-green" style="margin-top: 16px; margin-bottom: 16px;" type="submit" value="Spremeni">
			</div>
			</form>
		</div>
		<!-- nova zival -->
		<div class="w3-col l3 m6 s12">
			<h2 class="w3-center">Dodajte žival</h2>
				<label>Ime</label>
				<input class="w3-input" type="text" name="name">
				<label>Starost</label>
				<select class="w3-select" name="age">
					<option value="1">Mladič</option>
					<option value="2">Mlad</option>
					<option value="3">Odrasel</option>
				<option value="4">Starejši</option>
			</select>
			<label>Spol</label>
			<select class="w3-select" name="sex">
				<option value="m">Samec</option>
				<option value="f">Samica</option>
			</select>
			<label>Vrsta (pasma)</label>
			<select class="w3-select" name="zavetisce">
				<optgroup label="Pes">
					<option value="maltezan">Maltežan</option>
					<option value="mops">Mops</option>
				</optgroup>
				<optgroup label="Muca">
					<option value="abesinka">Abesinka</option>
					<option value="ameriskazicnatodlagamacka">Ameriška žičnatodlaka mačka</option>
				</optgroup>
				<optgroup label="Ostalo">
					<option value="zajec">Zajec</option>
					<option value="papiga">Papiga</option>
				</optgroup>
			</select>
			<label>Opis</label>
			<input class="w3-input" type="text" name="desc">
			<div class="w3-center">
				<input class="w3-button w3-green" style="margin-top: 16px; margin-bottom: 16px;" type="submit" value="Dodaj">
			</div>
		</div>
	</div>
</div>';
?>