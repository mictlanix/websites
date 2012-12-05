
			<div id="footer-columns" class="container">
				<div class="left-column-form">
					<ul>
						<li class="">
							<h1><a href="/calendars">Calendarios</a></h1>
							<p>Calendario 2013, revive la nostalgia por los años 80's o haz un viaje por 12 hermosas ciudades.</p>
						</li>
						<li class="">
							<h1><a href="/notebooks">Cuadernos</a></h1>
							<p>Todo lo que hacemos y lo que podemos hacer está totalmente personalizado para ti.</p>
						</li>
						<li class="last">
							<h1><a href="/contact">Contacto</a></h1>
							<p>Haremos lo mejor para ti, si tan sólo nos lo dices!</p>
						</li>
					</ul>
				</div>
				<div class="right-column-form">
					<h4>Noticias</h4>
					<p class="column-form">
						¿Te gustaría recibir noticias y promociones acerca de nustros increibles productos?
					</p>
					<form action="subscribe" class="subscribe-form" method="post">
							<input type="hidden" name="token" value="<?php echo $token; ?>" />
							<input type="email" class="subscribe-email" name="email" placeholder="correo electrónico (e-mail)"/>
							<button class="subscribe-it red-button" type="submit">Suscribir</button>
					</form>
					<p id="subscribe-msg"></p>
					<h4>Contacto</h4>
					<form action="send" class="contact-form" method="post">
						<input type="hidden" name="token" value="<?php echo $token; ?>" />
						<p><input type="text" name="name" placeholder="nombre" required/></p>
						<p><input type="email" name="email" placeholder="correo electrónico (e-mail)" required/></p>
						<p><input type="text" name="phone" placeholder="teléfono"/></p>
						<p><textarea name="message" placeholder="escribe tu mensaje aquí" cols="3" rows="3" required></textarea></p>
						<p><button class="send-message red-button" type="submit">Enviar mensaje</button></p>
					</form>
					<p id="contact-msg"></p>
				</div>
				<div class="p11"></div>
				<div class="p12"></div>
			</div>
			<div id="footer">
				<div class="footer">
					<a href="https://www.facebook.com/TinboxMX" class="facebook" title="facebook"><img src="images/facebook.png" alt="facebook"/></a>
					<a href="https://twitter.com/TinboxMX" class="twitter" title="twitter"><img src="images/twitter.png" alt="twitter"/></a>
					<div>&copy; Tinbox 2012</div>
				</div>
			</div>
