<html>
    <head>
        <title>Login to DasNasu's SFTP</title>
        <link href="style.css" rel="stylesheet" />
    </head>

    <body>
        <div class="headline">
		To connect to the sftp server,
        </div>
        <br />you need the login data provided by DasNasu (Hauke Motzkus) and a ftp / sftp client like <a rel="noopener" target="_blank" href="https://filezilla-project.org/download.php?type=client">FileZilla</a> or <a rel="noopener" target="_blank" href="https://winscp.net/eng/download.php">WinSCP</a> (You can download either of them by clicking on the text, since i made them links).

        <div class="block">
            <div class="block_headline">
                FileZilla walkthrough:
            </div>

            <div class="step">
                1. Click on File and open the "Site Manager", so you should see a window like this: <br />
                <img src="./images/filezilla-servermanager.png" alt="Site Manager of Filezilla" /><br />
            </div>
            <div class="step">
                2. Pick "New Site" and name it as you like. On the right side change the dropdown menu to <div class="highlight">SFTP</div>.
                For the host enter the following url: <div class="highlight">dasnasu.bitbite.dev</div> and for the port set it to <div class="highlight">22</div>.
                Username and Password should be pretty self-explainatory. After you're done, you should have something like this:<br />
                <img src="./images/filezilla-servermanager_filled.png" alt="filled Site Manager" /><br />
            </div>
            <div class="step">
                3. Select the "Advanced" tab and set the default remote directory to <div class="highlight">/mnt/pi4tb/shares</div><br />
                <img src="./images/filezilla-servermanager_advanced.png" alt="advanced remote directory" /><br />
            </div>
            <div class="step">
                4. Doublecheck everything and hit "OK".
            </div>
            <div class="step">
                5. From now on you can connect to the ftp with the little dropdown arrow below the "File" Menu, shown here:<br />
                <img src="./images/filezilla_quick_connect.png" alt="Filezilla QuickConnect" /><br />
            </div>
        </div>

        <div class="block">
            <div class="block_headline">
                WinSCP walkthrough:
            </div>
            <div class="step">
                WinSCP will greet you on every startup with a window that asks you where to conenct to, like this one:<br />
                <img src="./images/winscp_login.png" alt="WinSCP login window" /><br />
            </div>
            <div class="step">
                Since you probably won't have any connections saved (or otherwise you wouldn't need this walkthrough ;) ), select the "New Site" and on the right side,
                put in <div class="highlight">SFTP</div> (should be default) for the protocol, <div class="highlight"i>dasnasu.bitbite.dev</div> for the host, and your login information.
            </div>
            <div class="step">
                Next on is to click on "Advanced..." to get this window:<br />
                <img src="./images/winscp_advanced.png" alt="Advanced Settings" /><br />
            </div>
            <div class="step">
                Set the remote directory to <div class="highlight"i>/mnt/pi4tb/shares</div> and hit OK.
            </div>
            <div class="step">
                After that, click "Save" and doubleclick on the left side on the new entry you created.
            </div>
        </div>
    </body>
</html>