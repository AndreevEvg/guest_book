<?php

class gBook
{
    protected $db;
    
    public function __construct($DB_con)
    {
        $this->db = $DB_con;
    }
 
    /* Фильтрация данных получаемых от пользователя */
    protected function clearData($data, $type = "s")
    {
        switch ($type) {
            case "s":
                $data = trim(strip_tags($data));
                break;
        }
        
        return $data;
    }
}