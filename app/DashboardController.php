<?php

class Dashboard extends DB
{

    function __construct(){
        parent::__construct();
    }


    function member() {
        $total = $this->queryRow("SELECT * FROM attendance WHERE member = 'member';");
        
        return $total;
    }

    function active() {
        $total = $this->queryRow("SELECT * FROM member WHERE membership >= CURDATE() AND removed = 0;");
        
        return $total;
    }

    function walkin() {
        $total = $this->queryRow("SELECT * FROM attendance WHERE member = 'nonMember';");
        
        return $total;
    }


    function memberSales() {
        $total = $this->query("SELECT * FROM sale WHERE membership = 'member';");
        
        return $total;
    }

    function walkinSales() {
        $total = $this->query("SELECT * FROM sale WHERE membership = 'walkin';");
        
        return $total;
    }

    function selectAll() {
        $allDetails = $this->query("SELECT DATE_FORMAT(date, '%Y') as 'year',
                                    DATE_FORMAT(date, '%M') as 'month',
                                    COUNT(id) as 'total',
                                    SUM(profit) as 'sales'
                                    FROM sale
                                    GROUP BY DATE_FORMAT(date, '%Y%m');");
        
        return $allDetails;
    }

    function selectSale() {
        $total = $this->query("SELECT * FROM sale");
        
        return $total;
    }
    
}

?>