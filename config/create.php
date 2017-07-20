<?php

  include('link.php');

	if($link) {

		echo 'Conectado';

	}

	mysqli_query($link, 'create table usrs (
		id int(10) auto_increment primary key,
		user varchar(24) not null,
		password varchar(300) not null,
    type int(1) not null,
    saldo int(6)
	)');

  mysqli_query($link, 'create table sala (
		id int(2) auto_increment primary key,
    places varchar(200)
	)');

  mysqli_query($link, 'create table price (
		id int(2) auto_increment primary key,
    price int(3)
	)');

	mysqli_query($link, 'create table movies (
		id int(10) auto_increment primary key,
		nombre varchar(120) not null,
		genero varchar(24) not null,
		duracion varchar(24) not null,
		sinopsis varchar(600) not null,
    director varchar(150) not null,
    actores varchar(150) not null,
		price int(3) references price(id),
    id_sala int(2) references sala(id)
	)');

  mysqli_query($link, 'create table boleto (
		id int(10) auto_increment primary key,
		id_user int(3) references usrs(id),
		id_movie int(3) references movies(id),
    id_sala int(2) references sala(id),
    hora varchar(20)
	)');
  /*
	$options = [
        'cost' => 10,
    ];

    $hash = password_hash("105012", PASSWORD_DEFAULT, $options);

	mysqli_query($link, 'insert into usrs values (
    NULL,
		"AntMenG",
		"' . $hash . '",
    1,
    "116"
	)');

  mysqli_query($link, 'insert into price values (
    NULL,
		"58"
	)');
  */
?>
