<?php
header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename="soubor.txt"');

$myJSON = '[
  {
      "idbrand": "3",
    "namebrand": "Aixam",
    "idmodel": "4",
    "namemodel": "500"
  },
  {
      "idbrand": "5",
    "namebrand": "BMW",
    "idmodel": "7",
    "namemodel": "E60 550i"
  },
  {
      "idbrand": "7",
    "namebrand": "Ferrari",
    "idmodel": "10",
    "namemodel": "Testarossa"
  },
  {
      "idbrand": "4",
    "namebrand": "Lada",
    "idmodel": "5",
    "namemodel": "2101"
  },
  {
      "idbrand": "6",
    "namebrand": "Mercedes-Benz",
    "idmodel": "9",
    "namemodel": "AMG GT 2015"
  },
  {
      "idbrand": "8",
    "namebrand": "Porsche",
    "idmodel": "11",
    "namemodel": "Panamera"
  },
  {
      "idbrand": "1",
    "namebrand": "\u0160koda",
    "idmodel": "2",
    "namemodel": "Fabia"
  },
  {
      "idbrand": "1",
    "namebrand": "\u0160koda",
    "idmodel": "3",
    "namemodel": "Felicia"
  },
  {
      "idbrand": "1",
    "namebrand": "\u0160koda",
    "idmodel": "1",
    "namemodel": "Octavia"
  },
  {
      "idbrand": "1",
    "namebrand": "\u0160koda",
    "idmodel": "6",
    "namemodel": "Roomster"
  },
  {
      "idbrand": "1",
    "namebrand": "\u0160koda",
    "idmodel": "8",
    "namemodel": "Superb"
  }
]';

echo $myJSON;
exit();
?>