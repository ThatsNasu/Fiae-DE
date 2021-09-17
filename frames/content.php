<main>
    <section>
		<?php
			if(isset($_GET['url']) && !empty($_GET['url'])) {
				$url = explode("/", $_GET['url']);
				if(file_exists('./pages/'.$url[0].'.php')) {
					require('./pages/'.$url[0].'.php');
				} elseif(file_exists('./pages/'.$url[0].'.html')) {
					require('./pages/'.$url[0].'.html');
				} else {
					require('./pages/404.html');
				}
			} else {
				require('./pages/old.html');
			}
		?>
    </section>
</main>