<?php

interface Reportable
{
    public function reportar_trabajo();
}


abstract class Aprendiz implements Reportable
{
    private $nombre;
    private $ficha;
    private $edad;

    public function __construct($nombre, $ficha, $edad)
    {
        $this->nombre = $nombre;
        $this->ficha = $ficha;
        $this->edad = $edad;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getFicha()
    {
        return $this->ficha;
    }

    public function getEdad()
    {
        return $this->edad;
    }

    public function mostrar_informacion()
    {
        echo "Nombre: " . $this->nombre . "\n";
        echo "Ficha: " . $this->ficha . "\n";
        echo "Edad: " . $this->edad . "\n";
    }
}


class Backend extends Aprendiz
{
    private $lenguaje;

    public function __construct($nombre, $ficha, $edad, $lenguaje)
    {
        parent::__construct($nombre, $ficha, $edad);

        $this->lenguaje = $lenguaje;
    }

    public function reportar_trabajo()
    {
        return "Desarrolla la parte lógica del sistema usando " . $this->lenguaje;
    }
}


class Frontend extends Aprendiz
{
    private $herramienta;

    public function __construct($nombre, $ficha, $edad, $herramienta)
    {
        parent::__construct($nombre, $ficha, $edad);

        $this->herramienta = $herramienta;
    }

    public function reportar_trabajo()
    {
        return "Desarrolla la interfaz del sistema usando " . $this->herramienta;
    }
}


class Equipo
{
    private $integrantes;

    public function __construct()
    {
        $this->integrantes = [];
    }

    public function agregar_integrante($integrante)
    {
        $this->integrantes[] = $integrante;
    }

    public function mostrar_integrantes()
    {
        echo "\n====================================\n";
        echo "       REPORTE DEL EQUIPO\n";
        echo "====================================\n";

        foreach ($this->integrantes as $integrante) {

            echo "\n------------------------------------\n";

            $integrante->mostrar_informacion();

            echo "Trabajo: ";
            echo $integrante->reportar_trabajo();
            echo "\n";
        }
    }

    public function contar_integrantes()
    {
        return count($this->integrantes);
    }

    public function filtrar_por_ficha($ficha)
    {
        return array_filter($this->integrantes, function ($integrante) use ($ficha) {

            return $integrante->getFicha() == $ficha;

        });
    }

    public function ordenar_por_nombre()
    {
        $ordenados = $this->integrantes;

        usort($ordenados, function ($a, $b) {

            return strcmp(
                $a->getNombre(),
                $b->getNombre()
            );

        });

        return $ordenados;
    }
}


$aprendiz1 = new Backend(
    "Carlos",
    2876543,
    20,
    "PHP"
);

$aprendiz2 = new Frontend(
    "Ana",
    2876543,
    19,
    "HTML y CSS"
);

$aprendiz3 = new Backend(
    "Luis",
    2876544,
    21,
    "C#"
);

$aprendiz4 = new Frontend(
    "Mariana",
    2876544,
    20,
    "JavaScript"
);


$equipo = new Equipo();


$equipo->agregar_integrante($aprendiz1);
$equipo->agregar_integrante($aprendiz2);
$equipo->agregar_integrante($aprendiz3);
$equipo->agregar_integrante($aprendiz4);



$equipo->mostrar_integrantes();



echo "\n====================================\n";
echo "       CANTIDAD DE INTEGRANTES\n";
echo "====================================\n";

echo "Total de integrantes: ";
echo $equipo->contar_integrantes();
echo "\n";




echo "\n====================================\n";
echo "          FILTRAR POR FICHA\n";
echo "====================================\n";

$ficha_buscada = 2876543;

$filtrados = $equipo->filtrar_por_ficha($ficha_buscada);

foreach ($filtrados as $integrante) {

    echo "- " . $integrante->getNombre() . "\n";
}


/* ORDENAR POR NOMBRE */

echo "\n====================================\n";
echo "          ORDENAR POR NOMBRE\n";
echo "====================================\n";

$ordenados = $equipo->ordenar_por_nombre();

foreach ($ordenados as $integrante) {

    echo "- " . $integrante->getNombre() . "\n";
}

?>