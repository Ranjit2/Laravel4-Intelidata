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
  
}

class Correos {
 
    public function fire($tarea, $datos){
        //código que ejecutara la tarea
        
        //cuando la tarea se ejecute debemos borrarla
        $tarea->delete();        
    }
 
}
