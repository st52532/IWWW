<?php

class CarItem
{
    private $dataSet;

    /**
     * DataTable constructor.
     * @param array $dataSet
     * @param AbstractRepository $repository
     */
    public function __construct($dataSet)
    {
        $this->dataSet = $dataSet;
    }

    public function render()
    {
        echo "Počet automobilů: " . sizeof($this->dataSet);
        foreach ($this->dataSet as $row) {
            echo "<article>";
            echo "<h2><a href='?page=car-detail&id=" . $row["id"] . "'>" . $row["brandname"] . " " . $row["modelname"] . "</a></h2>";
            echo "<div class='wrap1'>";
            echo "<img src='photos/" . $row["folder"] . "/" . $row["image"] . "' alt='Fotografie nenalezena'>";
            echo "<dl>";
            echo "<dt>Tachometr</dt><dd>" . $row["mileage"] . " km</dd>";
            echo "<dt>Rok výroby</dt><dd>" . $row["year"] . "</dd>";
            echo "<dt>Převodovka</dt><dd>" . $row["gearbox"] . "</dd>";
            echo "<dt>Výkon</dt><dd>" . $row["power"] . " kw</dd>";
            echo "<dt>Palivo</dt><dd>" . $row["fuel"] . "</dd>";
            echo "<dt>Barva</dt><dd>" . $row["color"] . "</dd>";
            $date1 = explode(" ", $row["date"]);
            $date2 = explode("-", $date1[0]);
            echo "<dt>Datum vložení</dt><dd>" . $date2[2] . "." . $date2[1] . "." . $date2[0] . "</dd>";
            echo "<dt>Cena</dt><dd><b>" . $row["price"] . " Kč</b></dd>";
            echo "</dl>";
            echo "</div>";
            echo "</article>";
        }
    }
}