<?php
class resultModel implements JsonSerializable {
    private $resultado;
    private $mensaje;
    
    public function __construct() {
        
    }
    
    /**
     * @return mixed
     */
    public function getResultado()
    {
        return $this->resultado;
    }

    /**
     * @return mixed
     */
    public function getMensaje()
    {
        return $this->mensaje;
    }

    /**
     * @param mixed $resultado
     */
    public function setResultado($resultado)
    {
        $this->resultado = $resultado;
    }

    /**
     * @param mixed $mensaje
     */
    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }    
}