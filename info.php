<?php

$conn = new mysqli("localhost", "root", "", "Reseau.So");

$login = $_POST['login'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

$sql = "INSERT INTO Formulaire ('Login'  ,'Nom' , 'Prénom', 'Email', 'Password') VALUES ($login,$nom,$prenom,$email,$password)";

?>