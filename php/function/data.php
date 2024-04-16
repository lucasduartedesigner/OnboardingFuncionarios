<?php 

    function dataToBR($data)
    {
        $data = (!empty($data)) ? DateTime::createFromFormat('Y-m-d', $data)->format('d/m/Y') : null;

        return $data;
    }

    function dataToUS($data)
    {
        $data = (!empty($data)) ? DateTime::createFromFormat('d/m/Y', $data)->format('Y-m-d') : null;

        return $data;
    }


?>