<?php

class JsonSpecEquipment
{
    private $dataSet;
    private $columns;
    private $dropdownname;

    public function __construct($dataSet, $dropdownname)
    {
        $this->dataSet = $dataSet;
        $this->dropdownname = $dropdownname;
    }


    public function addColumn($databaseColumnName, $tableHeadTitle)
    {
        $this->columns[$databaseColumnName] = array("table-head-title" => $tableHeadTitle);
    }

    public function get()
    {
        $komplet = array();

        foreach ($this->dataSet as $row) {

            $arr = array('idspecific_equipment' => $row["idspecific_equipment"], 'name' => $row["name"]);
            array_push($komplet,$arr);
        }
        return json_encode($komplet);
    }
}