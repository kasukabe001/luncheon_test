<?php //-----------------------------------------------------------
// ----------------------------------------------------------------
//
//PostgreSQL Interface CLASS
//

class PgLib {
  
  var $_pg_conn;    // resource connection
  var $_pg_result;  // resource result
  var $_debug = 0;  // debug flag 0 or 1
  
  //------------------------------------------------------------
  //Constructor:  Connection to PostgreSQL Server
  //------------------------------------------------------------
  function PgLib ($dbname,$dbuser,$passwd) {

    $connect_query = "dbname=" . $dbname . " user=" . $dbuser . " port=5432 password=" . $passwd;
//    $connect_query = "dbname=" . $dbname . " port=5432";

    $this->_pg_conn = pg_connect($connect_query);

    if ( $this->_pg_conn && $this->_debug ) {

      print pg_last_error($this->_pg_conn);

    }

  }
  
  //------------------------------------------------------------
  //Exec SQL Query 
  //------------------------------------------------------------
  function Exec_Query ($query) {
    $this->_pg_result = pg_query($this->_pg_conn, $query);
    
    if ( $this->_pg_result ) {

      return (pg_affected_rows($this->_pg_result));

    }
    else {

      //error
      if ($this->_debug) {
	print pg_result_error($this->_pg_result);
	exit;
      }
	
      return (0);
    }

  }
  
  //------------------------------------------------------------
  //
  //------------------------------------------------------------
  function Select ($query) {

    $this->_pg_result = pg_query($this->_pg_conn, $query);

    //error
    if ($this->_select_is_error()) {
      return (0);
    }

    if ( ($num_rows  = pg_num_rows($this->_pg_result)) <= 0 ) {
      return (0);
    }

    for( $i=0; $i < $num_rows; ++$i ) {

      $fetch_array = pg_fetch_array($this->_pg_result,$i,PGSQL_ASSOC);
      
      if ( empty($fetch_array) ) {
	continue;
      }

      foreach ($fetch_array as $key => $val) {

	$fetch_array[$key] = stripslashes($fetch_array[$key]);

      }
      
      $rows[$i] = $fetch_array;
    }
      
    return ($rows);

  }

  //------------------------------------------------------------
  //
  //------------------------------------------------------------
  function Select_Recode ($query) {

    $this->_pg_result = @pg_query($this->_pg_conn, $query);

    //error
    if ($this->_select_is_error()) {
      return (0);
    }

    if ( ($num_rows  = pg_num_rows($this->_pg_result)) <= 0 ) {
      return (0);
    }

    $recode = pg_fetch_array($this->_pg_result,0,PGSQL_ASSOC);

    foreach ($recode as $key => $val) {
      
      $recode[$key] = stripslashes($val);
      
    }
    
    return ($recode);

  }

  //------------------------------------------------------------
  //
  //------------------------------------------------------------
  function _select_is_error ()  {

    if ( !$this->_pg_result ) {
      
      if ($this->_debug) {
	
	print pg_result_error($this->_pg_result);
	return (1);
	
      }
    }

    return (0);

  }

}

//-----------------------------------------------------------------
//-----------------------------------------------------------------?>
