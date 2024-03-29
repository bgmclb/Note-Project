<?php
//session_start();
$REQUIRE_LOGIN = TRUE;
include_once dirname(__FILE__) . '/../database/database.php';
$GirisYapildiMi = isset($_SESSION["kullanici_id"]);
// echo  $_SERVER['PHP_SELF'];
//echo basename(__FILE__);

?>

<style>
    @media (min-width: 768px) {
        .right-nav {
            margin-right: 2vw;
        }

        .navbar-right {
            float: right !important;
            margin-right: -15px;
        }
    }

    .logo-1 {
        margin-bottom: -5px;
        margin-right: 5px;
        width: 100px;
        padding: 1px;
        border-radius: 50px;
        margin-top: -6px;
    }
</style>
<?php
if ($GirisYapildiMi) {
    $KULLANICI = KullaniciBilgileriniGetirById($_SESSION["kullanici_id"]);

    $OGRETMEN = FALSE;
    $OGRENCI = FALSE;

    if ($KULLANICI['admin'] != "" && $KULLANICI['admin'] == 0) {
        $OGRENCI = TRUE;
        include 'course_attend_modal.php';
    } else if ($KULLANICI['admin'] != "" && $KULLANICI['admin'] == 1) {
        $OGRETMEN = TRUE;
        include 'course_modals.php';
        include 'course_attend_modal.php';
    }
} ?>
<nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">
        <img class="logo-1" src="files/images/note2.png">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <?php if ($GirisYapildiMi) { ?>
                <?php if ($OGRENCI) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="takvim.php">Takvim</a>
                    </li>
                <?php } ?>
                <?php if ($KULLANICI['admin'] != -1) { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="menuDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Ders
                            <!-- <i class="fas fa-plus"></i> -->
                        </a>
                        <div class="dropdown-menu" aria-labelledby="menuDropdown">
                            <?php if ($OGRETMEN) { ?>
                                <a class="dropdown-item" href="create_course.php" data-toggle="modal" data-target="#dersOlusturModal">Ders Oluştur</a>

                                <a class="dropdown-item" href="attend_course.php" data-toggle="modal" data-target="#derseKaydolModal">Derse Kaydol</a>
                            <?php } ?>
                            <?php if ($OGRENCI) { ?>
                                <a class="dropdown-item" href="attend_course.php" data-toggle="modal" data-target="#derseKaydolModal">Derse Kaydol</a>
                            <?php } ?>
                        </div>
                    </li>
                <?php } ?>

            <?php } ?>
        </ul>
        <ul class="navbar-nav ml-auto right-nav">
            <!-- Giriş yapılmadıysa NavBarda User var-->
            <?php if ($GirisYapildiMi) { ?>
                <?php if ($KULLANICI['admin'] != -1) { ?>
                    <?php include 'notifications.php'; ?>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="menuDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo $KULLANICI["adi"] ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="menuDropdown">
                            <!-- <a class="dropdown-item" href="takvim.php">Takvim</a> -->
                            <?php if ($KULLANICI['admin'] != "" && $KULLANICI['admin'] == 1) { ?>
                                <!-- öğretmen menusu -->
                                <a class="dropdown-item" href="profile.php?id=<?php echo $KULLANICI["id"] ?>">Profil</a>
                                <!-- <a class="dropdown-item" href="my_course.php">Dersler</a> -->
                                <a class="dropdown-item" href="settings.php">Ayarlar</a>
                            <?php } else { ?>
                                <!-- öğrenci menusu-->
                                <a class="dropdown-item" href="profile.php?id=<?php echo $KULLANICI["id"] ?>">Profil</a>
                                <!-- <a class="dropdown-item" href="my_course.php">Dersler</a> -->
                                <a class="dropdown-item" href="settings.php">Ayarlar</a>
                            <?php } ?>
                        </div>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link" href="action/logout_action.php">Çıkış</a>
                </li>
            <?php } else { ?>
                <li class="nav-item">
                    <!-- <a class="nav-link" href="login.php">Giriş</a> -->
                </li>
            <?php } ?>
        </ul>
    </div>
</nav>
<script>
    $(document).ready(function() {
        $(".dropdown").hover(
            function() {
                $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true, true).slideDown("fast");
                $(this).toggleClass('open');
            },
            function() {
                $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true, true).slideUp("fast");
                $(this).toggleClass('open');
            }
        );
    });
</script>

<?php
$type = "info";
$mesaj = "";
$title = "";

if (isset($_SESSION["_success"])) {
    $mesaj =  $_SESSION["_success"];
    $type =  "success";
    $title = "İşlem tamamlandı";
    unset($_SESSION["_success"]);
} else if (isset($_SESSION["_info"])) {
    $mesaj =  $_SESSION["_info"];
    $type =  "info";
    $title = "Bilgi";
    unset($_SESSION["_info"]);
} else if (isset($_SESSION["_error"])) {
    $mesaj =  $_SESSION["_error"];
    $type =  "error";
    $title = "Hata";
    unset($_SESSION["_error"]);
} else if (isset($_SESSION["_warning"])) {
    $mesaj =  $_SESSION["_warning"];
    $type =  "warning";
    $title = "Uyarı";
    unset($_SESSION["_warning"]);
}

$log = "";
if (isset($_SESSION["_log"])) {
    $log = $_SESSION["_log"];
}

?>


<?php if ($mesaj != "") { ?>
    <script>
        Swal.fire({
            title: '<?php echo $title ?>',
            text: '<?php echo $mesaj ?>',
            type: '<?php echo $type ?>',
            confirmButtonText: 'Tamam'
        })
    </script>
<?php } ?>

<?php if ($log != "") { ?>
    <script>
        console.log('<?php echo $log ?>');
    </script>
<?php } ?>