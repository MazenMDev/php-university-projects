<?php
require_once __DIR__ . '/Student.php';
class StudentManager{
  private $students = [];


  public function add_student(string $name, int $grade): void{
    $this->students[$name] = new Student($name, $grade);
  }

  public function update_grade(string $name, int $grade ): void{
    if(!isset($this->students[$name])){
      echo "---Student with name $name does not exist.---\n";
      return;
    }
    $this->students[$name]->setGrade($grade);
  }

  public function remove_student(string $name ): void{
    if(!isset($this->students[$name])){
      echo "---Student with name $name does not exist.---\n";
      return;
    }
    unset($this->students[$name]);
  }

  public function display_students(): void{
    if(!empty($this->students)){
      foreach($this->students as $student){
        echo "Name: " . $student->getName() . ", Grade: " . $student->getGrade() . "\n";
      }
    } else echo "No students to display.\n";
  }
}
