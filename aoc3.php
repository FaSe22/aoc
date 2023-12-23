<?php


$grid = array(
  "01 02 03 04 05 06 07 08 09 10",
  "11 12 13 14 15 16 17 18 19 20",
  "21 22 23 24 25 26 27 28 29 30",
  "31 32 33 34 35 36 37 38 39 40",
  "41 42 43 44 45 46 47 48 49 50",
  "51 52 53 54 55 56 57 58 59 60",
  "61 62 63 64 67 66 67 68 69 70",
  "71 72 73 74 75 76 77 78 79 80",
  "81 82 83 84 85 86 87 88 89 90",
  "91 92 93 94 95 96 97 98 99 100"
);

$grid = array(
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

$x = 0;
$points = [];

#read into array
foreach ($grid as $row) {
  $y = 0;
  $col = str_split($row, 1);
  foreach ($col as $char) {
    $point = new Point($x, $y, $char);
    array_push($points, $point);
    $y++;
  }
  $x++;
}

# create grid and unset array
$grid = new Grid($points);
$points = null;

# find the symbols in the grid and get the neighbours
$neighbours = [];
foreach ($grid as $el) {
  $symbols = array_filter($el, function ($e) {
    if (in_array($e->value, ['*', '+', '$', '#'])) {
      return $e->value;
    }
  });

  foreach ($symbols as $symbol) {
    array_push($neighbours, $grid->getNeighbours($symbol));
  }

  $numbers = array_filter($el, function ($e) use ($grid) {
    if (is_numeric($e->value) && !in_array($e, $grid->stable)) {
      #echo json_encode($e);
    }
  });
}
echo json_encode($grid->stable);
die;





class Grid
{
  public array $points;
  public array $stable;

  public function __construct(array $points, array $stable = [])
  {
    $this->points = $points;
    $this->stable = $stable;
  }

  public function getPoint(int $x, int $y)
  {
    $filtered = array_filter($this->points, function ($point) use ($x, $y) {
      return $point->x == $x && $point->y == $y;
    });
    return array_pop($filtered);
  }
  public function getNeighbours(Point $point)
  {
    $neighbours = [];
    $coordinates = [new Point(1, 0), new Point(1, 1), new Point(0, 1), new Point(-1, 0), new Point(0, -1), new Point(-1, -1), new Point(1, -1), new Point(-1, 1)];
    foreach ($coordinates as $coordinate) {
      $nb = $this->getPoint(...$coordinate->add($point));
      if ($nb && !in_array($nb, $this->stable) && !in_array($nb, $neighbours) && is_numeric($nb->value)) {
        $neighbours[] = $nb;
        $this->addStable($nb);
        $this->getNeighbours($nb);
      }
    }
    return $this->stable;
  }

  public function addStable($points): void
  {
    $this->stable[] = $points;
  }
}

class Point extends Grid
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
