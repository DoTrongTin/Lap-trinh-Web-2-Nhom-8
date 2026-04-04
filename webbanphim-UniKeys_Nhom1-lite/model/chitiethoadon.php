<?php
    function getCTHoaDonByIDHoaDon($idhoadon){
        $conn = connectdb();
        if($conn){
            try {
                $sql = "SELECT cthd.idhoadon, s.tenbanphim, s.idthuonghieu, s.idnhaphaphoi, s.idctdanhmuc,
                    cthd.idbanphim, cthd.soluong, cthd.dongia, (cthd.soluong * cthd.dongia) AS thanhtien
                FROM chitiethoadon cthd
                JOIN banphim s ON cthd.idbanphim = s.idbanphim
                WHERE cthd.idhoadon = :idhoadon";
                        
                $sttm = $conn->prepare($sql);
                $sttm->bindValue(':idhoadon', $idhoadon, PDO::PARAM_INT);
                $sttm->execute();
    
                $result = $sttm->fetchAll(PDO::FETCH_ASSOC);
                return $result;
    
            } catch(PDOException $e) {
                error_log("Lỗi khi lấy chi tiết hóa đơn: " . $e->getMessage());
            }
        }
        return [];
    }    

    function addChiTietHoaDon($idhoadon, $idbanphim, $soluong, $gia) {
        try {
            $conn = connectdb();
            $sql = "INSERT INTO chitiethoadon (idhoadon, idbanphim, soluong, dongia) VALUES (:idhoadon, :idbanphim, :soluong, :dongia)";
            $sttm = $conn->prepare($sql);
            $sttm->bindValue(':idhoadon', $idhoadon, PDO::PARAM_INT);
            $sttm->bindValue(':idbanphim', $idbanphim, PDO::PARAM_INT);
            $sttm->bindValue(':soluong', $soluong, PDO::PARAM_INT);
            $sttm->bindValue(':dongia', $gia, PDO::PARAM_STR); // Sửa thành :gia
            $result = $sttm->execute();
            return $result;
        } catch (\Throwable $th) {
            error_log("Lỗi khi thêm chi tiết hóa đơn: " . $th->getMessage());
            throw $th;
        }
        
    }
?>