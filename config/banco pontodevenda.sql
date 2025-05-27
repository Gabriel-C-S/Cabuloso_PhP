create database pontodevenda;
use pontodevenda;

create table produto(
id int not null primary key,
console varchar(50) not null,
computador varchar (50) not null,
celular varchar (50) not null,
notebook varchar (50) not null
);

create table cliente(
id int not null primary key,
nome_cliente varchar (50) not null,
telefone_cliente varchar(100) not null,
endereco_cliente varchar(100) not null,
rg varchar(100) not null,
cpf varchar (100) not null,
email varchar(50) not null
);


create table funcionario(
id int not null primary key,
nome_funcionario varchar (50) not null,
telefone_funcionario bigint not null,
email varchar (50) not null,
rg varchar (100),
cpf varchar (100)
);

create table venda(
id int not null primary key,
id_funcionario int not null,
id_cliente int not null,
id_produto int not null,
data_venda datetime not null,
valor decimal(10,2) not null,
forma_pagamento varchar(100) not null,
constraint foreign key (id_funcionario) references funcionario (id),
constraint foreign key (id_cliente) references cliente (id),
constraint foreign key (id_produto) references produto (id)
);

create table servico (
id int not null primary key,
id_funcionario int not null,
id_cliente int not null,
nome_servico varchar(100) not null,
descricao varchar (100),
preco decimal (10,2) not null,
pecas_utilizadas varchar(50),
tempo_estimado varchar(100),
constraint foreign key (id_funcionario) references funcionario (id),
constraint foreign key (id_cliente) references cliente (id)
);

/*
insert into produto values
(1, 'Xbox 360', 'PC Gamer AMD Ryzen 5', 'Xiaomi' ,'Lenovo Intel Core'), 
(2, 'PlayStation 5', 'Blue PC Legacy AMD Ryzen 5', 'Samsung Galaxy s25' ,'Notebook Acer Aspire'),
(3, 'Xbox One', 'White Aquario Ryzen 5', 'Iphone 11' ,'Ausus Vivobook'),
(4, 'Nintendo Switch', 'Tech Power Desktop', 'Motorola' ,'Samsung Galaxy Book4 Intel Core'),
(5, 'Wii', 'Think Centre', 'Iphone 10', 'Notebook Positivo Vision');
select * from produto;

insert into cliente values
(1, 'Pedro Henrique', '11912345678', 'Estrada do Rufino/Diadema', '534.874.090/00', '234.576.903-0', 'pedrohenrique@gmail.com'),
(2, 'Guilherme Ferreira', '11943598356', 'Rua Augusta/São Paulo', '894.729.023/23', '843.092.984-x', 'guilhermeferreira@gmail.com' ),
(3, 'Vinicius Dias', '1195409321', 'Travessa Silvio Cunha Bueno/Diadema', '943.543.789/89', '237.904.837-0', 'vinicuisdias@gmail.com'),
(4, 'Felipe Menezes', '11982390201', 'Raposo Tavares/São Paulo', '823.923.521/23', '234.839.913-x', 'felipemenezes@gmail.com'),
(5, 'Danilo Carvalho', '11934329543', 'Rodovia dos Tamoios', '903.032.083/72', '893.823.921-0', 'danilocarvalho@gmail.com');
select * from cliente;

insert into funcionario values
(1, 'Alisson Ruan', 11920399023, 'alissonruan@gmail.com', '123.823.903/89', '234.903.932-83'),
(2, 'Gabriel Clayton', 11901239022, 'gabrielclayton@gmail.com', '234.903.902/23'),
(3, 'Ana karoline', 11902392341, 'anakaroline@gmail.com'),
(4, 'Arthur Ramops', 11922340923, 'arthurramos@gmail.com'),
(5, 'Jefferson Ferreira', 11992834324, 'jeffersonferreira@gmail.com');
select * from funcionario;
*/