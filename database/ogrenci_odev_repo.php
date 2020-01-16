<?php 

function OgrenciDersOdevEkle($kod, $ogrenci_id, $odev_id, $ders_id, $dosya_id){
    $sql = "INSERT INTO ogrenci_odev (kod, ogrenci_id, odev_id, ders_id, dosya_id)
        VALUES ('$kod', '$ogrenci_id', '$odev_id', '$ders_id', '$dosya_id')";

    return SQLInsertCalistir($sql);
}

function OgrenciOdevNotGuncelle($ogrenci_odev_id, $not){
    $sql = "UPDATE ogrenci_odev SET not = '$not', durum = 1 
        WHERE id=$ogrenci_odev_id";
    return SQLUpdateCalistir($sql);
}

function OgrenciOdev_OgrencininTumDersOdevleriGetir($ogrenci_id, $ders_id){
    $sql = "SELECT * FROM ogrenci_odev where ogrenci_id = $ogrenci_id AND  ders_id =  $ders_id";
    return SQLTekliKayitGetir($sql);
}

function OgrenciOdev_OgrencininOdeviniGetir($ogrenci_id, $odev_id){
    $sql = "SELECT * FROM ogrenci_odev where ogrenci_id = $ogrenci_id AND  odev_id =  $odev_id";
    return SQLTekliKayitGetir($sql);
}

function OgrenciOdev_OgrencininOdeviniGetirByKod($odev_kod){
    $sql = "SELECT * FROM ogrenci_odev where kod =  '$odev_kod'";
    // echo $sql;
    return SQLTekliKayitGetir($sql);
}

function OgrenciOdev_TumOdevleriGetirByOdevId($odev_id){
    $sql = "SELECT * FROM ogrenci_odev where odev_id =  $odev_id";
    return SQLCalistir($sql);
}

function OgrenciOdevSil($ogrenci_odev_id){
    $sql = "DELETE FROM ogrenci_odev where id = $ogrenci_odev_id ";
    return SQLDeleteCalistir($sql);
}

function OgrenciOdevSilByKod($ogrenci_odev_kod){
    $sql = "DELETE FROM ogrenci_odev where kod = $ogrenci_odev_kod ";
    return SQLDeleteCalistir($sql);
}

?>