<?php

/**
 * 
 * @author Alexandre LAMOUREUX <alexlamoureuxfr@gmail.com> 
 */
class Renderer {
    
    /**
     * 
     * @var Renderer[]
     */
    protected $children = array();
    protected $template;
    protected $data;
    
    /**
     * Renderer class : to output HTML
     * @param string $template name of phtml file in views without the phtml extention example for /view/index.phtml pass "index" 
     * @param array $data
     */
    public function __construct($template, array $data = array()) {
        $this->template = $template;
        $this->data = $data;
    }
    
    /**
     * @param scalar $index
     * @return mixed
     */
    public function getData($index) {
        return $this->data[$index] ?? null;
    }
    
    /**
     * @param scalar $index
     * @param mixed $value
     * @return $this
     */
    public function setData($index, $value) {
        $this->data[$index] = $value;
        return $this;
    }
    
    
    /**
     * @param scalar $name
     * @return Renderer
     */
    public function getChild($name) {
        return $this->children[$name] ?? null;
    }
    
    /** 
     * @param string $name
     * @param Renderer $child
     * @return $this
     */
    public function addChild($name, Renderer $child) {
        $this->children[$name] = $child;
        return $this;
    }
    
    /**
     * 
     * @return Renderer[]
     */
    public function getChildren() {
        return $this->children;
    }
    
    /**
     * render all children
     * @return void
     */
    public function renderChildren() {
        foreach ($this->children as $c) {
            $c->render();
        }
    }
    
    /**
     * render HTML
     */
    public function render() {
        //you can use $this->getData('xxx') in template
        include BP."/view/".$this->template.".phtml";
    }
    
}

