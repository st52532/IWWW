<?php

class JsonEquipment
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

            $arr = array('idequipment' => $row["idequipment"], 'value' => $row["value"]);
            array_push($komplet,$arr);
        }
        return json_encode($komplet);
    }
}