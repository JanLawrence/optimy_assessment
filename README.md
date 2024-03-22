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

- You can see that I have extended the class/Comment.php and class/News.php in DB class. I also renamed the class folder to models for easy naming in namespace.

- The models/table.php will serve as our model-like functions. These classes will serve as our connection to tables in our database. So every newly added table we can create another class for the new table, to access the DB ORM. You can also add your custom methods in case of manipulating data. 

  - e.g.
  You can use the belongsTo() and hasChildren() when you want to get data parent to child or child to parent relationships. It can refactor when listing News and then listing Comments inside the News loop. (I have example in the code)

- I have removed the get() set() functions for columns in the table classes. It would be a hassle to always add these functions everytime there is a new table.


## Manager Classes

- I have refactored na manager classes by using the classes from the class folder that extends to the DB class ORM.

- I have removed the require_once functions in the constructor and simply used the spl_autoload_register method to automatically call the class used. It will be hassle to always call the require_once functions when using class from the class folder


## DB.php ORM

- I would like to refactor the crud functions in each Manager Class.

- It would be easy if we make the DB class more dynamic in which we can reuse methods to our Manager Class by passing just arrays and id in using CRUD.


## Constant Variables

- I have created a Define.php class and require it to index as a collection of defined constant variables e.g. database connections. It will be easy to change constant variables by going only to 1 file.


## index.php

- I have also refactored the code and only calling the Define.php and Test.php

- I have created a Test.php class. So that it is clean when testing each functions by creating your custom methods inside the Test class and calling it from index.php


## Other notes

- I have implemented using namespaces for easy calling of classes. Notice that I renamed the class folder to models to easily implement namespace name because the class name is a reserved word.

## Notes:

All other definitions are in the comments in the code. Please feel free to contact me if you have any questions.
