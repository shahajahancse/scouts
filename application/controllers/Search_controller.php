<?php
class Search_controller extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}

    function ajax_get_designation_by_service($id){
        $data[''] = '--- Select Designation ---';
        $this->db->select('id, designation_name');
        $this->db->from('designation');
        $this->db->where('short_order', $id);
        $query = $this->db->get();

        foreach ($query->result_array() AS $rows) {
            $data[$rows['id']] = $rows['designation_name'];
        }
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($data));
    }

    function ajax_get_district_by_div($id){
        $field= $this->session->userdata('site_lang')=='bangla'?'district_name_bn':'district_name';
        $data['0'] = $this->session->userdata('site_lang')=='bangla'?'জেলা নির্বাচন করুন':'Select District';
        $this->db->select("id, $field");
        $this->db->from('district');
        $this->db->where('div_id', $id);
        $this->db->where('status',1);
        $this->db->order_by('district_name', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() AS $rows) {
            $data[$rows['id']] = $rows["$field"];
        }
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($data));
    }
    function ajax_get_upa_tha_by_dis($id){
        $field= $this->session->userdata('site_lang')=='bangla'?'up_th_name_bn':'up_th_name';
        $data['0'] = $this->session->userdata('site_lang')=='bangla'?'উপজেলা / থানা নির্বাচন করুন':'Select Upazila / Thana';
        $this->db->select("id, up_th_name_bn, up_th_name");
        $this->db->from('upazila_thana');
        $this->db->where('dis_id',$id);
        $this->db->where('status',1);
        $this->db->order_by('up_th_name', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() AS $rows) {
            $data[$rows['id']] = $rows["$field"] != '' ? $rows["$field"]:$rows["up_th_name"];
        }
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($data));
    }

    function ajax_get_scout_unit_by_scout_group($id=NULL, $sele=NULL){
        $this->db->select('id, unit_name');
        $this->db->from('office_unit');
        $this->db->where('unit_sc_grp_id', $id);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();

        if(sizeof($query->result()) > 0 ){
            $str = '<h5 style="text-align: center; margin-bottom: 10px; font-weight: bold;"> Choose your scout unit </h5>
            <table class="table table-hover table-striped" border="1"> ';
            foreach ($query->result() as $row) {
                $selected = '';
                if($sele == $row->id){
                    $selected = 'checked';
                }
                $str .= '<tr>
                    <td>
                    <label>
                        <input type="radio" name="sc_unit_id" value="'.$row->id.'" style="float: left; margin-top: 1px;" '.$selected.'><h6 style="margin:0px 0 0 10px; float: left;"> <b>'.$row->unit_name.'</b> </h6>
                    </label>
                </td>
                </tr>';
            }
            $str .= '</table>';
        }else{
            $str = '<h5 style="text-align: center; margin-bottom: 10px; font-weight: bold;">Data is not available.</5>';
        }
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($str));
    }
    function ajax_get_scout_section(){
        $data = array('1' => 'Cub Scout', '2'=> 'Scout', '3'=>'Rover Scout', '4'=>'Not Applicable');
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($data));
    }
    function ajax_get_scout_badge_by_section($memberID, $sectionID){
        $data['0'] = '--- Select Badge ---';
        $this->db->select('sb.id, bt.badge_type_name_bn');
        $this->db->from('scout_badge sb');
        $this->db->join('badge_type bt','bt.id=sb.badge_type_id', 'LEFT');
        $this->db->where('sb.member_id', $memberID);
        $this->db->where('sb.section_id', $sectionID);
        $this->db->where('sb.status', 1);
        // $this->db->order_by('badge_name_bn', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() AS $rows) {
            $data[$rows['id']] = $rows['badge_type_name_bn'];
        }
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($data));
    }

    function ajax_get_scout_role_by_section($memberID, $sectionID){
        $data['0'] = '-- Select Role --';
        $this->db->select('sr.id, rt.role_type_name_bn');
        $this->db->from('scout_role sr');
        $this->db->join('role_type rt', 'rt.id=sr.role_type_id', 'LEFT');
        $this->db->where('sr.member_id', $memberID);
        $this->db->where('sr.section_id', $sectionID);
        $this->db->where('sr.status', 1);
        $query = $this->db->get();

        foreach ($query->result_array() AS $rows) {
            $data[$rows['id']] = $rows['role_type_name_bn'];
        }
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($data));
    }

    function ajax_get_scout_dis_by_region($id){
        $lan_dis_name=$this->session->userdata('site_lang')=='bangla'?'dis_name':'dis_name_en';
        $data['0'] = 'select district';
        $this->db->select("id, $lan_dis_name");
        $this->db->from('office_district');
        $this->db->where('dis_scout_region_id', $id);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() AS $rows) {
            $data[$rows['id']] = $rows[$lan_dis_name];
        }
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($data));
    }
    function ajax_get_scout_upazila_thana_by_district($id){
        $lan_upa_name=$this->session->userdata('site_lang')=='bangla'?'upa_name':'upa_name_en';
        $data['0'] = 'select upazila';
        $this->db->select("id, $lan_upa_name");
        $this->db->from('office_upazila');
        $this->db->where('upa_scout_dis_id', $id);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();

        foreach ($query->result_array() AS $rows) {
            $data[$rows['id']] = $rows[$lan_upa_name];
        }
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($data));
    }

    public function sc_group_select2_search(){
        $json = [];
        if(!empty($this->input->get("q"))){
            $this->db->or_like('grp_name', $this->input->get("q"), 'after');
            $this->db->or_like('grp_name_bn', $this->input->get("q"), 'after');
            $query = $this->db->select('id, CONCAT(grp_name, " (", grp_name_bn, ")") AS text')
                        ->limit(30)
                        ->get("office_groups");
            $json = $query->result();
        }
        echo json_encode($json);
    }

}


