<?php
declare(strict_types=1); 

// PHP Learning File: Beginner to OOP
echo "==============================\n";
echo "PHP Learning File: Beginner to OOP\n";
echo "==============================\n\n";

echo "1) Output and Variables\n";
$name = "Lenovo Student";
$age = 21;
$height = 1.72;
$isActive = true;

echo "Name: $name\n";
echo "Age: $age\n";
echo "Height: $height\n";
echo "Active: " . ($isActive ? "true" : "false") . "\n\n";

echo "2) Constants and Type Casting\n";
define("APP_NAME", "PHP University Practice");
echo "App: " . APP_NAME . "\n";

$stringNumber = "100";
$intNumber = (int) $stringNumber;
$sum = $intNumber + 50;
echo "String to int + 50 = $sum\n\n";

echo "3) Math Operators\n";
$a = 15;
$b = 4;
echo "a + b = " . ($a + $b) . "\n"; 
echo "a - b = " . ($a - $b) . "\n";
echo "a * b = " . ($a * $b) . "\n";
echo "a / b = " . ($a / $b) . "\n";
echo "a % b = " . ($a % $b) . "\n\n";

echo "4) Conditionals\n";
$score = 82;

if ($score >= 90) {
	echo "Grade: A\n";
} elseif ($score >= 75) {
	echo "Grade: B\n";
} elseif ($score >= 60) {
	echo "Grade: C\n";
} else {
	echo "Grade: F\n";
}

$day = "Monday";

switch ($day) {
	case "Monday":
		echo "Start of week\n";
		break;
	case "Friday":
		echo "Almost weekend\n";
		break;
	default:
		echo "Regular day\n";
		break;
}

echo "\n";
echo "5) Loops\n";

for ($i = 1; $i <= 5; $i++) {
	echo "for loop count: $i\n";
}

$counter = 1;
while ($counter <= 3) {
	echo "while loop count: $counter\n";
	$counter++;
}

$doCounter = 1;
do {
	echo "do while count: $doCounter\n";
	$doCounter++;
} while ($doCounter <= 2);

echo "\n";
echo "6) Arrays\n";

$colors = ["red", "green", "blue"];
echo "First color: " . $colors[0] . "\n";

// Associative array (dictionary in other languages or objects in JS)
$student = [
	"name" => "Sara",
	"department" => "Computer Science",
	"semester" => 5,
];

echo "Student name: " . $student["name"] . "\n";
echo "Department: " . $student["department"] . "\n";

echo "All colors with foreach:\n";
foreach ($colors as $index => $color) {
	echo "Index $index => $color\n";
}

echo "\n";
echo "7) Functions\n";

function greet(string $person): string
{
	return "Hello, $person!";
}

function multiply(int $x, int $y = 2): int
{
	return $x * $y;
}

echo greet("Ali") . "\n";
echo "5 * default = " . multiply(5) . "\n";
echo "5 * 4 = " . multiply(5, 4) . "\n";

function calculateStats(array $numbers): array
{
	$total = array_sum($numbers);
	$count = count($numbers);
	$average = $count > 0 ? $total / $count : 0;

	return [
		"total" => $total,
		"count" => $count,
		"average" => $average,
	];
}

$stats = calculateStats([10, 20, 30, 40]);
echo "Total: {$stats['total']}, Count: {$stats['count']}, Average: {$stats['average']}\n\n";

echo "8) Scope and Superglobals (basic simulation)\n";
$globalMessage = "I am global";

function showScope(): void
{
	global $globalMessage; 
	echo "Inside function: $globalMessage\n";
}

showScope();
echo "Server software (if available): " . ($_SERVER["SERVER_SOFTWARE"] ?? "CLI Mode") . "\n\n";

echo "9) Exception Handling\n";

function divide(float $num1, float $num2): float
{
	if ($num2 === 0.0) {
		throw new InvalidArgumentException("Division by zero is not allowed.");
	}
	return $num1 / $num2;
}

try {
	echo "10 / 2 = " . divide(10, 2) . "\n";
	echo "10 / 0 = " . divide(10, 0) . "\n";
} catch (InvalidArgumentException $e) {
	echo "Caught exception: " . $e->getMessage() . "\n";
}

echo "\n";
echo "10) OOP Basics: Class and Object\n";

class shape{
	protected $name;

	public function __construct($name){
		$this->name = $name;
	}
	function rotate($degree){
		$angle = 0;
		$newAngle = $angle + $degree;
		return $newAngle % 360;
	}
	function playSound(){
    echo "Playing sound for " . $this->name . "\n";
	}
}

class square extends shape{
		public function __construct($name = "Square"){
			parent::__construct($name);
		}

		// Override the playSound method for square
		public function playSound(){
			echo "Playing sound for specific shape: " . $this->name . "\n";
		}
}

class Amoeba extends shape{
	// we here are using the constructor of the parent class (shape) to initialize the properties of the Amoeba class. 
	protected $name = "Amoeba";
	private $x, $y;
	public function __construct($x, $y){
		$this->x = $x;
		$this->y = $y;
	}
	
	public function rotate($degree){
		$angle = 0;
		$distanceFromOrigin = sqrt($this->x ** 2 + $this->y ** 2);
		$rotateInfluence = $distanceFromOrigin / 10; 
		$randomFactor = rand(0, 10); 
		$newAngle = $angle + $degree + $rotateInfluence + $randomFactor;
		return $newAngle % 360;
	}
}

// overriding is a powerful OOP concept that allows a subclass to provide a specific implementation of a method that is already defined in its parent class. In this example, the square class overrides the playSound method of the shape class to provide a more specific message when playing sound for a square shape. This demonstrates how we can customize behavior in subclasses while still maintaining the structure and functionality of the parent class.
// overloading is a concept where multiple methods can have the same name but different parameters. PHP does not support method overloading in the traditional sense (like in Java or C++), but we can achieve similar functionality using default parameters or by checking the number and type of arguments within a single method. In this example, we have not implemented overloading, but we could modify the playSound method to accept different parameters to simulate overloading behavior if needed.

$circle = new shape("Circle"); 
$square = new square();
$Amoeba = new Amoeba(5, 10);
echo $circle->rotate(90) . "\n"; 
$circle->playSound();

echo $square->rotate(45) . "\n";
$square->playSound();

echo $Amoeba->rotate(180) . "\n";
$Amoeba->playSound();


// interface in short is a contract that defines a set of methods that a class must implement. It allows us to specify what methods a class should have
interface newShape{
	public function rotate($degree): int;
	public function playSound();
}

class Triangle implements newShape{
	public function rotate($degree): int{
		$angle = 0;
		$newAngle = $angle + $degree;
		return $newAngle % 360;
	}
	public function playSound(){
		echo "Playing sound for Triangle\n";
	}
}


// echo "14) Trait and Static Members\n";

// trait Logger
// {
// 	public function logMessage(string $message): void
// 	{
// 		echo "[LOG] $message\n";
// 	}
// }

// class AppConfig
// {
// 	use Logger;

// 	public static string $version = "1.0.0";

// 	public static function appVersion(): string
// 	{
// 		return self::$version;
// 	}
// }

// $config = new AppConfig();
// $config->logMessage("Application started");
// echo "App version: " . AppConfig::appVersion() . "\n\n";

// echo "15) Final Practice: Mini Student Manager\n";

// class StudentManager
// {
// 	private array $students = [];

// 	public function addStudent(string $name, float $gpa): void
// 	{
// 		$this->students[] = ["name" => $name, "gpa" => $gpa];
// 	}

// 	public function listStudents(): void
// 	{
// 		foreach ($this->students as $student) {
// 			echo "Name: {$student['name']}, GPA: {$student['gpa']}\n";
// 		}
// 	}
// }

// $manager = new StudentManager();
// $manager->addStudent("Hassan", 3.2);
// $manager->addStudent("Nour", 3.8);
// $manager->addStudent("Lina", 2.9);
// $manager->listStudents();

// echo "\n";
// echo "==============================\n";
// echo "End of learning file\n";
// echo "==============================\n";