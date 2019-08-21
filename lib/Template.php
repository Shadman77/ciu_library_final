<?php

class Template{
    //path to the template
    protected $template;

    //passed variables
    protected $vars = array();

    //constructor
    public function __construct($template)
    {
        $this->template = $template;
    }

    public function __get($key)
    {
        return $this->vars[$key];
    }

    /**The variable will be stored in the local symbol table */
    public function __set($key, $value)
    {
        $this->vars[$key] = $value;
    }

    public function __toString()
    {
        extract($this->vars);//so we can directly use the variable like we did in frontpage.php
        
        chdir(dirname($this->template));//changing the directory to the template location
        
        /**The main idea is to output the whole page at once */
        ob_start();//output buffer started all echo should be stored in the buffer and not showed until we want it to
        include basename($this->template);//including the file using the base name
        return ob_get_clean();//return the output buffer and also clean it that is showing all the buffer contents
    }
}