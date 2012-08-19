<?php

//###
//#
//#  Compass Datagrid - Server-side code
//#
//###


 // Page Specific Variables

 # Debug Switch
  define( 'DEBUG' , false );
 # Default Options
  $defaults = array(
    'page'      => 1 ,
    'show'      => 10 ,
    'showField' => 'id' ,
    'showOrder' => 'asc'
  );
 # Translate Table IDs to Titles
  $idToTitle = array(
    'id'    => 'Record #' ,
    'two'   => 'Col #2' ,
    'three' => 'Col #3' ,
    'four'  => 'Col #4'
  );
 # Column Widths (Optional)
  $idToWidth = array(
    'two' => '50%'
  );

 # Check for GET Parameters and Validate
  $request = $defaults;
  if( count( $_GET ) ){
    if( isset( $_GET['page'] ) )
      $request['page'] = (int) $_GET['page'];
    if( isset( $_GET['show'] ) )
      $request['show'] = (int) $_GET['show'];
    if( isset( $_GET['showField'] ) && in_array( $_GET['showField'] , array_keys( $idToTitle ) ) )
      $request['showField'] = (int) $_GET['showField'];
    if( isset( $_GET['showOrder'] ) && in_array( $_GET['showOrder'] , array( 'asc' , 'desc' ) ) )
      $request['showOrder'] = $_GET['showOrder'];
  }


 // Page Specific Functions

 # Processes the three pieces of data into JSON
  function sendAsJSON( $pageData=null , $headingData=null , $contentData=null ){
   # Check Data
    if( is_null( $pageData ) || is_null( $headingData ) || is_null( $contentData ) )
      die( 'Error: Required data not provided.' );
   # Compile Array
    $out = array();
    if( is_array( $pageData ) ){
      if( is_array( $pageData[0] ) )
        $out['pager'] = $pageData;
      else
        $out['pager'] = array( $pageData );
    }
    $out['headings'] = $headingData;
    $out['rows'] = $contentData;
   # Send JSON
    if( DEBUG ){
      echo '<pre>';
      var_dump( $out );
      die();
    }
    header( 'Content-Type: text/x-json' );
    die( json_encode( $out ) );
  }


 // Query Database/Source and Create Content

 # The Output Data
  $data = array();
  $totalDataCount = 0;

 # DEMONSTRATION DATA - START
  $totalDataCount = 95;
  for( $i = ( ( $request['page']-1 )*$request['show'] )+1 , $c = min( $request['show'] * $request['page'] , $totalDataCount ) ; $i<=$c ; $i++ ){
    $data[] = array(
      'id'    => $i ,
      'two'   => 'B'.$i ,
      'three' => 'C'.$i ,
      'four'  => 'D'.$i
    );
  }
 # DEMONSTRATION DATA - END


 // Prepare the Output
 
 # Pager Data (Automated)
  $pager = array(array(
    'page'            => $request['page'] ,
    'pages'           => ceil( $totalDataCount / $request['show'] ) ,
    'found'           => $totalDataCount ,
    'displayingStart' => ( ( $request['page'] - 1 )*$request['show'] ) + 1 ,
    'displayingEnd'   => ( ( $request['page'] - 1 )*$request['show'] ) + count( $data )
  ));

 # Headings (Automated)
  $headings = array();
  foreach( $idToTitle as $id => $title ){
    $r = array(
      'id' => $id ,
      'display' => $title
    );
    if( isset( $idToWidth[$id] ) )
      $r['width'] = $idToWidth[$id];
    if( $request['showField']==$id )
      $r['sort'] = 'sort-'.$request['showOrder'];
    $headings[] = $r;
  }


 // Transmit the JSON Output
  sendAsJSON( $pager , $headings , $data );
