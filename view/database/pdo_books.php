<meta charset="utf-8">
<?php
	class connected_books{
		public $id_books;
		public $connto_books;
		function __construct($id_books){
			$this->id_books=$id_books;
			switch($this->id_books){
				case "127.0.0.1" or "localhost" or "::1";
					$books_server="localhost";
					$books_username="root";
					$books_password="053282395";
					$books_db="rc_books";
					$books_post=3399;
						try{
							$connto_books=new PDO("mysql:host=$books_server;dbname=$books_db;port=$books_post;charset=utf8",$books_username,$books_password);
							$connto_books->exec("set names utf8");
							$connto_books->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						}catch(PDOException $e){
							echo "Connection Failed: ->pdo_books<-".$e->getMessage();
						}				
				break;
				default;
					$books_server="localhost";
					$books_username="Regina@ict2022";
					$books_password="Regina@ict2022";
					$books_db="rc_books";
					$books_post=3306;
						try{
							$connto_books=new PDO("mysql:host=$books_server;dbname=$books_db;port=$books_post;charset=utf8",$books_username,$books_password);
							$connto_books->exec("set names utf8");
							$connto_books->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						}catch(PDOException $e){
							echo "Connection Failed: ->pdo_books<-".$e->getMessage();
						}				
			}
			$this->connto_books=$connto_books;	
		}function run_connto_books(){
			return $this->connto_books;
		}
	}
?>
