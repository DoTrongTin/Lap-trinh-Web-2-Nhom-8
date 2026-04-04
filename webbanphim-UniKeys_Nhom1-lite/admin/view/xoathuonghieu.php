<?php
include_once '../../model/connectDB.php';
include_once '../../model/thuonghieu.php';

$idthuonghieu = isset($_GET['idthuonghieu'])? $_GET['idthuonghieu']:null;
if($idthuonghieu){
    $result = delDataTacGiaById($idthuonghieu);
    if($result){
        header("Location: index.php?pg=sanpham&tabId=tab3");
    }else{
        echo "Error update table ";
    }

}else{
    echo "Not found idthuonghieu";
}
?>
