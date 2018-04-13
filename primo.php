<?php

function arrayEmpty($t) {
   for($x = 0; $x<count($t); $x++) {
      if($t[$x] != null) {
          return false;
      }
   }
   return true;
}

function contiene($a, $p) {
   for($x = 0; $x<count($a); $x++) {
      if($a[$x] == $p) {
         return true;
      }
   }
   return false;
}

echo "-----ANAGRAMMI-----\n";
$fp = fopen('data.txt', 'w');
$risultati = [];

$nome = $argv[2];
$lunghezza = strlen($nome);
$lettere = [];

for($i = 0; $i<$lunghezza; $i++) {
   $lettere[] = $nome[$i];
}

for($c = 0; $c < $argv[1]; $c++) {
   // Tiro ad indovinare la lettera fino a quando le ho usate tutte
   $t = $lettere;
   $anagramma = [];
   while(!arrayEmpty($t)) {
      // togli
      $n = rand(0, $lunghezza-1);
      if($t[$n] != null) {
         $anagramma[] = $t[$n];
         $t[$n] = null;
      }
   }
   $parola = implode('', $anagramma);
   if(!contiene($risultati, $parola)) {
      $risultati[] = $parola;
   }
}


for($i = 0; $i<count($risultati); $i++) {
   fwrite($fp, "$risultati[$i]\n");
}

fclose($fp);
echo "File write data.txt";
