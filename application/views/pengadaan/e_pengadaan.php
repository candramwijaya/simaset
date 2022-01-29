<?php
require_once './src/Excel/Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$styleArray = array(
            'font'  => array(
                'bold'  => true,
                'size'  => 14,
                'name'  => 'Times New Roman'
            )
        );
$stylejudul = array(
            'font'  => array(
                'bold'  => true,
                'size'  => 12,
                'name'  => 'Times New Roman'
            ),
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            )
        )
        );
$stylebaris = array(
            'font'  => array(
                // 'bold'  => true,
                'size'  => 12,
                'name'  => 'Times New Roman'
            ),
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            )
        )
        );
    $styleArray1 = array(
        'font'  => array(
            'bold'  => true,
            'size'  => 12,
            'color' => array('rgb' => 'FFFFFF'),
            'name'  => 'Times New Roman'
        ),
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            )
        ),
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => '1f4e78')
        )
    );

        $objPHPExcel->getSheet(0)->getCell('A1')->setValue("MATERIAL REQUEST ITEM (MRI)");
        $objPHPExcel->getSheet(0)->getStyle('A1')->applyFromArray($styleArray);
        $objPHPExcel->getSheet(0)->mergeCells('A1:K1');
        $nama = '';
        $depar='';
        $tgl='';
        foreach($idea as $cae){
            $nama=$cae['nama_user'];
            $depar=$cae['jabatan'];
            $tgl=date('d M Y',strtotime($cae['tgl_keranjang']));
        }

        $objPHPExcel->getSheet(0)->getCell('B4')->setValue("Nama Pemohon");
        $objPHPExcel->getSheet(0)->getStyle('B4')->applyFromArray($stylejudul);
        $objPHPExcel->getSheet(0)->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $objPHPExcel->getSheet(0)->getCell('B5')->setValue("Departemen");
        $objPHPExcel->getSheet(0)->getStyle('B5')->applyFromArray($stylejudul);
        $objPHPExcel->getSheet(0)->getStyle('B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $objPHPExcel->getSheet(0)->getCell('B6')->setValue("Tanggal Pengajuan");
        $objPHPExcel->getSheet(0)->getStyle('B6')->applyFromArray($stylejudul);
        $objPHPExcel->getSheet(0)->getStyle('B6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $objPHPExcel->getSheet(0)->getCell('D4')->setValue($nama);
        $objPHPExcel->getSheet(0)->getStyle('D4')->applyFromArray($stylejudul);
        $objPHPExcel->getSheet(0)->getStyle('D4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $objPHPExcel->getSheet(0)->getCell('D5')->setValue($depar);
        $objPHPExcel->getSheet(0)->getStyle('D5')->applyFromArray($stylejudul);
        $objPHPExcel->getSheet(0)->getStyle('D5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $objPHPExcel->getSheet(0)->getCell('D6')->setValue($tgl);
        $objPHPExcel->getSheet(0)->getStyle('D6')->applyFromArray($stylejudul);
        $objPHPExcel->getSheet(0)->getStyle('D6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $objPHPExcel->getSheet(0)->getCell('B9')->setValue("Nama Item");
        $objPHPExcel->getSheet(0)->getStyle('B9')->applyFromArray($stylejudul);
        $objPHPExcel->getSheet(0)->getStyle('B9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getSheet(0)->getCell('C9')->setValue("Volume");
        $objPHPExcel->getSheet(0)->getStyle('C9')->applyFromArray($stylejudul);
        $objPHPExcel->getSheet(0)->getStyle('C9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getSheet(0)->getCell('D9')->setValue("Harga");
        $objPHPExcel->getSheet(0)->getStyle('D9')->applyFromArray($stylejudul);
        $objPHPExcel->getSheet(0)->getStyle('D9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getSheet(0)->getCell('E9')->setValue("Satuan");
        $objPHPExcel->getSheet(0)->getStyle('E9')->applyFromArray($stylejudul);
        $objPHPExcel->getSheet(0)->getStyle('E9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $nomor = 10;
        $total = 0;
        foreach($item as $cam){
            $objPHPExcel->getSheet(0)->getCell('B'.$nomor)->setValue($cam['nama_kategori'].' '.$cam['nama_sub'].' '.$cam['nama_barang']);
            $objPHPExcel->getSheet(0)->getStyle('B'.$nomor)->applyFromArray($stylebaris);
            $objPHPExcel->getSheet(0)->getStyle('B'.$nomor)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getSheet(0)->getCell('C'.$nomor)->setValue($cam['volume'].' '.$cam['satuan']);
            $objPHPExcel->getSheet(0)->getStyle('C'.$nomor)->applyFromArray($stylebaris);
            $objPHPExcel->getSheet(0)->getStyle('C'.$nomor)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $total = $total+$cam['harga_satuan'];
            $objPHPExcel->getSheet(0)->getCell('D'.$nomor)->setValue($cam['harga_satuan']);
            $objPHPExcel->getSheet(0)->getStyle('D'.$nomor)->applyFromArray($stylebaris);
            $objPHPExcel->getSheet(0)->getStyle('D'.$nomor)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getSheet(0)->getCell('E'.$nomor)->setValue($cam['tahun_pengadaan']);
            $objPHPExcel->getSheet(0)->getStyle('E'.$nomor)->applyFromArray($stylebaris);
            $objPHPExcel->getSheet(0)->getStyle('E'.$nomor)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        }
        $nomor++;
            $objPHPExcel->getSheet(0)->getCell('B'.$nomor)->setValue('Total');
            $objPHPExcel->getSheet(0)->getStyle('B'.$nomor)->applyFromArray($stylebaris);
            $objPHPExcel->getSheet(0)->getStyle('B'.$nomor.':C'.$nomor)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getSheet(0)->mergeCells('B'.$nomor.':C'.$nomor);
            $objPHPExcel->getSheet(0)->getCell('D'.$nomor)->setValue($total);
            $objPHPExcel->getSheet(0)->getStyle('D'.$nomor)->applyFromArray($stylebaris);
            $objPHPExcel->getSheet(0)->getStyle('D'.$nomor)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


        foreach(range('A','G') as $columnID) {
            $objPHPExcel->getSheet(0)->getColumnDimension($columnID)
                ->setAutoSize(true);
        }


        $objPHPExcel->getSheet(0)->getColumnDimensions();

        $objPHPExcel->getSheet(0)->setTitle('MRI');


        //mulai menyimpan excel format xlsx, kalau ingin xls ganti Excel2007 menjadi Excel5          
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        ob_end_clean();
        //sesuaikan headernya 
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        //ubah nama file saat diunduh
        header('Content-Disposition: attachment;filename="MRI.xlsx"');
        //unduh file
        $objWriter->save("php://output");
?>