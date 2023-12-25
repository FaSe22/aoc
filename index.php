<?php

// Provided data
$data = [
  'stable' => [
    ["x" => 2, "y" => 3, "value" => "5"],
    ["x" => 2, "y" => 2, "value" => "3"],
    ["x" => 0, "y" => 2, "value" => "7"],
    ["x" => 0, "y" => 1, "value" => "6"],
    ["x" => 0, "y" => 0, "value" => "4"],
    ["x" => 2, "y" => 6, "value" => "6"],
    ["x" => 2, "y" => 7, "value" => "3"],
    ["x" => 2, "y" => 8, "value" => "3"],
    ["x" => 4, "y" => 2, "value" => "7"],
    ["x" => 4, "y" => 1, "value" => "1"],
    ["x" => 4, "y" => 0, "value" => "6"],
    ["x" => 6, "y" => 4, "value" => "2"],
    ["x" => 6, "y" => 3, "value" => "9"],
    ["x" => 6, "y" => 2, "value" => "5"],
    ["x" => 9, "y" => 3, "value" => "4"],
    ["x" => 9, "y" => 2, "value" => "6"],
    ["x" => 9, "y" => 1, "value" => "6"],
    ["x" => 9, "y" => 5, "value" => "5"],
    ["x" => 9, "y" => 6, "value" => "9"],
    ["x" => 9, "y" => 7, "value" => "8"],
    ["x" => 7, "y" => 6, "value" => "7"],
    ["x" => 7, "y" => 7, "value" => "5"],
    ["x" => 7, "y" => 8, "value" => "5"]
  ],
  'fugitive' => [
    ["x" => 0, "y" => 5, "value" => "1"],
    ["x" => 0, "y" => 6, "value" => "1"],
    ["x" => 0, "y" => 7, "value" => "4"],
    ["x" => 5, "y" => 7, "value" => "5"],
    ["x" => 5, "y" => 8, "value" => "8"]
  ],
  'symbols' => [
    ["x" => 1, "y" => 3, "value" => "*"],
    ["x" => 3, "y" => 6, "value" => "#"],
    ["x" => 4, "y" => 3, "value" => "*"],
    ["x" => 5, "y" => 5, "value" => "+"],
    ["x" => 8, "y" => 3, "value" => "$"],
    ["x" => 8, "y" => 5, "value" => "*"]
  ]
];

// Create a 9x9 grid array initialized with zeros
$grid = array_fill(0, 10, array_fill(0, 10, 0));

// Fill the grid with the stable data
foreach ($data["stable"] as $item) {
  $grid[$item['x']][$item['y']] = $item['value'];
}
foreach ($data["fugitive"] as $item) {
  $grid[$item['x']][$item['y']] = $item['value'];
}
foreach ($data["symbols"] as $item) {
  $grid[$item['x']][$item['y']] = $item['value'];
}
// Generate the HTML and CSS for the grid
echo '<style>';
echo '.has-number { background-color: green; }'; // Yellow background for marked cells
echo '.fugitive { background-color: #FF0000; }'; // Red background for fugitive cells
echo '.symbol { background-color: yellow; }'; // Red background for fugitive cells
echo '</style>';

echo '<table border="1" cellspacing="0" cellpadding="5">';
// Header row with column numbers

for ($i = 0; $i < 10; $i++) {
  echo '<tr>';
  for ($j = 0; $j < 10; $j++) {
    $cellClass = '';
    if ($grid[$i][$j] != 0) {
      $cellClass .= 'has-number ';
    }
    // Check if the cell is a fugitive cell
    foreach ($data["fugitive"] as $fugitiveCell) {
      if ($fugitiveCell['y'] == $j && $fugitiveCell['x'] == $i) {
        $cellClass .= 'fugitive ';
        break;
      }
    }
    foreach ($data["symbols"] as $symbol) {
      if ($symbol['y'] == $j && $symbol['x'] == $i) {
        $cellClass .= 'symbol ';
        break;
      }
    }

    echo '<td class="' . trim($cellClass) . '" style="width: 30px; height: 30px; text-align: center;">';
    echo $grid[$i][$j];
    echo '</td>';
  }
  echo '</tr>';
}
echo '</table>';
