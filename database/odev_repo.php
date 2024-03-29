<?php 

function DersOdevleriniGetir($ders_id){
    $sql = "SELECT o.*, kullanici.adi, kullanici.soyadi FROM odev o
        INNER JOIN kullanici ON kullanici.id=o.olusturan_id
        WHERE o.ders_id = $ders_id ORDER BY o.olusturma_tarih DESC";
    
    return SQLCalistir($sql, FALSE);
}

function DersOdevKaydet($kod, $ders_id, $olusturan_id, $dosya_id, $isim, $aciklama, $son_tarih, $dosya_gonderme) : bool
{
    $sql = "INSERT INTO odev (kod, ders_id, olusturan_id, dosya_id, isim, aciklama, son_tarih, dosya_gonderme)
    VALUES ('$kod', '$ders_id', '$olusturan_id', '$dosya_id', '$isim', '$aciklama', '$son_tarih', '$dosya_gonderme')";

    return SQLInsertCalistir($sql);
}


function GetOdevByKod($kod){
    $sql = "SELECT * FROM odev where kod='$kod'";
    return SQLTekliKayitGetir($sql);
}

function DeleteOdevByKod($kod){
    $sql = "DELETE FROM odev where kod='$kod'";
    return SQLDeleteCalistir($sql);
}

function GetOdevDetailsByKod($kod){
    $sql = "SELECT o.*, kullanici.adi as ogretmen_adi, kullanici.soyadi as ogretmen_soyadi
        FROM odev o
        INNER JOIN kullanici ON kullanici.id = o.olusturan_id
        WHERE o.kod='$kod'";

    return SQLTekliKayitGetir($sql);
}


function OgrenciOdevleriGetir($ogrenci_id){
    $sql = "SELECT o.id, o.isim, o.kod, o.son_tarih, dr.isim as ders_adi 
        from odev o
        INNER join dersler dr on o.ders_id=dr.id
        INNER join katilimci k on k.ders_id= o.ders_id
        where k.ogrenci_id = $ogrenci_id";

    return SQLCalistir($sql, FALSE);
}

?>