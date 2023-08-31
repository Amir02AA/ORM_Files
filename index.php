<?php
include_once "vendor/autoload.php";

// pdo :
//$pdo = \query\SqlConnection::getConnection();
//
//$query1 = "select * from doctors";
//$results = $pdo->query($query1)->fetchAll();
//
//echo "<pre>";
//print_r($results);
//echo "<pre>";
//
//
//$query2 = "insert into managers(username,password,email)
//                         value (:username,:password,:email);";
//$values = [
//    'username'=>'who123',
//    'password'=>'55555',
//    'email' => 'who@mail'
//];
//$pdo->prepare($query2)->execute($values);
//
//$query3 = "update doctors
//                set name=:name , email=:email
//                where id=:id";
//
//$values = [
//    'name' => 'Arman',
//    'email' => 'Army@mail',
//    'id'=>2
//];
//
//$pdo->prepare($query3)->execute($values);

// builder :
$builder = \query_builder\SqlQueryBuilder::getInstance();
//$results = $builder->table('doctors')->select()->fetchAll();
$values = [
    'verified'=> 1,
    'password' => '654321'
];

$id = 3;

$builder->table('doctors')->update($values)
    ->where('id',$id)->exec();
//$builder->table('doctors')->insert($values)->exec();

//echo "<pre>";
//print_r($results);
//echo "<pre>";