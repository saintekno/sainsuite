<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * SainSuite
 *
 * Engine Management System
 *
 * @package     SainSuite
 * @copyright   Copyright (c) 2019-2020 Buddy Winangun, Eracik.
 * @copyright   Copyright (c) 2020-2021 SainTekno, SainSuite.
 * @link        https://github.com/saintekno/sainsuite
 * @filesource
 */
class Formula_model extends MY_Model
{
    protected $table_name = 'formula';
    protected $set_created = false;
    protected $set_modified = false;

    public function __construct()
    {
        parent::__construct();
    }

    public function get_formula($komposisi_id = false)
    {
        $output = [];
        $slider = [];
        $formula = '';
        foreach (explode(',',$komposisi_id) as $index) 
        {
            $this->db->where('id', $index);
            $query = $this->db->get($this->table_name);
            $row = $query->row();
    
            if ($query->num_rows() > 0) {
                $formula .= '
                <div class="separator separator-dashed my-5"></div>
                <div class="form-group row">
                    <div class="col-12">
                        <label class="font-size-lg font-weight-bold">'.$row->name.'</label> : 
                        <span id="price_text_'.$row->id.'"></span> 
                        - '.$row->target.'
                    </div>
                    <div class="col-12">
                        <input type="hidden" id="price_value_'.$row->id.'" value=""/>
                        <div id="kt_nouislider_'.$row->id.'" class="nouislider nouislider-handle-primary"></div>
                    </div>
                </div>';

                $slider[$row->id] = $row->target;
            }
        }
        $output['formula'] = $formula;
        $output['slider'] = $slider;

        return $output;
    }

    public function get_formula_statistik()
    {
        $this->select('*, 
            kategori.definition as kategori_definition, 
            formula.definition as formula_definition,
            formula.name as formula_name'
        );
        $this->join( 'formula_statistik', 'formula.id = formula_statistik.formula_id');
        $this->join( 'kategori', 'kategori.id = formula_statistik.kategori_id');
        return parent::find_all();
    }
}
