<?php

$input = array(
  "467..114..",
  "...*......",
  "..35..633.",
  "......#...",
  "617*......",
  ".....+.58.",
  "..592.....",
  "......755.",
  "...$.*....",
  ".664.598..",
);


$grid = parseIntoGrid($input);
$grid->calculateStableFields();


function parseIntoGrid(array $input): Grid
{
  $x = 0;
  $points = [];

  foreach ($input as $row) {
    $y = 0;
    $col = str_split($row, 1);
    foreach ($col as $char) {
      $point = new Point($x, $y, $char);
      array_push($points, $point);
      $y++;
    }
    $x++;
  }

  return new Grid($points);
}

class Grid
{
  public array $points;
  public array $stable;
  public array $symbols = [];

  public function __construct(array $points, array $stable = [])
  {
    $this->points = $points;
    $this->stable = $stable;
  }


  public function calculateStableFields(): void
  {
    $symbols = array_filter($this->points, function ($e) {
      if (in_array($e->value, ['*', '+', '$', '#'])) {
        array_push($this->symbols, $e);
        return $e->value;
      }
    });

    foreach ($symbols as $symbol) {
      $this->getNeighbours($symbol);
    }
  }

  private function getNeighbours(Point $point)
  {
    $coordinates = [new Point(1, 0), new Point(1, 1), new Point(0, 1), new Point(-1, 0), new Point(0, -1), new Point(-1, -1), new Point(1, -1), new Point(-1, 1)];
    foreach ($coordinates as $coordinate) {
      $nb = $this->getPoint(...$coordinate->add($point));
      if ($nb && !in_array($nb, $this->stable) && is_numeric($nb->value)) {
        $this->stable[] = $nb;
        $this->getNeighbours($nb);
      }
    }
    return $this->stable;
  }

  private function getPoint(int $x, int $y)
  {
    $filtered = array_filter($this->points, function ($point) use ($x, $y) {
      return $point->x == $x && $point->y == $y;
    });
    return array_pop($filtered);
  }
}

class Point
{
  public int $x;
  public int $y;
  public string $value = "";

  public  function __construct(int $x, int $y, ?String $char = "")
  {
    $this->x = $x;
    $this->y = $y;
    $this->value = $char;
  }

  function add(Point $point)
  {
    $x = $this->x + $point->x;
    $y = $this->y + $point->y;

    return ['x' => $x, 'y' => $y];
  }
}


// Create a 9x9 grid array initialized with zeros
$display = array_fill(0, 10, array_fill(0, 10, 0));

// Fill the grid with the stable data
foreach ($grid->stable as $item) {
  $display[$item->x][$item->y] = $item->value;
}
foreach ($grid->symbols as $item) {
  $display[$item->x][$item->y] = $item->value;
}
// Generate the HTML and CSS for the grid
echo '<style>';
echo '.has-number { background-color: green; }'; // Yellow background for marked cells
echo '.symbol { background-color: yellow; }'; // Red background for fugitive cells
echo '</style>';

echo '<table border="1" cellspacing="0" cellpadding="5">';
// Header row with column numbers

for ($i = 0; $i < 10; $i++) {
  echo '<tr>';
  for ($j = 0; $j < 10; $j++) {
    $cellClass = '';
    if ($display[$i][$j] != 0) {
      $cellClass .= 'has-number ';
    }
    foreach ($grid->symbols as $symbol) {
      if ($symbol->y == $j && $symbol->x == $i) {
        $cellClass .= 'symbol ';
        break;
      }
    }

    echo '<td class="' . trim($cellClass) . '" style="width: 30px; height: 30px; text-align: center;">';
    echo $display[$i][$j];
    echo '</td>';
  }
  echo '</tr>';
}
echo '</table>';
