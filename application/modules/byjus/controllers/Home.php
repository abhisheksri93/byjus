<?php
/**
 * Created by PhpStorm.
 * User: Abhishek Srivastava
 * Date: 06-02-2019
 * Time: 14:26
 */
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);


class Home extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Home_model', 'Home');
        $this->load->model('Common_model', 'common');
    }

    public function index()
    {
        $this->load->view('index');
    }

    public function overwriteLinks()
    {
        /***** Note : There will be many other possibilities
         * to Increase this code speed ***********
         */

        $links = $this->db->select("count(*) AS totalEntry")
            ->from('college')->get()->row_array();

        $offset = 0;
        $limit = 10;

        //load our new PHPExcel library
        $this->load->library('excel');
        ob_start();
        $objPHPExcel = new PHPExcel();
        //activate worksheet number 1
        $objPHPExcel->setActiveSheetIndex(0);
        //name the worksheet
        $objPHPExcel->getActiveSheet()->setTitle('College Information');
        //set cell A1 content with some text
        $col = 'A';
        $objPHPExcel->getActiveSheet()->setCellValue($col . '1', 'SNo');
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValue($col . '1', 'College name');
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValue($col . '1', 'Links');

        $i = 2;
        $j = 1;

        while ($offset <= $links['totalEntry']) {
            $data = $this->db->select()
                ->from('college')
                ->limit($limit)
                ->offset($offset)
                ->get()->result_array();

            $offset += $limit;

            $changes = FALSE;
            foreach ($data as $key => $value) {
                if (check_url($value['links']) == FALSE) {
                    $domain = get_domain($value['links']);
                    $scheme = parse_url($value['links'])['scheme'];

                    if (check_url($scheme . "://" . $domain . "/") == FALSE) {
                        $data[$key]['links'] = base_url();
                    } else {
                        $data[$key]['links'] = $scheme . "://" . $domain . "/";
                    }
                    $changes = TRUE;
                }

                $col = 'A';
                $objPHPExcel->getActiveSheet()->setCellValue($col . $i, $j);
                $col++;

                $objPHPExcel->getActiveSheet()->setCellValue($col . $i, $data[$key]['college_name']);
                $col++;

                $objPHPExcel->getActiveSheet()->setCellValue($col . $i, $data[$key]['links']);
                $j++;
                $i++;
            }

            if ($changes)
                $this->db->update_batch('college', $data, 'id');
        }

        $objPHPExcel->getActiveSheet()->getStyle("A1:C1")->applyFromArray(array("font" => array("bold" => true)));
        $filename = 'CollegeName.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }

    public function ecryptedData()
    {
        $data['title'] = 'Inserting Encrypting data into Databases | ' . base_url();

        $data['search_by'] = "";

        $form_data = file_get_contents("php://input");
        if (!empty($form_data)) {
            $_POST = json_decode($form_data, 1)['search'];
            $_POST['page'] = isset(json_decode($form_data, 1)['page']) ? json_decode($form_data, 1)['page'] : 0;

            $userData = $this->Home->getUser();

            foreach ($userData as $key => $value) {
                $userData[$key]['userName'] = decrypt($value['userName']);
                $userData[$key]['email'] = decrypt($value['email']);
                $userData[$key]['mobile'] = decrypt($value['mobile']);
            }

            $response = array(
                'status' => array(
                    'type' => 'Success',
                    'message' => 'Taxation Available',
                    'count' => $this->Home->getUserCount(),
                ),
                'response' => $userData
            );
            echo json_encode($response);
            die();
        }

        $this->load->view('basic_form', $data);
    }

    public function addUser()
    {
        $form_data = file_get_contents("php://input");
        if (!empty($form_data)) {
            $_POST = json_decode($form_data, 1);
            $this->form_validation->set_rules('userName', 'User Name', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|is_numeric');
            if ($this->form_validation->run() == FALSE) {
                $response = array(
                    'status' => array(
                        'type' => 'Error',
                        'message' => strip_tags(validation_errors()),
                    ),
                    'response' => array(
                        'userName' => strip_tags(form_error('userName')),
                        'email' => strip_tags(form_error('email')),
                        'mobile' => strip_tags(form_error('mobile')),
                    )
                );
                echo json_encode($response);
                die();
            } else {
                $insData = array(
                    'userName' => encrypt($this->input->post('userName')),
                    'email' => encrypt($this->input->post('email')),
                    'mobile' => encrypt($this->input->post('mobile')),
                );

                $this->common->set_data('users', $insData);

                $response = array(
                    'status' => array(
                        'type' => 'Success',
                        'message' => 'Entry Saved!!',
                        'code' => 200
                    )
                );
                echo json_encode($response);
                die();
            }
        }
    }

    public function fetchEmail()
    {
        $hMail = @imap_open("{imap.gmail.com:993/imap/ssl}", "email@gmail.com", "password") or die("can't connect: " . imap_last_error());

        //load our new PHPExcel library
        $this->load->library('excel');
        ob_start();
        $objPHPExcel = new PHPExcel();
        //activate worksheet number 1
        $objPHPExcel->setActiveSheetIndex(0);
        //name the worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Email Information');
        //set cell A1 content with some text
        $col = 'A';
        $objPHPExcel->getActiveSheet()->setCellValue($col . '1', 'SNo');
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValue($col . '1', 'From');
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValue($col . '1', 'Subject');
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValue($col . '1', 'Date');
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValue($col . '1', 'Time');
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValue($col . '1', 'Tagged Label');
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValue($col . '1', 'Attachment Name/File name');

        $i = 2;
        $j = 1;

        $aHeaders = imap_headers($hMail);
        if (!empty($aHeaders)) {
            // process messages
            $count = (count($aHeaders) > 5) ? 1 : count($aHeaders);
            for ($idxMsg = 1; $idxMsg <= $count; $idxMsg++) {
                $constObj = array(
                    'message_no' => $idxMsg,
                    'connection' => $hMail,
                );
                $fetchingMailContent = new Emailfetch($constObj);

                $get_mail_body = $fetchingMailContent->get_mail_body();

                $col = 'A';
                $objPHPExcel->getActiveSheet()->setCellValue($col . $i, $j);
                $col++;

                $objPHPExcel->getActiveSheet()->setCellValue($col . $i, $get_mail_body['email_from']);
                $col++;

                $objPHPExcel->getActiveSheet()->setCellValue($col . $i, $get_mail_body['subject']);
                $col++;

                $objPHPExcel->getActiveSheet()->setCellValue($col . $i, date("Y-m-d",$get_mail_body['createdDate']));
                $col++;

                $objPHPExcel->getActiveSheet()->setCellValue($col . $i, date("H:i",$get_mail_body['createdDate']));
                $col++;

                $objPHPExcel->getActiveSheet()->setCellValue($col . $i, "Inbox");
                $col++;

                $objPHPExcel->getActiveSheet()->setCellValue($col . $i, implode(",",$get_mail_body['attachments']));
                $col++;

                $j++;
                $i++;

                //imap_delete($hMail, $idxMsg);
            }
            //imap_expunge($hMail);
        }

        $objPHPExcel->getActiveSheet()->getStyle("A1:G1")->applyFromArray(array("font" => array("bold" => true)));
        $filename = 'EmailMessages.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }

    public function calculateFucntion(){
        $ma = "((2*3)+4/(5*2))*4";

        if(preg_match('/(\d+)(?:\s*)([\+\-\*\/])(?:\s*)(\d+)/', $ma, $matches) !== FALSE){
            $operator = $matches[2];

            switch($operator){
                case '+':
                    $p = $matches[1] + $matches[3];
                    break;
                case '-':
                    $p = $matches[1] - $matches[3];
                    break;
                case '*':
                    $p = $matches[1] * $matches[3];
                    break;
                case '/':
                    $p = $matches[1] / $matches[3];
                    break;
            }

            echo $p;
        }
    }
}

?>