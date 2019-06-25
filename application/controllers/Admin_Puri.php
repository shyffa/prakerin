<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Puri extends CI_Controller {

  public function __construct() {
    parent::__construct();
    is_logged_in();
    $this->load->model('lowongan_m');
    $this->load->helper('form');
    $this->load->library('form_validation');
  }

  public function index() {
      $data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
      $this->load->view('admin/index',$data);
  }

  public function lowongan(){
    $data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
    $data['loker'] = $this->lowongan_m->getLowonganPekerjaan();
    $this->load->view('admin/lowongan',$data);
  }

  public function tambahLowongan(){
    $data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
    if(isset($_POST['submit'])){
              $posisi = $this->input->post('posisi');
              $penempatan = $this->input->post('penempatan');
              $syarat = $this->input->post('syarat');
              $batas = $this->input->post('batas');
              $uploadImage = $_FILES['gambar']['name'];
              if ($uploadImage) {
                // code...
              }

         // input ke database
              $input = array(
                      'posisi' => $posisi,
                      'penempatan' => $penempatan,
                      'syarat' => $syarat,
                      'role_id' => 1,
                      'batas' => $batas,
                      'gambar' => $uploadImage


              );
              $this->lowongan_m->insert($input);
              $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
               Loker telah ditambahkan
              </div>');
              redirect('Admin_Puri/lowongan');
          }
  }

  public function viewPendaftar()
  {
    $this->load->model("excel_export_model");
    $data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
    $data["employee_data"] = $this->excel_export_model->fetch_data();
    $this->load->view('informasiinfo',$data);
  }

  public function delPelamarC($id_pelamar){
    $this->load->model("Excel_export_model");
    $this->Excel_export_model->delPelamarM($id_pelamar);
    redirect($_SERVER['HTTP_REFERER']);
  }

  public function delAllPendaftar(){
    $this->pemiluM->delKomen($no);
    redirect($_SERVER['HTTP_REFERER']);
  }

  public function Excel_Export()
  {
    $this->load->model("excel_export_model");

    $data["employee_data"] = $this->excel_export_model->fetch_data();
    $data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
    $this->load->view("admin/pelamar", $data);
  }

  function action(){

    $this->load->model("excel_export_model");

    $this->load->library("excel");

    $object = new PHPExcel();

    $object->setActiveSheetIndex(0);

    $table_columns = array("posisi", "nama", "tgl_lahir", "tmpt_lahir", "gender", "status", "agama", "alamat", "nomor", "email");

    $column = 0;

    foreach($table_columns as $field){

      $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);

      $column++;

    }

    $employee_data = $this->excel_export_model->fetch_data();

    $excel_row = 2;

    foreach($employee_data as $row){

      $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->posisi);
      $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->nama);
      $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->tgl_lahir);
      $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->tmpt_lahir);
      $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->gender);
      $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->status);
      $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->agama);
      $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row->alamat);
      $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row->nomor);
      $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $row->email);

      $excel_row++;

    }

    $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');

    header('Content-Type: application/vnd.ms-excel');

    header('Content-Disposition: attachment;filename="Employee Data.xls"');

    $berhasil = $object_writer->save('php://output');

  }

}
