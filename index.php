<!DOCTYPE html>

<html>
<head>
    <title>Csillag</title>
    <link rel="stylesheet" type="text/css" href="style.css">
       
</head>

<body>

<?php

function _csillag( $x, $y, $radius, $forma='polygon', $cs=NULL ) {
    
    $pont = array() ;                                                                                                                    
    $szog = 360 / 5 ;
    $pont[0]['x'] = $x ;                                                                                                                 
    $pont[0]['y'] = $y - $radius ;                                                                                                       
    $pont[2]['x'] = $x + ( $radius * cos( deg2rad( 90 - $szog ) ) ) ; 
    $pont[2]['y'] = $y - ( $radius * sin( deg2rad( 90 - $szog ) ) ) ;
    $pont[4]['x'] = $x + ( $radius * sin( deg2rad( 180 - ( $szog*2 ) ) ) ) ;
    $pont[4]['y'] = $y + ( $radius * cos( deg2rad( 180 - ( $szog*2 ) ) ) ) ;
    $pont[6]['x'] = $x - ( $radius * sin( deg2rad( 180 - ( $szog*2 ) ) ) ) ;                                                            
    $pont[6]['y'] = $y + ( $radius * cos( deg2rad( 180 - ( $szog*2 ) ) ) ) ;
    $pont[8]['x'] = $x - ( $radius * cos( deg2rad( 90 - $szog ) ) ) ;                                                                   
    $pont[8]['y'] = $y - ( $radius * sin( deg2rad( 90 - $szog ) ) ) ;
    if( $forma == 'star' ) {
        if( $cs == NULL ) $cs = 0.5 ;  // alap 0.5
        $belso = $radius * $cs ;
        $pont[1]['x'] = $x + ( $belso * cos( deg2rad( 90 - $szog/2 ) ) ) ;                                                             
        $pont[1]['y'] = $y - ( $belso * sin( deg2rad( 90 - $szog/2 ) ) ) ;                                                     
        $pont[3]['x'] = $x + ( $belso * sin( deg2rad( 180 - $szog ) ) ) ;                                                              
        $pont[3]['y'] = $y - ( $belso * cos( deg2rad( 180 - $szog ) ) ) ;
        $pont[5]['x'] = $x ;                                                                                                             
        $pont[5]['y'] = $y + ( $belso * sin( deg2rad( 180 - $szog ) ) ) ;
        $pont[7]['x'] = $x - ( $belso * sin( deg2rad( 180 - $szog ) ) ) ;                                                              
        $pont[7]['y'] = $y - ( $belso * cos( deg2rad( 180 - $szog ) ) ) ;                                                              
        $pont[9]['x'] = $x - ( $belso * cos( deg2rad( 90 - $szog/2 ) ) ) ;                                                             
        $pont[9]['y'] = $y - ( $belso * sin( deg2rad( 90 - $szog/2 ) ) ) ;
    }
    ksort( $pont ) ;
    $hely = array() ;  // új tömb                                                                                                                
    foreach( $pont as $pKey=>$pErtek ) {                                                                                                   
        if( is_array( $pErtek ) ) {                                                                                                         
            foreach( $pErtek as $pSubKey=>$pSubErt ) {                                                                                      
                if( !empty( $pSubErt ) ) array_push( $hely, $pSubErt ) ;                                                                
            }                                                                                                                             
        }                                                                                                                                 
    }
    return $hely ;


}
$ertek = _csillag( 120, 350, 59, 'star' ); //x, y, méret
$ertek1 = _csillag( 125, 346, 59, 'star' ) ;
$ertek2 = _csillag( 130, 342, 59, 'star' ) ;
$ertek3 = _csillag( 135, 338, 59, 'star' ) ;
$ertek4 = _csillag( 140, 334, 59, 'star' ) ;
$ertek5 = _csillag( 145, 330, 59, 'star' ) ;

$im = imagecreate(500,500);  //rajzkeret
imagecolorallocate($im,13,4,4);

$w = imagecolorallocate($im, 255, 254, 25); //sárga
imagefilledpolygon($im, $ertek, 10, $w);
$w = imagecolorallocate($im, 255, 120, 31); //narancs
imagefilledpolygon($im, $ertek1, 10, $w);
$w = imagecolorallocate($im, 255, 23, 44); //piros
imagefilledpolygon($im, $ertek2, 10, $w);
$w = imagecolorallocate($im, 255, 50, 218); //pink
imagefilledpolygon($im, $ertek3, 10, $w);
$w = imagecolorallocate($im, 155, 76, 255); //lila
imagefilledpolygon($im, $ertek4, 10, $w);
$w = imagecolorallocate($im, 81, 255, 0); //zöld
imagefilledpolygon($im, $ertek5, 10, $w);

imagepng($im,"demoimage.png");
imagedestroy($im);
?>

<img src="demoimage.png">
   

   
    
    
</body>
</html>
