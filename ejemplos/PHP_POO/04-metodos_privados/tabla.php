<?php
class Tabla
{
    private $matriz = [];
    private $numFilas;
    private $numColumnas;
    private $estilo;

    public function __construct($rows, $columns, $style)
    {
        $this->numFilas = $rows;
        $this->numColumnas = $columns;
        $this->estilo = $style;
    }

    public function cargar($row, $column, $value)
    {
        $this->matriz[$row][$column] = $value;
    }

    private function inicio_tabla()
    {
        echo '<table style="' . $this->estilo . '">';
    }

    private function inicio_fila()
    {
        echo "<tr>";
    }

    private function mostrar_dato($row, $column)
    {
        echo '<td style="' .
            $this->estilo .
            '">' .
            $this->matriz[$row][$column] .
            "</td>";
    }

    private function fin_fila()
    {
        echo "</tr>";
    }

    private function fin_tabla()
    {
        echo "</table>";
    }

    public function graficar()
    {
        $this->inicio_tabla();
        for ($i = 0; $i < $this->numFilas; $i++) {
            $this->inicio_fila();
            for ($j = 0; $j < $this->numColumnas; $j++) {
                $this->mostrar_dato($i, $j);
            }
            $this->fin_fila();
        }
        $this->fin_tabla();
    }
}