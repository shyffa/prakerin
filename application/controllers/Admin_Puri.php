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
    $data['loker_baru'] = $this->lowongan_m->getLowonganPekerjaan();
    $this->load->view('admin/lowongan',$data);
  }

  public function dummy_lowongan(){
    $data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
    $data['loker_baru'] = $this->lowongan_m->getLowonganPekerjaan();
    $this->load->view('admin/dummy_lowongan',$data);
  }


  public function tambahLowongan(){

    $posisi = $this->input->post('posisi');
    $penempatan = $this->input->post('penempatan');
    $syarat = $this->input->post('syarat');
    $batas = $this->input->post('batas');
    $upload_image = $_FILES['gambar']['name'];

    if ($upload_image) {
      // code...
      $config['allowed_types'] = 'gif|jpg|png';
      $config['max_sizes'] = '5048';
      $config['upload_path'] = './assets/img/loker/';

      $this->load->library('upload',$config);

      if ($this->upload->do_upload('gambar')) {

        $old_image = $data['loker_baru']['gambar'];
        if ($old_image != 'default.jpg') {
          // code...
          unlink(FCPATH . 'assets/img/loker/' . $old_image);
        }

        $new_img = $this->upload->data('file_name');
        $this->db->set('gambar', $new_img);
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
        redirect('Admin_Puri/lowongan');
      }

    }
    $data = [
      'posisi' => $posisi,
      'penempatan' => $penempatan,
      'syarat' => $syarat,
      'batas' => $batas,
      'gambar' => $upload_image,
      'role_id' => 1
    ];

    $this->db->insert('loker_baru',$data);

    $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
     Input Loker Berhasil
    </div>');
    redirect('Admin_Puri/lowongan');
  }

public function editLoker(){

}

public function hapusLoker($id_loker){
  $this->lowongan_m->hapusLoker($id_loker);
  $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
   Loker Berhasil Dihapus
  </div>');
  redirect('Admin_Puri/lowongan');
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

  public function viewData($id_pelamar){
    $this->load->model("Excel_export_model");
    $this->Excel_export_model->viewDataM($id_pelamar);
    $this->load->view('admin/viewDataV',$data);
  }

  public function delAllPendaftar(){
    $this->load->model("Excel_export_model");
    $this->Excel_export_model->delAll();
    redirect($_SERVER['HTTP_REFERER']);
  }

  public function Excel_Export()
  {
    $this->load->model("excel_export_model");

    $data["employee_data"] = $this->excel_export_model->fetch_data();
    $data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
    $this->load->view("admin/pelamar", $data);
  }

  public function action(){

    $this->load->model("excel_export_model");

    $this->load->library("excel");

    $object = new PHPExcel();

    $object->setActiveSheetIndex(0);

    $table_columns = array("posisi", "nama", "tgl_lahir", "tmpt_lahir", "gender", "status", "agama", "alamat", "nomor", "email", "pendidikan");

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
      $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $row->pendidikan);


      $excel_row++;

    }

    $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');

    header('Content-Type: application/vnd.ms-excel');

    header('Content-Disposition: attachment;filename="Employee Data.xls"');

    $berhasil = $object_writer->save('php://output');

  }
}
