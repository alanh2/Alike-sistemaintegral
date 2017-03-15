<?
include "conecta.php";

if(isset($_POST['submit']))

   {
	     $filename=$_POST['filename'];

	     $handle = fopen("$filename", "r");

     while (($datos = fgetcsv($handle, 1000, ";")) !== FALSE)

     {

	      $import="INSERT INTO localidades  VALUES ( NULL ,'$datos[0]','$datos[1]')";

	       mysql_query($import) or die(mysql_error());

     }

     fclose($handle);

	     print "La importación fue un exito, total !";

 

   }

   else

   {

	 	  print "<form action='importa.php' method='post'>";

	      print "Ingrese el archivo a importar:<br>";

	      print "<input type='file' name='filename' size='20'><br>";

	      print "<input type='submit' name='submit' value='submit'></form>";

   }
?>