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

function fattoriale($n){
   return $n > 1 ? $n * fattoriale($n - 1) : 1;
};

echo "-----ANAGRAMMI-----\n";
$nome = $argv[2];
$fp = fopen($nome.'.txt', 'w');
$risultati = [];

$lunghezza = strlen($nome);
$lettere = [];

if(fattoriale($lunghezza) < $argv[1]) {
   echo "Le permutazioni sono minori del numero scelto";
   die();
}

for($i = 0; $i<$lunghezza; $i++) {
   $lettere[] = $nome[$i];
}

while(count($risultati) < $argv[1]) {
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
echo "File write $nome.txt";
