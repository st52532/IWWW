<?php

class DataTable
{
    private $dataSet;
    private $columns;

    /**
     * DataTable constructor.
     * @param array $dataSet
     */
    public function __construct($dataSet)
    {
        $this->dataSet = $dataSet;
    }

    public function addColumn($databaseColumnName, $tableHeadTitle)
    {
        $this->columns[$databaseColumnName] = array("table-head-title" => $tableHeadTitle);
    }

    public function render()
    {
        echo "<table border='1px'>";
        echo "<thead>";
        echo "<tr>";
        foreach ($this->columns as $key => $value) {
            echo "<th>" . $value["table-head-title"] . "</th>";
        }
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach ($this->dataSet as $row) {
            echo "<tr>";
            foreach ($this->columns as $key => $value) {
                echo "<td>" . $row[$key] . "</td>";
            }
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "Počet záznamů: " . sizeof($this->dataSet);
    }
}