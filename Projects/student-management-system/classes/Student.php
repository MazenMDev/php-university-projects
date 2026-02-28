<?php
  class Student{
    private string $name;
    private int $grade;
    public function __construct(string $name, int $grade){
      $this->name = $name;
      $this->grade = $grade;
    }

    public function getName(): string{
      return $this->name;
    }

    public function getGrade(): int{
      return $this->grade;
    }

    public function setGrade(int $grade): void{
      if($grade < 0 || $grade > 100){
        $grade = -1;
      }
      $this->grade = $grade;
    }
  }

