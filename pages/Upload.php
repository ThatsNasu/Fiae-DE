<?php
    $base = '/mnt/pi4tb/FIAE-DE';
    if(isset($_FILES['file']) && !empty($_FILES['file'])) {
        $filename = $_FILES['file']['name'];
        if(isset($_POST['filename']) && !empty($_POST['filename'])) $filename = $_POST['filename'].'.'.explode('.', $_FILES['file']['name'])[sizeof(explode('.', $_FILES['file']['name']))-1];
        
        if(move_uploaded_file($_FILES['file']['tmp_name'], $base.Helpers::getFullPathByCategoryID($_POST['category'], $categories).'/'.$filename)) {
            $userid = 1;
            if(isset($_SESSION['user']) && !empty($_SESSION['user'])) $userid = $_SESSION['user'];
            $dbman->insertNewFile($filename, $_FILES['file']['size'], $userid, $_POST['category']);
            echo 'File uploaded successfully. You can now leave this page, or upload another file.';
        } else {
            echo 'Something went wrong. I doupt you exceeded the max filesize limit of 16GB, so Nasu has to inspect this a little further, sorry.';
        }
    }
?>

<section>
    <article>
        <form method="post" enctype="multipart/form-data">
            <select name="category" required >
                <?php
                    foreach($categories as $category) {
                        if($category->isUploadCategory()) echo '<option value="'.$category->getID().'">'.$category->getValue().'</option>';
                    }
                ?>
            </select>
            <input type="file" name="file" required />
            <input type="text" name="filename" placeholder="New filename (leave empty if no rename is needed)" />
            <input type="submit" value="Fire and forget!" required />
        </form>
    </article>
</section>