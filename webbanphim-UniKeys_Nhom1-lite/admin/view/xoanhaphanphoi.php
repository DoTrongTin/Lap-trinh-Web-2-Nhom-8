<?php
include_once '../../model/connectDB.php';
include_once '../../model/nhaphanphoi.php';

$idnhaphaphoi = isset($_GET['idnhaphaphoi'])? $_GET['idnhaphaphoi']:null;
if($idnhaphaphoi){
    $result = delDataNhaXuatBanById($idnhaphaphoi);
    if($result){
        header("Location: index.php?pg=sanpham&tabId=tab4");
    }else{
        echo "Error update table ";
    }

}else{
    echo "Not found idnhaphaphoi";
}
?>
