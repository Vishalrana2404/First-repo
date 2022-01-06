<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller 
{
    public function __construct() 
    {
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->data['session'] = $this->getSessionVal();
        $this->data['myobj'] = $this;

        if ($this->data['session']) 
        {
            $session = $this->session->all_userdata();
            if(!empty($session['uemp'])){
                $module_name = '';
                define('MODULE_NAME', $module_name);
            }
            else{
                $module_name = $this->data['session']->module_name . '/';
                define('MODULE_NAME', $module_name);
            }
        } 
        else 
        {
            $module_name = '';
            define('MODULE_NAME', $module_name);
        }

        if(!empty($_POST['lng'])){              
            $this->session->set_userdata($_POST);
        }
        else{
            $sess=$this->session->all_userdata();
            if(!empty($sess['lng'])){
                $data['lng'] = $sess['lng'];
                $this->session->set_userdata($data);
            }
            else{
                $data['lng'] = 'ara';
                $this->session->set_userdata($data);
            }
        }
    }

    /*  get Session Value */
    public function getSessionVal() 
    {
        $sess_val = '';
        $session = $this->session->all_userdata();
        if (!empty($session['admin'])) 
        {
            $sess_val = $session['admin']['0'];
        } 
        elseif (!empty($session['uemp'])) 
        {
            $sess_val = $session['uemp']['0'];
        }
        return $sess_val;
    }

    /*  get Session Value */
    public function getSessionValFront() 
    {
        $sess_val = '';
        $session = $this->session->all_userdata();
        if (!empty($session['uemp'])) 
        {
            $sess_val = $session['uemp'];
        }
        return $sess_val;
    }

    /* load the view files */
    public function show_view_front($view, $data = '') 
    {
        $data['myobj'] = $this;
        $session = $this->session->all_userdata();
        if(!empty($session)){
            $data['lng'] = $session['lng'];
        }
        else{
            if(!empty($_POST['lng'])){              
                $this->session->set_userdata($_POST);
            }
            else{
                $sess=$this->session->all_userdata();
                if(!empty($sess['lng'])){
                    $data['lng'] = $sess['lng'];
                    $this->session->set_userdata($data);
                }
                else{
                    $data['lng'] = 'ara';
                    $this->session->set_userdata($data);
                }
            }
        }
        if ($this->getSessionVal()) 
        {
            if (!empty($session['admin'])) 
            {
                $this->session->unset_userdata('admin');
            } 
            if (!empty($session['uemp'])) 
            {
                $sess_val = $session['uemp']['0'];
                $data['user_name'] = $sess_val->customer_name;
                $data['user_id'] = $sess_val->customer_id;
                $this->load->view('front/layout/header_login', $data);
                $this->load->view($view, $data);
                $this->load->view('front/layout/footer', $data);
            }
            else{
                $data['user_id'] = '';
                $this->load->view('front/layout/header', $data);
                $this->load->view($view, $data);
                $this->load->view('front/layout/footer', $data);
            }
        }
        else{
            $data['user_id'] = '';
            $this->load->view('front/layout/header', $data);
            $this->load->view($view, $data);
            $this->load->view('front/layout/footer', $data);
        }
    }

    public function show_view($view, $data = '') 
    {
        if ($this->getSessionVal()) 
        {
            $session = $this->session->all_userdata();
            if(!empty($session)){
                $data['lng'] = $session['lng'];
            }
            else{
                if(!empty($_POST['lng'])){              
                    $this->session->set_userdata($_POST);
                }
                else{
                    $sess=$this->session->all_userdata();
                    if(!empty($sess['lng'])){
                        $data['lng'] = $sess['lng'];
                        $this->session->set_userdata($data);
                    }
                    else{
                        $data['lng'] = 'ara';
                        $this->session->set_userdata($data);
                    }
                }
            }
            $sess_val = $this->getSessionVal();
            $module_name = $sess_val->module_name;
            $role_id = $sess_val->role_id;
            $tbl_prefix = $sess_val->user_tbl_prefix;
            $data['getAllParentRole'] = $this->common_model->getAllParentRole($role_id, $tbl_prefix);
            $data['myobj'] = $this;
            $data['user_name'] = $sess_val->user_fname . ' ' . $sess_val->user_lname;
            $data['user_id'] = $sess_val->user_id;
            $data['role_id'] = $sess_val->role_id;
            $data['user_tbl_prefix'] = $tbl_prefix;
            $this->load->view(MODULE_NAME . 'layout/header', $data);
            $this->load->view(MODULE_NAME . 'layout/sidebar', $data);
            $this->load->view($view, $data);
            $this->load->view(MODULE_NAME . 'layout/footer', $data);
        } 
        else 
        {
            redirect(base_url());
        }
    }

    /* Check tab Permissions */
    /* View */
    public function checkViewPermission() 
    {
        $sess_val = $this->getSessionVal();
        if (!empty($sess_val)) 
        {
            $role_id = $sess_val->role_id;
            $tbl_prefix = $sess_val->user_tbl_prefix;
            $TabAsPerRole = $this->common_model->getAllTabAsPerRole($role_id, $tbl_prefix);
            if (!empty($TabAsPerRole)) 
            {
                foreach ($TabAsPerRole as $tab_list) 
                {
                    if ($tab_list->controller_name == $this->uri->segment(2)) 
                    {
                        if ($tab_list->userView == '1') 
                        {
                            return true;
                        } 
                        else 
                        {
                            return false;
                        }
                    }
                }
            } 
            else 
            {
                return true;
            }
        } 
        else 
        {
            return false;
        }
    }

    /* Add */
    public function checkAddPermission() 
    {
        $sess_val = $this->getSessionVal();
        if (!empty($sess_val)) 
        {
            $role_id = $sess_val->role_id;
            $tbl_prefix = $sess_val->user_tbl_prefix;
            $TabAsPerRole = $this->common_model->getAllTabAsPerRole($role_id, $tbl_prefix);
            foreach ($TabAsPerRole as $tab_list) 
            {
                if ($tab_list->controller_name == $this->uri->segment(2)) 
                {
                    if ($tab_list->userAdd == '1') 
                    {
                        return true;
                    } 
                    else 
                    {
                        return false;
                    }
                }
            }
        } 
        else 
        {
            return false;
        }
    }

    /* Edit */
    public function checkEditPermission() 
    {
        $sess_val = $this->getSessionVal();
        if (!empty($sess_val)) 
        {
            $role_id = $sess_val->role_id;
            $tbl_prefix = $sess_val->user_tbl_prefix;
            $TabAsPerRole = $this->common_model->getAllTabAsPerRole($role_id, $tbl_prefix);
            foreach ($TabAsPerRole as $tab_list) 
            {
                if ($tab_list->controller_name == $this->uri->segment(2)) 
                {
                    if ($tab_list->userEdit == '1') 
                    {
                        return true;
                    } 
                    else 
                    {
                        return false;
                    }
                }
            }
        } 
        else 
        {
            return false;
        }
    }

    /* Delete */
    public function checkDeletePermission() 
    {
        $sess_val = $this->getSessionVal();
        if (!empty($sess_val)) 
        {
            $role_id = $sess_val->role_id;
            $tbl_prefix = $sess_val->user_tbl_prefix;
            $TabAsPerRole = $this->common_model->getAllTabAsPerRole($role_id, $tbl_prefix);
            foreach ($TabAsPerRole as $tab_list) 
            {
                if ($tab_list->controller_name == $this->uri->segment(2)) 
                {
                    if ($tab_list->userDelete == '1') 
                    {
                        return true;
                    } 
                    else 
                    {
                        return false;
                    }
                }
            }
        } 
        else 
        {
            return false;
        }
    }
    /* END check permission */

    /* XSS Clean */
    public function xssCleanValidate($input_array) 
    {
        $out_array = array();
        foreach ($input_array as $key => $value) 
        {
            $out_array[$key] = $this->security->xss_clean($value);
        }
        return $out_array;
    }

    /*  Mail Send */
    public function send_mail($email, $subject, $message)    
    {
        $this->load->library('PHPMailer/phpmailer');
        $mail = new PHPMailer();
        $mail->IsSMTP();   
        $mail->Host = "smtp.gmail.com";  // specify main and backup server
        $mail->SMTPAuth = true;     // turn on SMTP authentication
        $mail->Username = "crazywebdemo@gmail.com";  // SMTP username
        $mail->Password = "cwd@1234554321"; // SMTP password
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;
        $mail->From = "crazywebdemo@gmail.com";
        $mail->FromName = "CWD";
        $mail->AddAddress($email);
        $mail->WordWrap = 50; 
        $mail->IsHTML(true); 
        $mail->Subject = $subject;
        $mail->Body    = $message;
        // $file_to_attach = 'webroot/admin/upload/order_product/';
        // $email->AddAttachment( $file_to_attach , $filename);
        if(!$mail->Send())
        {
          return false;
        }
        else
        {
            return true;
        }
    }

    /* Upload Image */
    public function ImageUpload($filename, $name, $imagePath, $fieldName) 
    {
        $temp = explode(".", $filename);
        $extension = end($temp);
        $filenew = date('d-M-Y') . '_' . str_replace($filename, $name, $filename) . '_' . time() . '' . rand() . "." . $extension;
        $config['file_name'] = $filenew;
        $config['upload_path'] = $imagePath;
        $config['allowed_types'] = 'GIF | gif | JPE | jpe | JPEG | jpeg | JPG | jpg | PNG | png';
        $this->upload->initialize($config);
        $this->upload->set_allowed_types('*');
        $this->upload->set_filename($config['upload_path'], $filenew);
        if (!$this->upload->do_upload($fieldName)) 
        {
            $data = array('msg' => $this->upload->display_errors());
        } 
        else 
        {
            $data = $this->upload->data();
            $imageName = $data['file_name'];
            return $imageName;
        }
    }

    /* Upload Image */
    public function FileUpload($filename, $name, $imagePath, $fieldName, $allowed_types) 
    {
        $temp = explode(".", $filename);
        $extension = end($temp);
        $filenew = date('d-M-Y') . '_' . str_replace($filename, $name, $filename) . '_' . time() . '' . rand() . "." . $extension;
        $config['file_name'] = $filenew;
        $config['upload_path'] = $imagePath;
        // $config['allowed_types'] = $allowed_types;
        $this->upload->initialize($config);
        $this->upload->set_allowed_types('*');
        $this->upload->set_filename($config['upload_path'], $filenew);
        if (!$this->upload->do_upload($fieldName)) 
        {
            $data = array('msg' => $this->upload->display_errors());
        } 
        else 
        {
            $data = $this->upload->data();
            $imageName = $data['file_name'];
            return $imageName;
        }
    }

    /* Upload Image */
    public function FileUploadSize($filename, $name, $imagePath, $fieldName, $allowed_types, $max_size) 
    {
        $temp = explode(".", $filename);
        $extension = end($temp);
        $filenew = date('d-M-Y') . '_' . str_replace($filename, $name, $filename) . '_' . time() . '' . rand() . "." . $extension;
        $config['file_name'] = $filenew;
        $config['upload_path'] = $imagePath;
        $config['allowed_types'] = $allowed_types;
        $config['max_size'] = $max_size;
        $this->upload->initialize($config);
        $this->upload->set_allowed_types('*');
        $this->upload->set_filename($config['upload_path'], $filenew);
        if (!$this->upload->do_upload($fieldName)) {
            $data = array('msg' => $this->upload->display_errors());
        } 
        else 
        {
            $data = $this->upload->data();
            $imageName = $data['file_name'];
            return $imageName;
        }
    }

    public function alpha_dash_space($fullname) 
    {
        if (!preg_match('/^[a-zA-Z\s]+$/', $fullname)) 
        {
            $this->form_validation->set_message('alpha_dash_space', 'The %s field may only contain alpha characters & White spaces');
            return FALSE;
        } 
        else 
        {
            return TRUE;
        }
    }

    public function float_space($number) 
    {
        if (preg_match("/^(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})$/", $number)) 
        {
            return true;
        } 
        else 
        {
            return false;
        }
    }

    /* All Date releted function */
    public function getNumberOfDays($start_date, $end_date) 
    {
        $days_remain = (strtotime($end_date) - strtotime($start_date)) / (60 * 60 * 24);
        return round($days_remain) + 1;
    }
    
    public function sign_value($number) 
    {
        return ($number > 0) ? 1 : (($number < 0) ? -1 : 0);
    }
    
    public function getNumberOfWeekDay($start_date, $end_date, $day_number) 
    {
        $tm1 = strtotime($start_date);
        $tm2 = strtotime($end_date);
        $dt = Array();
        $total_days = 0;
        for ($i = $tm1;$i <= $tm2;$i = $i + 86400) 
        {
            if (date("w", $i) == $day_number) 
            {
                $dt[] = date("l Y-m-d ", $i);
                $total_days++;
            }
        }
        return $total_days;
    }

    public function getWeekDays($start_date, $end_date) 
    {
        $tm1 = strtotime($start_date);
        $tm2 = strtotime($end_date);
        $dt = Array();
        $aa = '';
        $ss = 1;
        for ($i = $tm1;$i <= $tm2;$i = $i + 86400) 
        {
            $s = date("l", $i);
            if ($s != 'Sunday') 
            {
                if ($aa != '') 
                {
                    $aa = $aa . ',' . date("Y-m-d", $i);
                } 
                else 
                {
                    $aa = date("Y-m-d", $i);
                }
                $ss++;
            } 
            else 
            {
                if (!empty($aa)) 
                {
                    $dt[] = $aa;
                    $aa = '';
                    $ss = 1;
                }
            }
        }
        $dt[] = $aa;
        return $dt;
    }

    public function getNumberOfWeeksAndDays($start_date, $end_date) 
    {
        $day          = 24 * 3600;
        $start_date = strtotime($start_date);
        $end_date = strtotime($end_date) + $day;
        $diff   = abs($end_date - $start_date);
        $weeks = floor($diff / $day / 7);
        $days = floor($diff / $day - $weeks * 7);
        $out = array();
        if ($weeks) $out[] = "$weeks Week" . ($weeks > 1 ? 's' : '');
        if ($days) $out[] = "$days Day" . ($days > 1 ? 's' : '');
        return implode(', ', $out);
    }

    public function getAllDates($start_date, $end_date) 
    {
        $tm1 = strtotime($start_date);
        $tm2 = strtotime($end_date);
        $dt = Array();
        $aa = '';
        for ($i = $tm1;$i <= $tm2;$i = $i + 86400) 
        {
            $s = date("l", $i);
            if ($aa != '') 
            {
                $aa = $aa . ',' . date("Y-m-d", $i);
            } 
            else 
            {
                $aa = date("Y-m-d", $i);
            }
        }
        return $aa;
    }


    public function getAllWeekoffCount($start_date, $end_date, $week_off_day) 
    {
        $tm1 = strtotime($start_date);
        $tm2 = strtotime($end_date);
        $dt = Array();
        $aa = '0';
        for ($i = $tm1;$i <= $tm2;$i = $i + 86400) 
        {
            $s = date("l", $i);
            if($s == $week_off_day)
            {
                $aa++;
            }
        }
        return $aa;
    }

    public function getAllDatesByMonthYear($month_year) 
    {
        $tm1 = strtotime($month_year.'-01');
        $tm2 = strtotime(date('Y-m-t', $tm1));
        $dt = Array();
        for ($i=$tm1; $i<=$tm2; $i=$i+86400) 
        {
            $dt[] = date("Y-m-d", $i);
        }
        return $dt;
    }

    public function getAllDatesYear($start_date, $end_date) 
    {
        $tm1 = strtotime($start_date);
        $tm2 = strtotime($end_date);
        $dt = array();
        $aa = '';
        for ($i = $tm1;$i <= $tm2;$i = $i + 86400) 
        {
            $s = date("l", $i);
            if(!empty($dt))
            {
                $dt[] = date("Y", $i);
            }
            else
            {
                $dt[] = date("Y", $i);
            }
        }
        if(!empty($dt))
        {
            $aa = implode(',', array_unique($dt));
        }
        return $aa;
    }

    public function getAllDatesMonthYear($start_date, $end_date) 
    {
        $tm1 = strtotime($start_date);
        $tm2 = strtotime($end_date);
        $dt = Array();
        $aa = '';
        for ($i = $tm1;$i <= $tm2;$i = $i + 86400) 
        {
            if (!empty($dt)) 
            {
                $m_val = date("Y-m", $i);
                if (!in_array($m_val, $dt)) 
                {
                    $dt[] = $m_val;
                }
            } 
            else 
            {
                $dt[] = date("Y-m", $i);
            }
        }
        return array_unique($dt);
    }

    public function getAllDatesMonth($start_date, $end_date) 
    {
        $tm1 = strtotime($start_date);
        $tm2 = strtotime($end_date);
        $dt = Array();
        $aa = '';
        for ($i = $tm1;$i <= $tm2;$i = $i + 86400) 
        {
            if (!empty($dt)) 
            {
                $m_val = date("m", $i);
                if (!in_array($m_val, $dt)) 
                {
                    $dt[] = $m_val;
                }
            } 
            else 
            {
                $dt[] = date("m", $i);
            }
        }
        return array_unique($dt);
    }

    public function weekDayName($week_no) 
    {
        $week_name = '';
        if ($week_no == '1') 
        {
            $week_name = 'Monday';
        } 
        elseif ($week_no == '2') 
        {
            $week_name = 'Tuesday';
        } 
        elseif ($week_no == '3') 
        {
            $week_name = 'Wednesday';
        } 
        elseif ($week_no == '4') 
        {
            $week_name = 'Thursday';
        } 
        elseif ($week_no == '5') 
        {
            $week_name = 'Friday';
        } 
        elseif ($week_no == '6') 
        {
            $week_name = 'Saturday';
        } 
        elseif ($week_no == '7') 
        {
            $week_name = 'Sunday';
        }
        return $week_name;
    }

    public function getNumberOfWeeks($start_date, $end_date) 
    {
        $day = 24 * 3600;
        $start_date = strtotime($start_date);
        $end_date = strtotime($end_date) + $day;
        $diff = abs($end_date - $start_date);
        $weeks = floor($diff / $day / 7);
        $days = floor($diff / $day - $weeks * 7);
        $out = array();
        if ($weeks) $out[] = "$weeks" . ($weeks > 1 ? '' : '');
        return implode(', ', $out);
    }

    public function sendMessage($mobileNumber, $message) 
    {
        $endpoint = "https://www.kit19.com/ComposeSMS.aspx?username=ekaumotp794454&password=6337&sender=EKAUMS&to=".$mobileNumber."&message=".rawurlencode( $message )."&priority=1&dnd=1&unicode=0&dlttemplateid=1707162385916609980";
        $ch = curl_init();
        curl_setopt_array($ch, array(
        CURLOPT_URL => $endpoint,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET"
        ));
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public function getTrxNo() 
    {
        $this->id = rand(100, 1000);
        for ($i = 1;$i <= 3;$i++) 
        {
            if (rand(0, 1)) 
            {
                $this->id.= chr(rand(65, 90));
            } 
            else 
            {
                // number;
                $this->id.= rand(0, 9);
            }
        }
        return 'TRX-' . $this->id;
    }

    public function get_table_details($table, $column, $value) 
    {
        $sql = "SELECT * FROM `$table` WHERE `$column` = '" . $value . "'";
        $res = mysql_query($sql);
        $row = mysql_fetch_assoc($res);
        return $row;
    }

    public function chkUniqueTrxNo() 
    {
        $trx_no = $this->getTrxNo();
        $res = $this->get_table_details('tbl_user_advance_salary_details', 'trx_no', $trx_no);
        if (!$res) 
        {
            return $trx_no;
        } 
        else 
        {
            $this->chkUniqueTrxNo();
        }
    }

    public function get_date_between_date($start_date, $end_date) 
    {
        $new_date = FALSE;
        $date_arr[] = $start_date;
        while ($new_date != $end_date) 
        {
            $date = date_create($start_date);
            date_add($date, date_interval_create_from_date_string("1 days"));
            $new_date = date_format($date, "Y-m-d");
            $date_arr[] = $new_date;
            $start_date = $new_date;
        }
        return $date_arr;
    }

    public function Show_Amount_In_Words($num) 
    {
        $ones = array('', ' One', ' Two', ' Three', ' Four', ' Five', ' Six', ' Seven', ' Eight', ' Nine', ' Ten', ' Eleven', ' Twelve', ' Thirteen', ' Fourteen', ' Fifteen', ' Sixteen', ' Seventeen', ' Eighteen', ' Nineteen');
        $tens = array('', '', ' Twenty', ' Thirty', ' Fourty', ' Fifty', ' Sixty', ' Seventy', ' Eighty', ' Ninety',);
        $triplets = array('', ' Thousand', ' Lac', ' Crore', ' Arab', ' Kharab');
        $str = "";
        $th = (int)($num / 1000);
        $x = (int)($num / 100) % 10;
        $fo = explode('.', $num);
        if ($fo[0] != null) 
        {
            $y = (int)substr($fo[0], -2);
        } 
        else 
        {
            $y = 0;
        }
        if ($x > 0) 
        {
            $str = $ones[$x] . ' Hundred';
        }
        if ($y > 0) 
        {
            if ($y < 20) 
            {
                $str.= $ones[$y];
            } 
            else 
            {
                $str.= $tens[($y / 10) ] . $ones[($y % 10) ];
            }
        }
        $tri = 1;
        while ($th != 0) 
        {
            $lk = $th % 100;
            $th = (int)($th / 100);
            $count = $tri;
            if ($lk < 20) 
            {
                if ($lk == 0) 
                {
                    $tri = 0;
                }
                $str = $ones[$lk] . $triplets[$tri] . $str;
                $tri = $count;
                $tri++;
            } 
            else 
            {
                $str = $tens[$lk / 10] . $ones[$lk % 10] . $triplets[$tri] . $str;
                $tri++;
            }
        }
        $num = (float)$num;
        if (is_float($num)) 
        {
            $fo = (String)$num;
            $fo = explode('.', $fo);
            $fo1 = @$fo[1];
        } 
        else 
        {
            $fo1 = 0;
        }
        $check = (int)$num;
        if ($check != 0) 
        {
            return $str . ' Rupees' . $this->forDecimal($fo1);
        } 
        else 
        {
            return $this->forDecimal($fo1);
        }
    }

    public function forDecimal($num) 
    {
        $ones = array('', ' One', ' Two', ' Three', ' Four', ' Five', ' Six', ' Seven', ' Eight', ' Nine', ' Ten', ' Eleven', ' Twelve', ' Thirteen', ' Fourteen', ' Fifteen', ' Sixteen', ' Seventeen', ' Eighteen', ' Nineteen');
        $tens = array('', '', ' Twenty', ' Thirty', ' Fourty', ' Fifty', ' Sixty', ' Seventy', ' Eighty', ' Ninety',);
        $str = "";
        $len = strlen($num);
        if ($len == 1) 
        {
            $num = $num * 10;
        }
        $x = $num % 100;
        if ($x > 0) 
        {
            if ($x < 20) 
            {
                $str = $ones[$x] . ' Paise';
            } 
            else 
            {
                $str = $tens[$x / 10] . $ones[$x % 10] . ' Paise';
            }
        }
        return $str;
    }

    function loadPo($word){
        $sess=$this->session->all_userdata();
        if(isset($sess['lng'])){
            $filename='webroot/language/'.$sess['lng'].'.po';
        }else{
            $filename='webroot/language/eng.po'; 
        }
        if (!$file = fopen($filename, 'r')){
            return false;
        }
        $type = 0;
        $translations = array();
        $translationKey = '';
        $plural = 0;
        $header = '';
            do {
            $line = trim(fgets($file));
            if ($line === '' || $line[0] === '#') {
                continue;
            }
            if (preg_match("/msgid[[:space:]]+\"(.+)\"$/i", $line, $regs)) {
                $type = 1;
                $translationKey = stripcslashes($regs[1]);
            } elseif (preg_match("/msgid[[:space:]]+\"\"$/i", $line, $regs)) {
                $type = 2;
                $translationKey = '';
            } elseif (preg_match("/^\"(.*)\"$/i", $line, $regs) && ($type == 1 || $type == 2 || $type == 3)) {
                $type = 3;
                $translationKey .= stripcslashes($regs[1]);
            } elseif (preg_match("/msgstr[[:space:]]+\"(.+)\"$/i", $line, $regs) && ($type == 1 || $type == 3) && $translationKey) {
                $translations[$translationKey] = stripcslashes($regs[1]);
                $type = 4;
            } elseif (preg_match("/msgstr[[:space:]]+\"\"$/i", $line, $regs) && ($type == 1 || $type == 3) && $translationKey) {
                $type = 4;
                $translations[$translationKey] = '';
            } elseif (preg_match("/^\"(.*)\"$/i", $line, $regs) && $type == 4 && $translationKey) {
                $translations[$translationKey] .= stripcslashes($regs[1]);
            } elseif (preg_match("/msgid_plural[[:space:]]+\".*\"$/i", $line, $regs)) {
                $type = 6;
            } elseif (preg_match("/^\"(.*)\"$/i", $line, $regs) && $type == 6 && $translationKey) {
                $type = 6;
            } elseif (preg_match("/msgstr\[(\d+)\][[:space:]]+\"(.+)\"$/i", $line, $regs) && ($type == 6 || $type == 7) && $translationKey) {
                $plural = $regs[1];
                $translations[$translationKey][$plural] = stripcslashes($regs[2]);
                $type = 7;
            } elseif (preg_match("/msgstr\[(\d+)\][[:space:]]+\"\"$/i", $line, $regs) && ($type == 6 || $type == 7) && $translationKey) {
                $plural = $regs[1];
                $translations[$translationKey][$plural] = '';
                $type = 7;
            } elseif (preg_match("/^\"(.*)\"$/i", $line, $regs) && $type == 7 && $translationKey) {
                $translations[$translationKey][$plural] .= stripcslashes($regs[1]);
            } elseif (preg_match("/msgstr[[:space:]]+\"(.+)\"$/i", $line, $regs) && $type == 2 && !$translationKey) {
                $header .= stripcslashes($regs[1]);
                $type = 5;
            } elseif (preg_match("/msgstr[[:space:]]+\"\"$/i", $line, $regs) && !$translationKey) {
                $header = '';
                $type = 5;
            } elseif (preg_match("/^\"(.*)\"$/i", $line, $regs) && $type == 5) {
                $header .= stripcslashes($regs[1]);
            } else {
                unset($translations[$translationKey]);
                $type = 0;
                $translationKey = '';
                $plural = 0;
            }
        } while (!feof($file));
        fclose($file);
        $merge[''] = $header;
        $translations= array_merge($merge, $translations);
        if (array_key_exists($word,$translations)){
            return $translations[$word];
        }else{
            return $word;
        }
    }
}
?>