<?php

class DataTables
{

    protected $CI;
    private $database;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function setDatabase($database)
    {
        $this->database = $database;
    }

    public function getDatabase()
    {
        return $this->database;
    }

    public function get_json($aTable = NULL, $aColumns = NULL, $whereMore = [])
    {
        // Load CI Database library
        $this->CI->load->database($this->database);

        // Read dataTables POST variables
        $iDraw = $this->CI->input->post('draw');
        $iColumns = $this->CI->input->post('columns');
        $iOrder = $this->CI->input->post('order');
        $iStart = $this->CI->input->post('start');
        $iLength = $this->CI->input->post('length');
        $iSearch = $this->CI->input->post('search');


        $recordsTotal = $this->countAllWhere($aTable, $whereMore);

        $recordsFiltered = $recordsTotal;

        if (isset($iSearch) && $iSearch['value'] != '') {
            $this->CI->db->where($whereMore);

            $listWhereOr = [];
            for ($i = 0; $i < count($aColumns); $i++) {
                if ($aColumns[$i] == $iColumns[$i]['data'] && $iColumns[$i]['searchable'] == 'true') {
                    $listWhereOr[] = '`'.$aColumns[$i] .'` Like "%' .$iSearch['value'].'%"';
                }
            }
            $listWhereOr = implode(' OR ',$listWhereOr);
            $listWhereOr ='('.$listWhereOr.')';

            $this->CI->db->where($listWhereOr, null, false);
            $recordsFiltered = $this->CI->db->count_all_results($aTable, false);
        }

        $this->CI->db->where($whereMore);

        if (isset($iSearch) && $iSearch['value'] != '') {
            $this->CI->db->where($listWhereOr, null, false);
        }

        $this->CI->db->select(implode(',', $aColumns));

        // Ordering
        if (isset($iOrder[0])) {
            for ($i = 0; $i < count($iOrder); $i++) {
                $this->CI->db->order_by($aColumns[$iOrder[0]['column']], strtoupper($iOrder[0]['dir']));
            }
        } else {
            $this->CI->db->order_by($aColumns[0], 'ASC');
        }

        // Paging
        if (isset($iStart) && $iLength != '-1') {
            $this->CI->db->limit($iLength, $iStart);
        } else {
            $this->CI->db->limit(25, 1);
        }

        $queryResult = $this->CI->db->get($aTable);

        // JSON enconding
        $json = json_encode(
            array(
                "draw" => isset($iDraw) ? $iDraw : 1,
                "recordsTotal" => $recordsTotal,
                "recordsFiltered" => $recordsFiltered,
                "data" => $queryResult->result(),
            )
        );
        return $json;
    }

    public function countAllWhere($aTable = '', $where = [])
    {
        $this->CI->db->select('COUNT(*) AS `numrows`');
        $this->CI->db->where($where);
        $query = $this->CI->db->get($aTable);
        return $query->row()->numrows;
    }
}
