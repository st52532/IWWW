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
            echo "<h2><a href='#'>".$row["brandname"]." ".$row["modelname"]."</a></h2>";
            echo "<p>Tachometr: ".$row["mileage"]." km</p>";
            echo "<p>Rok výroby: ".$row["year"]."</p>";
            echo "<p>Převodovka: ".$row["gearbox"]."</p>";
            echo "<p>Výkon: ".$row["power"]." kw</p>";
            echo "<p>Palivo: ".$row["fuel"]."</p>";
            echo "<p>Barva: ".$row["color"]."</p>";
            echo "<h3>Cena: ".$row["price"]." Kč</h3>";
            echo "</article>";
        }
    }
}