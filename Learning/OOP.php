<?php

class Person{
  // public string $name;
  // public int $age;

  public function __construct(public string $name, public int $age){
    // $this->name = $name;
    // $this->age = $age;
  }
  public function introduce(): string{
    return "Hello, my name is $this->name and I am $this->age years old.";
  }
}

$person = new Person("mazen", 30);
echo $person->introduce() ."\n";

class Employee extends Person{
  public function __construct(public string $name, public int $age, public string $position){
    // parent::__construct($this->name, $this->age);
  }

  public function introduce(): string{
    return parent::introduce() . " I work as a $this->position.";
  }
}

$person = new Employee("mahmoud",30, "Software Engineer");
echo $person->introduce() ."\n";

$people = [
  new Employee("Bob",25,"Data Analyst"),
  new Person("John",18)
];

function introduce_people(Person $person){
  echo $person->introduce() . "\n";
}

foreach($people as $person){
  introduce_people($person);
}

class BankAccount{
  private float $balance = 0;

  public function getBalance(): float{
    return $this->balance;
  }

  public function deposit(float $amount): void{
    if($amount > 0){
      $this->balance += $amount;
    }
  }

  public function withdraw(int $amount): void{
    if($amount > 0 && $amount <= $this->balance){
      $this->balance -= $amount;
    }
  }
}

$account = new BankAccount();
echo $account->getBalance() . "\n";
$account->deposit(300);
$account->deposit(450);
echo $account->getBalance() . "\n";
$account->withdraw(200);
echo $account->getBalance() . "\n";

class MathUtils{
  public static float $pi = 3.14;
  public static function square(float $number): float{
    return $number * $number;
  }
}
var_dump(
  MathUtils::$pi,
  MathUtils::square(5)
);

class Connection{
  private static $instance = null;
  private function __construct(){}
  public static function singleton(){
    if(null === static::$instance){
      static::$instance = new static();
    }
    return static::$instance;
  }
}
$connection = Connection::singleton();

interface PaymentProcessor{
  public function processPayment(float $amount): bool;
  public function refundPayment(float $amount): bool;
}

class StripeProcessor implements PaymentProcessor{
  public function processPayment(float $amount): bool{
    echo "Processing payment of $amount using Stripe\n";
    return true;
  }
  public function refundPayment(float $amount): bool{
    echo "Refunding payment of $amount using Stripe\n";
    return true;
  }
}

