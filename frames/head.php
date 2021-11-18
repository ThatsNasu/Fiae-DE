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
    
    <link href="/style/layout.css" rel="stylesheet" />
    <?php
        if(!isset($_COOKIE['theme']) || $_COOKIE['theme'] == "default") {
            $hours = date('H');
            if(8 < $hours && $hours < 20) {
                echo '<link href="/style/light.css" rel="stylesheet" />'; //if day (hours between 6 and 21)
            } else {
                echo '<link href="/style/dark.css" rel="stylesheet" />'; //if night (other times)
            }
            $metas = $dbmanager->loadMetas();
            for($i = 0; $i < sizeof($metas); $i++) {
                echo '<meta name="'.$metas[$i]['tag'].'" content="'.htmlspecialchars($metas[$i]['value']).'" />';
            }
        } else {
            echo '<link href="/style/'.$_COOKIE['theme'].'.css" rel="stylesheet" />';
        }
    ?>
    <script rel="javascript">
        function themeselect() {
            var value = document.getElementById('themeselection').value;
            var d = new Date();
            d.setTime(d.getTime() + (30*24*60*60*1000));
            document.cookie = 'theme='+value+';path=/;domain=.bitbite.dev;expires='+d.toUTCString()+';';
            location.reload();
        }
    </script>
</head>