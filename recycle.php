<?php
include 'session_check.php';
include 'db.php';
include 'note.php';
?>

<!DOCTYPE html>
<html lang="en">
    <?php include 'inc/head.php'; ?>
    <body class="recycle-page">
        <div class="st-header">
            <?php include 'layout/header.php'; ?>
        </div>
        <div class="sec-recycle pt-40">
            <div class="container">
                <?php
                    if ($loggedIn) {
                        if ($_SESSION["role"] === "administrator") { ?>
                            <div class="row">
                                <?php
                                    $dir = 'uploads/recyclebin/';
                                    $files = glob($dir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);

                                    foreach ($files as $file) {
                                        $filename =  basename($file);
                                    ?>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="recyclebin-single">
                                            <img src="<?php echo $file ?>" alt="<?php echo $filename ?>">
                                            <div><?php echo $filename ?></div>
                                        </div>
                                    </div>
                                    <?php }
                                ?> 
                            </div>
                        <?php } else {
                            not_administrator_note();
                        }
                    } else {
                        invalid_req_note();
                    }
                ?>
            </div>
        </div>
        <?php include 'inc/footer.php'; ?>
    </body>
</html>
