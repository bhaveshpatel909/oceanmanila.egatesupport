<?php

/**
 * @property CI_Loader           $load
 * @property CI_Form_validation  $form_validation
 * @property CI_Input            $input
 * @property CI_DB_query_builder $db
 * @property CI_Session          $session
 * @property attachments_actions          $attachments_actions
 * @property departments_actions          $departments_actions
 * @property user_actions          $user_actions
 */
class Contract_type extends Base_model {

    public function __construct() {
        parent::__construct();
    }

    public function get_contract_type_list() {
        return $this->db
                        ->select('id, name, content')
                        ->get('contract_type')
                        ->result_array();
    }
    
    function get_contract_type($contract_type_id) {
        $this->db->select('id, name, content');
        $this->db->where('id', $contract_type_id);
        $query = $this->db->get('contract_type');
        return $query->row_array();
    }

    function save_contract_type() {
        $data = array(
            'name' => $this->input->post('contract_type_name'),
            'content' => $this->input->post('content')
        );

        if ($this->input->post('contract_type_id') == '0') {
            $this->db->insert('contract_type', $data);
            return $this->db->insert_id();
        }

        $this->db->update('contract_type', $data, array('id' => $this->input->post('contract_type_id')));
        return TRUE;
    }

    function delete_contract_type($contract_type_id) {
        $this->db->delete('contract_type', array('id' => $contract_type_id));
    }

}
