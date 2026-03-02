<?php
declare(strict_types= 1);
function add(int $a, int $b): int{
  return $a + $b;
}
var_dump(add(5, 3));

//* Variadic function example
function introduceTeam($teamName, ...$members): void{
  echo "Team: $teamName\n";
  var_dump($members);
  echo "Members: " . implode(", ", $members) . "\n";
}
introduceTeam("Alpha", "Alice", "Bob", "Charlie");

//* Anonymous function example
$greet = function ($name) {
  return "Hello, $name!";
};
echo $greet("mazen");
echo "\n";

$numbers = [1, 2, 3];
$squared = array_map(function($num){
  return $num * $num;
}, $numbers);
var_dump($squared);

$message = "bye";
// Using 'use' to capture variable from parent scope in a closure (copy of the variable is made, so changes to $message after this won't affect the closure)
$greet2 = function ($name) use ($message) {
  return "$message, $name!";
};
echo $greet2("mazen");
echo "\n";

//* Refrences
$person = 'John';
$client = &$person;
$client = 'Doe';
echo $person . "\n"; 
echo $client . "\n";

$largeArray = range(1, 1000000);
$startTime = microtime(true); // Simulate some processing on the array
$startMemory = memory_get_usage();

$out = [];
foreach ($largeArray as $num) {
  $out[] = $num * 2;
}

$endTime = microtime(true);
$endMemory = memory_get_usage();
echo $endTime - $startTime," seconds\n"; 
echo round(($endMemory - $startMemory) / 1024 / 1024), " MB\n";

function countVisitors() {
  static $visitorCount = 0; 
  $visitorCount++;
  echo "Visitors count is $visitorCount\n";
}
countVisitors();
countVisitors();
countVisitors();

// function getDb(){
//   static $db;
//   if ($db === null) {
//     $db = new mysqli("","","","");
//   }
//   return $db;
// }

$abc = null;
$db = $abc ?? "default";
var_dump(
  null == null,
  null == false,
  null == 0,
  null == '',
  null == [],
  $db,
  isset($db),
  is_null($abc)
);

function greet(?string $name) {
  echo 'Hello, '. ($name ?? "Guest") ."!\n";
}
greet('Alice');
greet(null);

var_dump(
  array_filter([1, 0, null, "", false, true, 3])
);

function proccessInput(int|float|string $input){
  return match(true){
    is_int($input) => "Input is an integer: $input",
    is_float($input) => "Input is a float: $input",
    is_string($input) => "Input is a string: " . strtoupper($input),
    default => "Unknown type"
  };
}
echo proccessInput(42) . "\n";
echo proccessInput(3.14) . "\n";
echo proccessInput("hello") . "\n";