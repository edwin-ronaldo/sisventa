<?php
echo "¡Hola! El servidor Apache está funcionando correctamente.";
echo "<br>";
echo "Fecha y hora actual: " . date('Y-m-d H:i:s');
echo "<br>";
echo "Directorio actual: " . __DIR__;
echo "<br>";
echo "Document Root: " . $_SERVER['DOCUMENT_ROOT'];
?> 