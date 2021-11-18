<script>
    function toggleCategories() {
        var select = document.getElementById("categories");
        var resources = document.getElementById("resources");
        if(select.value == "Lernerfolgskontrollen") {
            document.getElementById("resources").style.display = "none";
            document.getElementById("materials").style.display = "none";
        } else if(select.value == "Ressourcen") {
            document.getElementById("resources").style.display = "inline";
            document.getElementById("materials").style.display = "none";
            if(resources.value == "Buecher") {
                document.getElementById('operatingsystems').style.display = "none";
            } else {
                document.getElementById('operatingsystems').style.display = "inline";
            }
        }
        if(select.value == "Unterrichtsmaterialien") {
            document.getElementById("materials").style.display = "inline";
            document.getElementById("resources").style.display = "none";
            document.getElementById('operatingsystems').style.display = "none";
        }
        
    }
</script>
<style>
    .toggleshow {
        display: none;
    }

    #resources {
        display: inline;
    }
</style>
<div class="headline">
    Upload
</div>
<article>
    Depending on filsize and internet connection, fileuploads can take up some time. Please be patient and keep this site open until you got the response from the server. Feel free to use this site in a parallel tab.
    <div class="betawarning">
        Please make sure to not Upload any files that are already on the server, to save diskspace and traffic. Bandwidth doesn't grow on trees you know. If you don't know in which category you should put a certain file,
        feel free to ask DasNasu for some advice, or to add a new category if needed!
    </div>
    <form action="send" method="post" enctype="multipart/form-data" onChange="toggleCategories();">
        <select name="categories" id="categories">
            <option value="Ressourcen">Ressourcen</option>
            <option value="Unterrichtsmaterialien">Unterrichtsmaterialien</option>
            <option value="Lernerfolgskontrollen">Lernerfolgskontrollen</option>
        </select>
        <select name="resources" class="toggleshow" id="resources">
            <option selected value="Buecher">B&uuml;cher</option>
            <option value="Betriebssysteme">Betriebssysteme</option>
        </select>
        <select name="materials" class="toggleshow" id="materials">
            <option selected value="Allgemein">Allgemein</option>
            <option value="BGP-DS">BGP-DS</option>
            <option value="BGP-HK">BGP-HK</option>
            <option value="BGP-WiSo">BGP-WiSo</option>
            <option value="EDV-LAT">EDV-LAT</option>
            <option value="FaEng">FaEng</option>
            <option value="KRE_TRE-LAT">KRE_TRE-LAT</option>
            <option value="AnwP-Python">AnwP-Python</option>
            <option value="BGP-QM">BGP-QM</option>
            <option value="ITT-PC">ITT-PC</option>
            <option value="LAT-LAT">LAT-LAT</option>
            <option value="ITS-Net">ITS-Net</option>
            <option value="BGP-BWL">BGP-BWL</option>
            <option value="ITT-IS">ITT-IS</option>
            <option value="ITT-DTEL">ITT-DTEL</option>
        </select>
        <select name="operatingsystems" class="toggleshow" id="operatingsystems">
            <option selected value="Arch Linux">Arch Linux</option>
            <option value="CentOS">CentOS</option>
            <option value="Debian">Debian</option>
            <option value="DragonflyBSD">DragonflyBSD</option>
            <option value="Fedora">Fedora</option>
            <option value="FreeBSD">FreeBSD</option>
            <option value="Gentoo">Gentoo</option>
            <option value="Kali Linux">Kali Linux</option>
            <option value="Linux Mint">Linux Mint</option>
            <option value="Mac OS">Mac OS</option>
            <option value="OpenBSD">OpenBSD</option>
            <option value="OpenSuse">OpenSuse</option>
            <option value="pFsense">pFsense</option>
            <option value="TrueNAS">TrueNAS</option>
            <option value="Ubuntu Desktop">Ubuntu Desktop</option>
            <option value="Ubuntu Server">Ubuntu Server</option>
            <option value="Windows 10">Windows 10</option>
            <option value="Windows 11">Windows 11</option>
            <option value="Windows 2000">Windows 2000</option>
            <option value="Windows 7">Windows 7</option>
            <option value="Windows 95">Windows 95</option>
            <option value="Windows 98">Windows 98</option>
            <option value="Windows ME">Windows ME</option>
            <option value="Windows NT">Windows NT</option>
            <option value="Windows XP">Windows XP</option>
        </select>
        <input type="file" name="file" style="min-width: 600px"/>
        <input type="submit" value="Upload" />
    </form>
</article>