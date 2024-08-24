<?php
require_once '../config/database.php';
require_once '../models/Producto.php';

class ProductoController {
    private $db;
    private $producto;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->producto = new Producto($this->db);
    }

    public function create($nombre, $descripcion, $precio) {
        $this->producto->nombre = $nombre;
        $this->producto->descripcion = $descripcion;
        $this->producto->precio = $precio;

        if ($this->producto->create()) {
            echo "Producto creado con éxito.";
        } else {
            echo "No se pudo crear el producto.";
        }
    }

    public function readAll() {
        $stmt = $this->producto->readAll();
        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $productos;
    }

    public function update($id, $nombre, $descripcion, $precio) {
        $this->producto->id = $id;
        $this->producto->nombre = $nombre;
        $this->producto->descripcion = $descripcion;
        $this->producto->precio = $precio;

        if ($this->producto->update()) {
            echo "Producto actualizado con éxito.";
        } else {
            echo "No se pudo actualizar el producto.";
        }
    }

    public function delete($id) {
        $this->producto->id = $id;

        if ($this->producto->delete()) {
            echo "Producto eliminado con éxito.";
        } else {
            echo "No se pudo eliminar el producto.";
        }
    }
}
