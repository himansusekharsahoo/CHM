<?php

/**
 * @param
 * @return
 * @desc
 * @author
 */
require_once APPPATH . "/third_party/PHPExcel.php";

class Excel_utility {

    public function __construct() {
        $this->_excel = new PHPExcel();
        $this->_set_active_sheet();
    }

    private $_configs = array();
    private $_row_indx = 0;
    private $_header_indx = 0;
    private $_last_column = '';
    private $_freeze_column = '';
    private $_auto_filter_flag = false;
    private $_freeze_column_flag = false;
    private $_excel;
    private $_active_sheet;

    private function _validate_options($config) {
        $flag = FALSE;
        if (is_array($config)) {
            if (isset($config['db_data']) && is_array($config['db_data']) && isset($config['header_rows']) && is_array($config['header_rows']) && isset($config['body_column']) && is_array($config['body_column'])) {
                $flag = TRUE;
                $this->_set_config($config);
            }
        }
        return $flag;
    }

    /**
     * @param
     * @return
     * @desc
     * @author
     */
    private function _set_config($config) {
        $this->_configs = $config;
        return $this;
    }

    /**
     * @param
     * @return
     * @desc
     * @author
     */
    private function _set_active_sheet() {
        $this->_active_sheet = $this->_excel->getActiveSheet();
    }

    /**
     * @param
     * @return
     * @desc
     * @author
     */
    private function _create_header() {
        if (is_array($this->_configs['header_rows'])) {
            $header = $this->_configs['header_rows'];

            foreach ($this->_configs['header_rows'] as $rows) {
                $this->_row_indx++;
                //start creating rows                
                $xcol = '';
                foreach ($rows as $col_indx => $cols) {
                    if ($xcol == '') {
                        $xcol = 'A';
                    } else {
                        $xcol++;
                    }
                    if (is_array($cols)) {

                        //merge cells
                        $range_cols = $xcol;
                        //merge cells
                        if (isset($cols['colspan'])) {
                            //this odd loop required to increate the xls char column increment
                            for ($lp = 1; $lp < $cols['colspan']; $lp++) {
                                ++$range_cols;
                            }
                            $this->_active_sheet->mergeCells($xcol . $this->_row_indx . ':' . $range_cols . $this->_row_indx);
                        }

                        if (array_key_exists('xls_header', $cols)) {
                            $this->_active_sheet->SetCellValue($xcol . $this->_row_indx, strip_tags($cols['xls_header']));
                            //make header text bold                                
                            $this->_active_sheet->getStyle($xcol . $this->_row_indx . ':' . $xcol . $this->_row_indx)->getFont()->setBold(true);
                        } else {
                            if (isset($cols['title']) && isset($cols['value'])) {
                                $this->_active_sheet->SetCellValue($xcol . $this->_row_indx, strip_tags($cols['title']));
                                $this->_active_sheet->SetCellValue( ++$range_cols . $this->_row_indx, strip_tags($cols['value']));
                                //make header text bold                                
                                $this->_active_sheet->getStyle($xcol . $this->_row_indx . ':' . $xcol . $this->_row_indx)->getFont()->setBold(true);
                            } else if (isset($cols['title']) && (!isset($cols['value']) || $cols['value'] == '')) {
                                //set autofilter

                                if (isset($cols['track_auto_filter']) && $cols['track_auto_filter']) {
                                    $this->_auto_filter_flag = true;                                    
                                }
                                $this->_header_indx = $this->_row_indx;
                                //set freeze column
                                if (isset($cols['freeze_column']) && $cols['freeze_column'] && !$this->_freeze_column) {
                                    $this->_freeze_column_flag = true;
                                    $this->_freeze_column = $xcol . ($this->_row_indx+1);
                                }

                                $this->_active_sheet->SetCellValue($xcol . $this->_row_indx, strip_tags($cols['title']));
                                //set column autowidth
                                $this->_active_sheet->getColumnDimension($xcol)->setAutoSize(true);
                                //make header text bold                                
                                $this->_active_sheet->getStyle('A' . $this->_row_indx . ':' . $xcol . $this->_row_indx)->getFont()->setBold(true);
                            }
                        }
                        $xcol = $range_cols;
                    }
                }
                //set for auto filter purpose
                $this->_last_column = $xcol;
                $this->_set_header_style();
            }
        }

        return $this;
    }

    private function _set_style_array() {
        
    }

    /**
     * @param
     * @return
     * @desc
     * @author
     */
    private function _set_header_style() {
        $cellRange = 'A' . $this->_header_indx . ":" . $this->_last_column . $this->_header_indx;

        $style_overlay = array(
            'font' => array(
                'color' => array('rgb' => '000000')                
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'CCCCFF')
            ),
            'alignment' => array(
                'wrap' => true,
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP
            ),
            'borders' => array(
                'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
            )
        );
        $this->_active_sheet->getStyle($cellRange)->applyFromArray($style_overlay);
        return $this;
    }

    /**
     * @param
     * @return
     * @desc
     * @author
     */
    private function _set_auto_filter() {
        if ($this->_auto_filter_flag) {
            $cellRange = 'A' . $this->_header_indx . ":" . $this->_last_column . $this->_header_indx;
            $this->_active_sheet->setAutoFilter($cellRange);
        }
        return $this;
    }

    /**
     * @param
     * @return
     * @desc
     * @author
     */
    private function _set_freeze_column() {
        if ($this->_freeze_column_flag) {
            $this->_active_sheet->freezePane($this->_freeze_column);
        }
        return $this;
    }

    /**
     * @param
     * @return
     * @desc
     * @author
     */
    private function _create_body() {

        $this->_row_indx++;
        //pma($this->_configs['db_data'],1);
        foreach ($this->_configs['db_data'] as $data_row) {
            $xcol = '';
            foreach ($this->_configs['body_column'] as $col_indx => $cols) {
                if ($xcol == '') {
                    $xcol = 'A';
                } else {
                    $xcol++;
                }
                $range_cols = $xcol;
                //merge cells
                if (isset($cols['colspan'])) {
                    //this odd loop required to increate the xls char column increment
                    for ($lp = 0; $lp < $cols['colspan']; $lp++) {
                        ++$range_cols;
                    }
                    $this->_active_sheet->mergeCells($xcol . $this->_row_indx . ':' . $range_cols . $this->_row_indx);
                }

                if (array_key_exists($cols['db_column'], $data_row)) {
                    //$active_sheet->setCellValueByColumnAndRow($xcol, $this->_row_indx, $data_row[$cols['db_column']]);
                    //app_log('CUSTOM', 'APP', $xcol . $this->_row_indx . $cols['db_column'] . '=' . $data_row[$cols['db_column']]);
                    $this->_active_sheet->SetCellValue($xcol . $this->_row_indx, $data_row[$cols['db_column']]);
                }
                $xcol = $range_cols;
            }
            $this->_row_indx++;
        }

        return $this;
    }

    /**
     * @param
     * @return
     * @desc
     * @author
     */
    private function _set_worksheet_name(){
        if(isset($this->_configs['worksheet_name'])){
            $this->_active_sheet->setTitle($this->_configs['worksheet_name']);
        }
        return $this;
    }
    /**
     * @param
     * @return
     * @desc
     * @author
     */
    public function download_excel($config) {
        if ($this->_validate_options($config)) {
            $this->_create_header()                    
                    ->_create_body()
                    ->_set_auto_filter()
                    ->_set_freeze_column()
                    ->_set_worksheet_name()
                    ->_download();
        } else {
            return FALSE;
        }
    }

    public function save_excel() {
        if ($this->_validate_options($config)) {
            return $this->_create_header()
                            ->_create_body()
                            ->_set_auto_filter()
                            ->_set_freeze_column()
                            ->_set_header_style()
                            ->_write_file();
        } else {
            return FALSE;
        }
    }

    /**
     * @param
     * @return
     * @desc
     * @author
     */
    private function _download() {
        $objWriter = PHPExcel_IOFactory::createWriter($this->_excel, 'Excel2007');
        ob_end_clean();
        ob_start();
        $objWriter->save("php://output");
        $xlsData = ob_get_contents();
        $file_name='test_xls.xlsx';
        if(isset($this->_configs['file_name'])){
            $file_name=$this->_configs['file_name'];
        }
        ob_end_clean();
        $response = array(
            'op' => 'ok',
            'file' => "data:application/octet-stream;base64," . base64_encode($xlsData),
            'file_name' => $file_name
        );
        echo json_encode($response);
        exit();
    }

    /**
     * @param
     * @return
     * @desc
     * @author
     */
    private function _write_file($full_filename) {
        if (isset($this->_configs['file_name']) && $this->_configs['file_name'] != '') {
            header('Pragma: ');
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $full_filename . '"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
            exit();
        }
        return false;
    }

}
