<?php

    public function search_datatable()
    {
        $this->load->library('Datatables',null,'datatables');
        $this->datatables->setDatabase('default');

        $aTable = 'r1_manage_media_files';
        $aColumns = array('id','name','file_size','file_type','create_at','create_by','folder_id');

        $folderId = $this->input->post('folder_id');
        $whereMore = [
            'folder_id' => $folderId
        ];
        $json = $this->datatables->get_json($aTable, $aColumns, $whereMore);
        return $this->output->set_output($json);

    }