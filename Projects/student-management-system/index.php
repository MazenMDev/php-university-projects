<?php
require_once __DIR__ . '/classes/Student.php';
require_once __DIR__ . '/classes/StudentManager.php';

$studentManager = new StudentManager();

echo "Welcome to the Student Management System!\n\n";
while(true){
  echo "1. Add Student\n";
  echo "2. Remove Student\n";
  echo "3. Update Student Grade\n";
  echo "4. Display Students\n";
  echo "5. Exit\n";
  echo "Please choose an option: ";
  echo "\n";

  $choice = fgets(STDIN);
  switch(trim($choice)){
    case "1":
      echo "Enter Student name: ";
      $name = trim(fgets(STDIN));
      echo "Enter Student grade: ";
      $grade = (int) trim(fgets(STDIN));
      
      $studentManager->add_student($name, $grade);
      break;
    case "2":
      echo "Enter Student name: ";
      $name = trim(fgets(STDIN));
      $studentManager->remove_student($name);
      break;
    case "3":
      echo "Enter Student name: ";
      $name = trim(fgets(STDIN));
      echo "Enter new grade: ";
      $grade = (int) trim(fgets(STDIN));
      $studentManager->update_grade($name, $grade);
      break;
    case "4":
      $studentManager->display_students();
      break;
    case "5":
      echo "Goodbye!\n";
      exit;
    default:
      echo "Invalid option. Please try again.\n";
      break;
  }
  echo "\n";
}