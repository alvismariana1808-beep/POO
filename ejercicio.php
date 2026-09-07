<?php

interface Reportable
{
    public function reportarTrabajo();
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

    public function mostrarInformacion()
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

    public function reportarTrabajo()
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

    public function reportarTrabajo()
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

    public function agregarIntegrante($integrante)
    {
        $this->integrantes[] = $integrante;
    }

    public function mostrarIntegrantes()
    {
        echo "\n====================================\n";
        echo "       REPORTE DEL EQUIPO\n";
        echo "====================================\n";

        foreach ($this->integrantes as $integrante) {

            echo "\n------------------------------------\n";

            $integrante->mostrarInformacion();

            echo "Trabajo: ";
            echo $integrante->reportarTrabajo();
            echo "\n";
        }
    }

    public function contarIntegrantes()
    {
        return count($this->integrantes);
    }

    public function filtrarPorFicha($ficha)
    {
        return array_filter($this->integrantes, function ($integrante) use ($ficha) {

            return $integrante->getFicha() == $ficha;

        });
    }

    public function ordenarPorNombre()
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


/* CREAR APRENDICES */

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


/* CREAR EQUIPO */

$equipo = new Equipo();


/* AGREGAR APRENDICES */

$equipo->agregarIntegrante($aprendiz1);
$equipo->agregarIntegrante($aprendiz2);
$equipo->agregarIntegrante($aprendiz3);
$equipo->agregarIntegrante($aprendiz4);


/* MOSTRAR TODOS */

$equipo->mostrarIntegrantes();


/* CONTAR INTEGRANTES */

echo "\n====================================\n";
echo "       CANTIDAD DE INTEGRANTES\n";
echo "====================================\n";

echo "Total de integrantes: ";
echo $equipo->contarIntegrantes();
echo "\n";


/* FILTRAR POR FICHA */

echo "\n====================================\n";
echo "          FILTRAR POR FICHA\n";
echo "====================================\n";

$fichaBuscada = 2876543;

$filtrados = $equipo->filtrarPorFicha($fichaBuscada);

foreach ($filtrados as $integrante) {

    echo "- " . $integrante->getNombre() . "\n";
}


/* ORDENAR POR NOMBRE */

echo "\n====================================\n";
echo "          ORDENAR POR NOMBRE\n";
echo "====================================\n";

$ordenados = $equipo->ordenarPorNombre();

foreach ($ordenados as $integrante) {

    echo "- " . $integrante->getNombre() . "\n";
}

?>