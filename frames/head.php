<head>
    <title>
        <?php
			if(isset($_GET['url']) && !empty($_GET['url'])) {
				echo $_GET['url']." - FIAE D / FIAE E"; // dynamic title loading by printing the requested url
			} else {
				echo 'Welcome to FIAE D / FIAE E';
			}
        ?>
    </title>
    
    <link href="../style/layout.css" rel="stylesheet" />
    <?php
        // dynamic theming loading based on time, no timezone adjustment since everyone using this will be in central europe.
        $hours = date('H');
        if(6 < $hours && $hours < 21) {
			echo '<link href="../style/light_theme.css" rel="stylesheet" />'; //if day (hours between 6 and 21)
        } else {
            echo '<link href="../style/dark_theme.css" rel="stylesheet" />'; //if night (other times)
        }
    ?>
</head>