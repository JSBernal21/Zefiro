<?php
class Seguridad {
    public function limpiar_cadena($cadena) {
        $cadena = trim($cadena);
        $cadena = stripslashes($cadena);

        $buscar = [
            "<script>", "</script>", "<script src", "<script type=",
            "SELECT", "*", "FROM", "DELETE FROM", "INSERT INTO", "DROP TABLE",
            "DROP DATABASE", "TRUNCATE TABLE", "SHOW TABLES", "SHOW DATABASE",
            "<?php", "?>", "--", "^", "<", ">", "[", "]", "==", ";", "::","<?="
        ];

        $cadena = str_ireplace($buscar, "", $cadena);
        return $cadena;
    }
}
?>
