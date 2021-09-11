<main>
    <section>
            <?php
                if(isset($_GET['url']) && !empty($_GET['url'])) {
					$url = explode("/", $_GET['url']);
					if(file_exists('./pages/'.$url[0].'.php')) {
						require('./pages/'.$url[0].'.php');
					} else {
						require('./pages/404.php');
					}
				} else {
					require('./pages/old.php');
				}
            ?>
			<article>
        </article>
    </section>
</main>