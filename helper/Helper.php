<?php

class Helper
{

    public $dbObj;

    /**
     * Helper constructor.
     */
    public function __construct()
    {
        $this->dbObj = new Database();
    }

    /**
     * Validate String
     * @param $data
     * @return string
     */
    public function validation($data)
    {
        $c = trim($data);
        $d = htmlspecialchars($c);
        $e = stripslashes($d);
        return $e;
    }

    /**
     * Escape String Data
     * @param $data
     * @return string
     */
    public function realEscape($data)
    {
        $data = mysqli_real_escape_string($this->dbObj->link, $data);
        return $data;
    }

    /**
     * Valid and Escape String Data
     * @param $data
     * @return string
     */
    public function validAndEscape($data)
    {
        $d = $this->validation($data);
        $e = $this->realEscape($d);
        return $e;
    }

    /**
     * Valid Array Data
     * @param $data
     * @return string
     */
    public function validArrayData($data)
    {
        $data = $this->validation($data);
        $data = $this->realEscape($data);
        return $data;
    }

    /**
     * Format Date
     * @param $date
     * @param string $format
     * @return false|string
     */
    public function formatDate($date, $format = 'd-m-Y')
    {
        return date($format, strtotime($date));
    }

    /**
     * Validate Email
     * @param $data
     * @return bool
     */
    public function validEmail($data)
    {
        if (filter_var($data, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Validate Integer
     * @param $data
     * @return bool
     */
    public function validInt($data)
    {
        if (filter_var($data, FILTER_VALIDATE_INT)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Validate Float
     * @param $data
     * @return bool
     */
    public function validFloat($data)
    {
        if (filter_var($data, FILTER_VALIDATE_FLOAT)) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * get category from long string
     * @param string $string
     * @return string
     */
    public function getCategoryFromString($string = '')
    {
        //$string = 'Cosmetics|Cosmetics > Makeup > Face Makeup|Cosmetics > Makeup > Face Makeup > Face Primer|Cosmetics > Makeup';
        $explodeString = explode('|', $string);
        foreach ($explodeString as $item) {
            $finalExplode = explode('>', $item);
            $targetArray[] = end($finalExplode);
        }

        $string = '';
        foreach ($targetArray as $item) {
            $string .= ',' . $item;
        }
        return ltrim($string, ',');
    }


    /**
     * Generate CSV File From String
     * @param $sqlQuery
     * @param $fileName
     * @param $columns
     */
    public function generateCSV($sqlQuery, $fileName, $columns)
    {
        $status = $this->dbObj->select($sqlQuery);
        $data = array();
        if ($status->num_rows > 0) {
            while ($row = $status->fetch_assoc()) {
                $data[] = $row;
            }
        }
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $fileName);
        $output = fopen('php://output', 'w');
        fputcsv($output, $columns);
        if (count($data) > 0) {
            foreach ($data as $row) {
                fputcsv($output, $row);
            }
        }
    }
}

