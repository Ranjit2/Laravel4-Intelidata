Class Funct {

  public static function postUpload ($input = '') {
    if (Input::hasFile($input)) {
    
        // Get file input
        $file = Input::file('file');
        $name = time() . '-' . $file->getClientOriginalName();
  
        // Check out the edit content on bottom of my answer for details on $storage
        $path = storage_path() . '/uploads/CSV';
  
        // Moves file to folder on server
        $file->move($path, $name);
  
        // Import the moved file to DB and return OK if there were rows affected
        return ($this->importCSV($path, $name) ? 'OK' : 'No rows affected' );            
    }
  }
  
  private static function importCSV ($path = '', $filename = '', $table = '') {
    
    // CSV File
    $csv = $path . $filename; 
    
    // Ofcourse you have to modify that with proper table and field names
    $query = sprintf("LOAD DATA local INFILE '%s' INTO TABLE %s FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' ESCAPED BY '\"' LINES TERMINATED BY '\\n' IGNORE 0 LINES (`filed_one`, `field_two`, `field_three`)", array(addslashes($csv),$table));
    
    // Insert data into DB
    return DB::connection()->getpdo()->exec($query);
  }
  
  public static function convNumberToMonth ($number = 01) {
  
    // Array with number => month
    $month = array('01' => 'enero', '02' => 'febrero', '03' => 'marzo', '04' => 'abril', '05' => 'mayo', '06' => 'junio', '07' => 'julio', '08' => 'agosto', '09' => 'septiembre', '10' => 'octubre', '11' => 'noviembre', '12' => 'diciembre');
    
    // Get Month name into array
    $month = array_get($month, $number, '');
    
    // Convert name to CamelCase 
    $month = Str::camel($month);
    
    return $month;
  }
  
  public static function convMonthToNumber ($month = '') {
    
    // Array with month => number
    $number = array('enero' => '01', 'febrero' => '02', 'marzo' => '03', 'abril' => '04', 'mayo' => '05', 'junio' => '06', 'julio' => '07', 'agosto' => '08', 'septiembre' => '09', 'octubre' => '10', 'noviembre' => '11', 'diciembre' => '12');
    
    // Convert name to lower case 
    $month = Str::lower($month);
    
    // Get number into array 
    $number = array_get($number, $month, '');
    
    return $number;
  }
  
}

class Correos {
 
    public function fire($tarea, $datos){
        //código que ejecutara la tarea
        
        //cuando la tarea se ejecute debemos borrarla
        $tarea->delete();        
    }
 
}
