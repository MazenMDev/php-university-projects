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


//* Function Deep Dive
function newGreet(string $name, string $greeting, string $email, bool $shout): string {
  $message = "$greeting, $name! Your email is $email.";
  return $shout ? strtoupper($message) : $message; 
}
echo newGreet("Alice", "Welcome", "alice@example.com", true) . "\n";
echo newGreet("Bob", "Hi", "bob@example.com", false) . "\n";
// Using named arguments
echo newGreet(email: "charlie@example.com", shout: false, name: "Charlie", greeting: "Hello") . "\n";

// $numbers = [1, 2, 3];
// $squared = array_map(function($num){
//   return $num * $num;
// }, $numbers);
// var_dump($squared);
$squared = array_map(fn($num)=>$num*$num, $numbers);
var_dump($squared);

// pure function example
function add2(int $a, int $b): int{
  return $a + $b;
}
echo add2(5, 3) . "\n";
echo add2(5, 3) . "\n";

// non-pure function example
$total = 0;
function addToTotal(int $num): int{
  global $total;
  $total += $num;
  return $total;
}
echo addToTotal(5) . "\n";
echo addToTotal(5) . "\n";

$users = [
  ['id' => 1, "name" => "Alice", "role" => "admin"],
  ["id" => 2, "name" => "Bob", "role" => "user"],
  ["id" => 3, "name" => "Charlie", "role" => "user"],
];

function createFilter($key, $value) {
  return fn($item) => $item[$key] === $value;
}
$isAdmin = createFilter("role", "admin"); 
$admins = array_filter($users, $isAdmin);
var_dump($admins);

// recursive function example
function factorial(int $n): int{
  if($n <= 1) return 1;
  return $n * factorial($n - 1); 
}
echo factorial(5) . "\n";

// Generator example
function countDown(int $n): Generator{
  for($i = $n; $i >= 0; $i--){
    yield random_int(1, 100);
  }
}
foreach(countDown(5) as $num){
  echo "Generated number: $num\n";
}

//* Strings 
print"Hello, World!\n";
print'Hello, World!\n';
echo "\n";
$heredoc = <<<EOD
This is a heredoc string.
It can span multiple lines and supports variable interpolation.
EOD;
print $heredoc . "\n";

$str = "Hello, World!";
echo $str[0] ."\n";
echo $str[-1] ."\n";
echo substr($str,0,5) ."\n";
echo substr($str,5) ."\n";
echo strtolower($str[0]) ."\n";
$greeting = "Hello, " . "World!";
$greeting .= " Welcome to PHP.";
echo $greeting . "\n";

$hayStack = "The quick brown fox";
$pos = strpos($hayStack, "brown");
var_dump($pos);
var_dump(str_replace("quick","lazy", $hayStack)); 

preg_match_all('/\w{5}/', $hayStack, $m); // matches all 5-letter words
var_dump($m);

$name = 'Alice';
$age = 19;

printf('%s is %d years old.', $name, $age); 

$csv = "apple, banana, cherry";
$fruites = explode(", ", $csv); // converts string to array
var_dump($fruites);
$fruites = implode(", ", $fruites); // converts array back to string
var_dump($fruites);

$padded = str_pad("Hello", 9, "*", STR_PAD_BOTH); // pads string to length 9 with * on both sides
echo $padded . "\n";

$url = "https://example.com/search?q=php programming&sort=asc";
var_dump(urlencode($url)); // encodes special characters in URL
var_dump(urldecode(urlencode($url))); // decodes back to original URL

$html = "<div>Hello, World!</div>";
var_dump(htmlentities($html));

$encoded = base64_encode("Hello, World!");
echo $encoded . "\n";
var_dump(base64_decode($encoded)); 

$numbers = 12345678.5983443;
echo number_format($numbers, 2, ".", ",");

$simpleArray = [1, 2, 3];
$associativeArray = [
"name" => "Alice", 
"age" => 30, 
"city" => "New York"
];

$simpleArray[] = 4; // adds 4 to the end of the array
$associativeArray["country"] = "USA"; // adds new key-value pair to the associative array
var_dump($simpleArray);
var_dump($associativeArray);

$matrix = [
  [1, 2, 3],
  [4, 5, 6],
  [7, 8, 9]
];
echo $matrix[1][2] . "\n"; // outputs 6

$fruites = ["apple", "cherry", "banana"];
var_dump(count($fruites)); // outputs 3
sort($fruites); 
var_dump($fruites);
rsort($fruites);
var_dump($fruites);

var_dump($associativeArray);
asort($associativeArray); // sorts by value
var_dump($associativeArray);
ksort($associativeArray);
var_dump($associativeArray); // sort by key

$numbers = range(1,3);
var_dump($numbers); 
$sqaured = array_map(fn($n) => $n * $n, $numbers);
var_dump($sqaured);

$eventNumbers = [1, 2, 3, 4, 5];
$evenNumbers = array_filter($eventNumbers, fn($n) => $n % 2 === 0);
var_dump($evenNumbers);

$sum = array_reduce($numbers, fn($carry, $n) => $carry + $n, 0);
var_dump($sum);
$moreNumbers = [0, ...$numbers, 4];
var_dump($moreNumbers);

[$first, $second, $third] = $fruites;
var_dump($first, $second, $third);  


print(str_repeat("*", 50) . "\n");
$set1 = [1, 2, 3, 4];
$set2 = [3, 4, 5, 6];
var_dump(
  array_intersect($set1, $set2),
  array_diff($set1, $set2),
  array_merge($set1, $set2)
);

$keys = array_map(fn($key)=>ucfirst($key), array_keys($associativeArray));
$values = array_values($associativeArray);
var_dump($keys, $values);

var_dump(
  array_key_exists("name", $associativeArray),
  in_array('John', $associativeArray)
);

var_dump(
  array_merge($set1, $set2),
  array_merge($associativeArray, ["country" => "DE"]),
  $set1 + $set2, // union of arrays (only unique keys from the first array)
  $associativeArray + ["country" => "DE"], // union of associative arrays (only unique keys from the first array)
  [...$set1, ...$set2], // spread operator to merge arrays
  [...$associativeArray, "country" => "DE"] // spread operator to merge associative arrays
);

var_dump(
  array_unique(array_merge($set1, $set2)),
  array_slice($set1, 0, 2)
);

var_dump(
  array_search("banana", $fruites)
);