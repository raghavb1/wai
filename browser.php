<?php
class browser 
{ 
    private $props    = array("Version" => "0.0.0", 
                                "Name" => "unknown", 
                                "Agent" => "unknown") ; 

    public function __Construct() 
    { 
        $browsers = array("firefox", "msie", "opera", "chrome", "safari", 
                            "mozilla", "seamonkey",    "konqueror", "netscape", 
                            "gecko", "navigator", "mosaic", "lynx", "amaya", 
                            "omniweb", "avant", "camino", "flock", "aol"); 

        $this->Agent = strtolower($_SERVER['HTTP_USER_AGENT']); 
        foreach($browsers as $browser) 
        { 
            if (preg_match("#($browser)[/ ]?([0-9.]*)#", $this->Agent, $match)) 
            { 
                $this->Name = $match[1] ; 
                $this->Version = $match[2] ; 
                break ; 
            } 
        } 
    } 

    public function __Get($name) 
    { 
        if (!array_key_exists($name, $this->props)) 
        { 
            die ; 
        } 
        return $this->props[$name] ; 
    } 

    public function __Set($name, $val) 
    { 
        if (!array_key_exists($name, $this->props)) 
        { 
            SimpleError("No such property or function.", "Failed to set $name", $this->props) ; 
            die ; 
        } 
        $this->props[$name] = $val ; 
    } 

} 

?>