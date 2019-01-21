<?php

class DataTableSale
{
    private $dataSet;
    private $columns;
    private $page;

    /**
     * DataTable constructor.
     * @param array $dataSet
     * @param AbstractRepository $repository
     */
    public function __construct($dataSet, $page)
    {
        $this->dataSet = $dataSet;
        $this->page = $page;
    }

    public function addColumn($databaseColumnName, $tableHeadTitle)
    {
        $this->columns[$databaseColumnName] = array("table-head-title" => $tableHeadTitle);
    }

    public function render()
    {
        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        foreach ($this->columns as $key => $value) {
            echo "<th>" . $value["table-head-title"] . "</th>";
        }

        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach ($this->dataSet as $row) {
            $iterace = 0;
            $id = 0;
            echo "<tr>";
            foreach ($this->columns as $key => $value) {
                $iterace++;
                if ($iterace == 1) {
                    $id = $row[$key];
                }
                echo "<td>" . $row[$key] . "</td>";
            }

            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "Počet záznamů: " . sizeof($this->dataSet);
    }
}