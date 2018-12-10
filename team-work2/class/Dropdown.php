<?php

class Dropdown
{
    private $dataSet;
    private $columns;
    private $dropdownname;

    /**
     * DataTable constructor.
     * @param array $dataSet
     * @param AbstractRepository $repository
     */
    public function __construct($dataSet, $dropdownname)
    {
        $this->dataSet = $dataSet;
        $this->dropdownname = $dropdownname;
    }


    public function addColumn($databaseColumnName, $tableHeadTitle)
    {
        $this->columns[$databaseColumnName] = array("table-head-title" => $tableHeadTitle);
    }

    public function render()
    {
        echo "<select name='";
        echo $this->dropdownname;
        echo "'>";
        foreach ($this->dataSet as $row) {
            $iterace=0;
            foreach ($this->columns as $key => $value) {
                $iterace++;
                if($iterace==1){
                    echo "<option value=" ;
                    echo $row[$key].">";
                }
                else{
                    echo $row[$key]." ";
                }
            }
            echo "</option>";
        }
        echo "</select>";
    }
}