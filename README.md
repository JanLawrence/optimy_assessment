# PHP test

## 1. Installation

  - create an empty database named "phptest" on your MySQL server
  - import the dbdump.sql in the "phptest" database
  - put your MySQL server credentials in the constructor of DB class
  - you can test the demo script in your shell: "php index.php"

## 2. Expectations

This simple application works, but with very old-style monolithic codebase, so do anything you want with it, to make it:

  - easier to work with
  - more maintainable





# Notes from me (Jan Lawrence Tolentino)

## Table Classes (class/Comment.php, class/News.php)

- You can see that I have extended the class/Comment.php and class/News.php in DB class.

- I also renamed the class folder to models for easy naming in namespace.

- The models/table.php will serve as our model-like functions. These classes will serve as our connection to tables in our database. So every newly added table we can create another class for the new table, to access the DB ORM. You can also add your custom methods in case of manipulating data. 

  - e.g.
  You can use the belongsTo() and hasChildren() when you want to get data parent to child or child to parent relationships. It can refactor when listing News and then listing Comments inside the News loop. (I have example in the code)

- I have removed the get(), set() functions for columns in the table classes. It would be a hassle to always add these functions everytime there is a new table.


## Manager Classes

- I have refactored na manager classes by using the classes from the class/models folder that extends to the DB class ORM. It is inconvienient to always call the DB class when it can be a parent class to our models classes.

- I have also moved the files to a news folder named manager.

- I have removed the require_once functions in the constructor and simply used the spl_autoload_register method to automatically call the class used. It will be inconvienient to always call the require_once functions, when using class from the class folder and it is a bad practice to call require_once function in a constructor

- I have removed the crud functions that has parameters of each column. It is not a best practice to have a multiple parameters on methods when a table has 10 or more columns as parameters. So I made only a 1 parameter of an array that has the data of table as associative arrays



## DB.php ORM

- I would like to refactor the crud functions in each Manager Class.

- I have refactored the DB.php as ORM and refactored it dynamically. It would be easy if we make the DB class more dynamic in which we can reuse methods to our Manager Class by passing just arrays and id in using CRUD. It is inconvienient that with each table classes, we need declare new set of insert queries.


## Constant Variables

- I have created a Define.php class and require it to index as a collection of defined constant variables e.g. database connections. It will be easy to change constant variables by going only to 1 file.

- It is a best practice to have a file that contains all of our constant variables. We can use this to declare our credentials in future intergrations.

## index.php

- I have also refactored the code and only calling the Define.php and Test.php

- I have created a Test.php class. So that it is clean when testing each functions by creating your custom methods inside the Test class and calling it from index.php


## Other notes

- I have implemented using namespaces for easy calling of classes. Notice that I renamed the class folder to models to easily implement namespace name because the class name is a reserved word.

- I have refactored the folder stucture for easy access and sorting of files. e.g manager folder

## Notes:

All other definitions are in the comments in the code. Please feel free to contact me if you have any questions.
