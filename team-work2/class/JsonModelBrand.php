<?php

class JsonModelBrand
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

            $arr = array('idbrand' => $row["idbrand"], 'namebrand' => $row["namebrand"], 'idmodel' => $row["idmodel"], 'namemodel' => $row["namemodel"]);
            array_push($komplet,$arr);
        }
        return json_encode($komplet);
    }
}