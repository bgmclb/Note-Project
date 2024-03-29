<?php
    $REQUIRE_LOGIN = TRUE;
    $page_title = " Anasayfa";
    include 'includes/page-common.php';
    include 'includes/head.php';
    include 'includes/nav-bar.php';

    $dersler = array();
    $asistan_dersler = array();

    if($OGRETMEN){
        $dersler = DuzenledigiAktifDersleriGetir($kullanici_id);
        $asistan_dersler = AsistanOlunanDersleriGetir($kullanici_id);
    }
    else
        $dersler = OgrencininAktifDersleriniGetir($kullanici_id);
      
?>

<link rel="stylesheet" href="assets/css/index.css">
<?php 
    function badgeYazdir($icerik){
        echo  "<span class='badge'>".$icerik."</span>";
    }
?>

<body>
    <div class="container">
        <?php 
            if($OGRETMEN)
                echo "<h3 class='course-list-header'>Oluşturulan Dersler</h3>";
            else
                echo "<h3 class='course-list-header'>Kayıt Olunan Dersler</h3>";
        ?>
        <!-- Ders Kartları -->
        <div class="row justify-content-center course-list">
            <?php
                if ($dersler != NULL && !is_null($dersler)) {
                    $dersler_count = count($dersler);

                    for ($i = 0; $i < $dersler_count; $i++) {
                        $ders = $dersler[$i];
                        $isim =  $ders["isim"];
                        $id =  $ders["id"];
                        $meaningFullUrl = ToMeaningfullUrl( $ders["isim"], $id)
                ?>
            <div>
                <div class="course-card"
                    style="background:url(files/images/course/<?php echo $ders["kodu"] ?>.png) no-repeat 0 0;">
                    <div class="course-card-desc">
                        <div class="course-card-title">
                            <a href='course.php?course=<?php echo $meaningFullUrl; ?>'>
                                <h4><?php echo $isim ?></h4>
                            </a>
                        </div>
                        <div class="card-info">
                            <?php  
                                if(!$OGRENCI) { 
                                    // $ogrenci_sayisi= DerseKayitliOgrenciSayisi($ders["id"]);
                                    badgeYazdir($ders["toplam"]." Öğrenci");
                                }else{
                                    badgeYazdir("<i class='fas fa-user'></i>"." ".$ders["ogretmen_adi"]." ".$ders["ogretmen_soyadi"]);
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                    } //for-loop ends

                } else {  
            ?>
            <div class="alert alert-warning" style="margin-top:30px">Sistemde kayıtlı ders bulunamadı!</div>
            <?php }   ?>
        </div>

        <?php 
            if($OGRETMEN) {
                echo "<h3 class='course-list-header'>Asistan Olunan Dersler</h3>";
        ?>
        <div class="row justify-content-center course-list" style="margin-top:30px">
            <?php
                if ($asistan_dersler != NULL && !is_null($asistan_dersler)) {
                    $dersler_count = count($asistan_dersler);
                    for ($i = 0; $i < $dersler_count; $i++) {
                        $ders = $asistan_dersler[$i];
                        $isim =  $ders["isim"];
                        $id =  $ders["id"];
                        $meaningFullUrl = ToMeaningfullUrl( $ders["isim"], $id)
                ?>
            <div>
                <div class="course-card"
                    style="background:url(files/images/course/<?php echo $ders["kodu"] ?>.png) no-repeat 0 0;">
                    <div class="course-card-desc">
                        <div class="course-card-title">
                            <a href='course.php?course=<?php echo $meaningFullUrl; ?>'>
                                <h4><?php echo $isim ?></h4>
                            </a>
                        </div>
                        <div class="card-info">
                            <?php  
                                badgeYazdir("<i class='fas fa-user'></i>"." ".$ders["ogretmen_adi"]." ".$ders["ogretmen_soyadi"]);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                    } //for-loop ends
                } else {  
            ?>
            <div class="alert alert-warning">Sistemde asistanı olduğunuz ders bulunamadı!</div>
            <?php }   ?>
        </div>
        <?php 
            }
        ?>
    </div>
    <hr>
    <div>
        <?php include 'includes/footer.php'; ?>
    </div>
</body>