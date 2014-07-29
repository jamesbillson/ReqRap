<?php


define( 'ETYPE_NODE', 1 );
define( 'ETYPE_LEAF', 2 );

class CElement
{
    // Unique element id
    var $id         = 0;
    
    // Parent element id
    var $parent     = 0;
    
    // Element type
    var $type       = 0;
    
    // The actual element content
    var $content;
    
    // Element level in the tree (0=top etc...)
    var $level      = 0;

    // Width of the element in pixels
    var $width      = 0;

    // Drawing offset
    var $indent     = 0;

    // Constructor
    function CElement( $id = 0, $parent = 0, $content = NULL, $level = 0, $type = ETYPE_LEAF )
    {
        $this->id       = $id;
        $this->parent   = $parent;
        $this->type     = $type;
        $this->content  = trim( $content );
        $this->level    = $level;
        $this->width    = 0;
        $this->indent   = 0;
    }

    // Debug helper function
    function Dump()
    {
        printf( "ID      : %d\n", $this->id );
        printf( "Parent  : %d\n", $this->parent );
        printf( "Level   : %d\n", $this->level );
        printf( "Type    : %d\n", $this->type );
        printf( "Width   : %d\n", $this->width );
        printf( "Indent  : %d\n", $this->indent );
        printf( "Content : %s\n\n", $this->content );
    }
}



class CElementList
{
    // +--------------------------------------------------------------------
    // | PUBLIC functions
    // +--------------------------------------------------------------------
    
    function Add( $e )
    {
        $this->_elements[] = $e;

        if ( $e->parent != 0 )
        {
            $p = $this->GetID( $e->parent );
            $p->type = ETYPE_NODE;
            $this->SetID( $p->id, $p );
        }
    }

    function GetFirst()
    {
        if ( count( $this->_elements ) == 0 )
            return NULL;

        $this->_iterator = 0;

        return ( $this->_elements[ $this->_iterator ] );
    }

    function GetNext()
    {
        ++$this->_iterator;

        if ( !isset( $this->_elements[ $this->_iterator ]  ))
            return NULL;

        return ( $this->_elements[ $this->_iterator ] );
    }

    function GetID( $id )
    {
        for( $i=0; $i<count( $this->_elements ); $i++ )
        {
            if ( $this->_elements[ $i ]->id == $id )
                return $this->_elements[ $i ];
        }

        return FALSE;
    }

    function SetID( $id, $e )
    {
        for( $i=0; $i<count( $this->_elements ); $i++ )
        {
            if ( $this->_elements[ $i ]->id == $id )
            {
                $this->_elements[ $i ] = $e;
                break;
            }
        }
    }

    function GetElements()
    {
        return $this->_elements;
    }

    function GetChildCount( $id )
    {
        return count( $this->GetChildren( $i ) );
    }

    function GetChildren( $id )
    {
        $children = array();

        for( $i=0; $i<count( $this->_elements ); $i++ )
        {
            if ( $this->_elements[$i]->parent == $id )
            {
                $children[] = $this->_elements[$i]->id;
            }
        }

        return $children;
    }

    function GetElementWidth( $id )
    {
        $e = $this->GetID( $id );
        if ( $e != FALSE )
            return $e->width;

        return -1;
    }

    function SetElementWidth( $id, $width )
    {
        $e = $this->GetID( $id );
        if ( $e != FALSE )
        {
            $e->width = $width;
            $this->SetID( $id, $e );
        }
    }

    function GetIndent( $id )
    {
        $e = $this->GetID( $id );
        if ( $e != FALSE )
            return $e->indent;

        return -1;
    }

    function SetIndent( $id, $indent )
    {
        $e = $this->GetID( $id );
        if ( $e != FALSE )
        {
            $e->indent = $indent;
            $this->SetID( $id, $e );
        }
    }

    function GetLevelHeight()
    {
        $maxlevel = 0;
        for( $i=0; $i<count( $this->_elements ); $i++ )
        {
            $level = $this->_elements[ $i ]->level;
            if ( $level > $maxlevel )
                $maxlevel = $level;
        }

        return $maxlevel+1;
    }

    // +--------------------------------------------------------------------
    // | PRIVATE functions
    // +--------------------------------------------------------------------
    
    // The element array
    var $_elements;

    // Iterator index (used for GetFirst() / GetNext() )
    var $_iterator = -1;
}

function escape_high_ascii( $s )
{
    $html = '';

    for( $i = 0; $i < strlen( $s ); ++$i )
    {
        $c = $s[$i];
        if ( ord( $c ) < 127 )
            $html .= $c;
        else
            $html .= sprintf( '&#%d;', ord( $c ) );
    }

    return $html;
}

class CStringParser
{
    // ----------------------------------------------------------------------
    // PUBLIC FUNCTIONS
    // ----------------------------------------------------------------------

    function CStringParser( $s )
    {
        // Clean up the data a little to make processing easier
        
        $s = str_replace( "\t", "", $s );
        $s = str_replace( "\n", " ", $s );
        $s = str_replace( "\r", " ", $s );
        $s = str_replace( "  ", " ", $s );
        $s = str_replace( "] [", "][", $s );
        $s = str_replace( " [", "[", $s );

        $s = escape_high_ascii( $s );

        // Store it for later...
        
        $this->data = $s;

        // Initialize internal element list 
        
        $this->elist = new CElementList();
    }

	
    function Parse()
    {
        $this->makeTree( 0 );
    }

    function GetElementList()
    {
        return $this->elist;
    }

	
    // ----------------------------------------------------------------------
    // PRIVATE FUNCTIONS
    // ----------------------------------------------------------------------

    // Element list pointer
    var $elist;

    // The input sentence
    var $data = "";

    // Position in the sentence
    var $pos = 0;

    // ID for the next element
    var $id = 1;

    // Level in the diagram
    var $level = 0;

    // Node type counts
    var $tncnt;

    function countNode( $name )
    {
        $name = trim( $name );

        if ( isset( $this->tncnt[ $name ] ) )
            $this->tncnt[ $name ] += 1;
        else
            $this->tncnt[ $name ] = 1;
    }

    function getNextToken()
    {
        $gottoken = FALSE;
        $token = "";
        $i = 0;

        if ( ($this->pos + 1) >= strlen( $this->data ) )
            return "";

        while( ($this->pos + $i) < strlen( $this->data ) && !$gottoken )
        {
            $ch = $this->data[$this->pos + $i];

            switch( $ch )
            {
            case "[":
                if( $i > 0 )
                    $gottoken = TRUE;
                else
                    $token .= $ch;
                break;

            case "]":
                if( $i == 0 )
                    $token .= $ch;
                $gottoken = TRUE;
                break;

            case "\n":
            case "\r":
                break;

            default:
                $token .= $ch;
                break;
            }

            $i++;
        }

        if( $i > 1 )
            $this->pos += $i - 1;
        else
            $this->pos++;

        return $token;
    }

    function makeTree( $parent )
    {
        $token = trim( $this->getNextToken() );

        while( $token != "" && $token != "]" )
        {
            switch( $token[0] )
            {
            case "[":
                $token      = substr( $token, 1, strlen( $token ) - 1 );
                $spaceat    = strpos( $token, " " );

                $newparent  = -1;

                if( $spaceat != FALSE )
                {
                    $parts[0] = substr( $token, 0, $spaceat );
                    $parts[1] = substr( $token, $spaceat, strlen( $token ) - $spaceat );

                    $e = new CElement( $this->id++, $parent, $parts[0], $this->level );
                    $this->elist->Add( $e );
                    $newparent = $e->id;
                    $this->countNode( $parts[0] );

                    $e = new CElement( $this->id++, $this->id - 2, $parts[1], $this->level + 1 );
                    $this->elist->Add( $e );
                } else {
                    $e = new CElement( $this->id++, $parent, $token, $this->level );
                    $newparent = $e->id;
                    $this->elist->Add( $e );
                    $this->countNode( $token );
                }

                $this->level++;
                $this->makeTree( $newparent );
                break;

            default:
                if ( trim( $token ) > "" )
                {
                    $e = new CElement( $this->id++, $parent, $token, $this->level );
                    $this->elist->Add( $e );
                    $this->countNode( $token );
                }
                break;
            }

            $token = $this->getNextToken();
        }

        $this->level--;
    }
}


define( 'E_WIDTH',  600 );   // Element width
define( 'E_PADD',    50 );   // Element height padding
define( 'V_SPACE',  40 );
define( 'H_SPACE',  200 );
define( 'B_SIDE',    150 );
define( 'B_TOPBOT',  70 );
define( 'L_VOFFSET',  20 );

class CTreeGraph
{
    // ----------------------------------------------------------------------
    // PUBLIC FUNCTIONS
    // ----------------------------------------------------------------------
    
    // Constructor
    function CTreeGraph( 
         &$e_list_ref
        ,$color=TRUE
		,$antialias=TRUE
		,$triangles=TRUE
        ,$font="Vera.ttf"
		,$fontsize=8 )
    {
        // Store parameters
        
        $this->e_list    = $e_list_ref;
        $this->font      = 'arial.ttf';//$font;
        $this->font_size = 14;
        $this->antialias = $antialias;
        $this->triangles = $triangles;
        
        // Calculate image dimensions
        
        $this->e_height = $this->font_size + E_PADD*2;
        $h = $e_list_ref->GetLevelHeight();

        $w = $this->calcLevelWidth( 0 );
        
        // $e = $e_list_ref->GetFirst();
        // $this->CalcElementWidth( $e );

        $w_px = $w + B_SIDE * 2;
        $h_px = $h * $this->e_height + ($h-1) * (V_SPACE + $fontsize) + B_TOPBOT ;

        $this->height    = $h_px;
        $this->width     = $w_px;

        // Initialize the image and colors
        
        $this->im = imagecreate( $w_px, $h_px );
		
	

        $this->col_bg   = imagecolorallocate( $this->im, 255, 255, 255 );
        $this->col_fg   = imagecolorallocate( $this->im,   0,   0,   0 );
        $this->col_line = imagecolorallocate( $this->im,  64,  64,  64 );        
        
   
        $this->col_node  = imagecolorallocate( $this->im,   0,   0,   0 );
        $this->col_leaf  = imagecolorallocate( $this->im,   0,   0,   0 );
        $this->col_trace = imagecolorallocate( $this->im,   0,   0,   0 );
		
		$this->linetop = imageline ($this->im,0,0,$this->width,0,$this->col_fg);
		$this->lineright = imageline ($this->im,0,0,0,$this->height,$this->col_fg);
		$this->linebottom = imageline ($this->im,0,$this->height-1,$this->width,$this->height-1,$this->col_fg);
		$this->lineleft = imageline ($this->im,$this->width-1,$this->height-1,$this->width-1,0,$this->col_fg);
		$this->title = imagettftext($this->im, 14, 0, 10, 30, $this->col_fg, $this->font, 'Actor Inheritance Diagram');
   

   
    }

    function Draw()
    {
        $this->parseList();
        imagepng( $this->im );
    }

    function Save( $filename )
    {
        $this->parseList();
        imagepng( $this->im, $filename );
    }
    
    // ----------------------------------------------------------------------
    // PRIVATE FUNCTIONS
    // ----------------------------------------------------------------------

    // Add the element into the tree (draw it)
    function drawElement( $x, $y, $w, $string, $type )
    {
        // Calculate element dimensions and position
        $actorimage = imagecreatefrompng("actor.png");
        $top    = $this->row2Px( $y );
        $left   = $x + B_SIDE;
        $bottom = $top  + $this->e_height;
        $right  = $left + $w;

        // Draw element frame (for debugging)

        if ( isset( $_GET['frame'] ) )
        {
            imageline( $this->im, $left,  $top,    $right, $top,    $this->col_line );
            imageline( $this->im, $left,  $bottom, $right, $bottom, $this->col_line );
            imageline( $this->im, $left,  $top,    $left,  $bottom, $this->col_line );
            imageline( $this->im, $right, $top,    $right, $bottom, $this->col_line );
        }

        // Split the string into the main part and the 
        //   subscript part of the element (if any)
        
        $main   = $string;
        $sub    = "";

        $sub_size = floor( $this->font_size * 0.7 );

        $parts = explode( "_", $string, 2 );
        if ( count( $parts ) > 1 )
        {
            $main = $parts[0];
            $sub  = str_replace( "_", " ", $parts[1] );
        } 
        
        // Calculate text size for the main and the 
        //   subscript part of the element
        
        $main_width = ImgGetTxtWidth( $main, $this->font, $this->font_size );
        $sub_width  = 0;//ImgGetTxtWidth( $sub,  $this->font, $sub_size );

        // Center text in the element

        $txt_width = $main_width + $sub_width;
        $txt_pos   = $left +25+ ($right - $left) / 2 - $txt_width / 2;

        // Select apropriate color
        
        $col = $this->col_node;
        if ( ETYPE_LEAF == $type )
            $col = $this->col_leaf;

        if ( substr( $main, 0, 1 ) == "<"
            && substr( $main, strlen( $main ) - 1, 1 ) == ">" )
            $col = $this->col_trace;

        // Draw stick man
		
		imagecopyresized($this->im, $actorimage, $txt_pos+($txt_width/2)-40, $top+$this->e_height-E_PADD-80, 0, 0, 30, 70,230,460);
        
	        // Draw main text	
		imagettftext( $this->im, $this->font_size, 0, $txt_pos
            , $top+$this->e_height-E_PADD, $col, $this->font, $main );
        
        // Draw subscript text

        
    }

    // Draw a line between child/parent elements
    function linetoParent( $fromX, $fromY, $fromW, $toX, $toW )
    {
        if ( $fromY == 0 )
            return;

        $fromTop  = $this->row2Px( $fromY );
        $fromLeft = $fromX + $fromW / 2 + B_SIDE;

        $toBot    = $this->row2Px( $fromY-1 ) + $this->e_height;
        $toLeft   = $toX + $toW / 2 + B_SIDE;

        if ( $this->antialias )
            imagesmoothline( 
                $this->im, $fromLeft, $fromTop, $toLeft, $toBot, $this->col_line );
        else
            imageline( 
                $this->im, $fromLeft, $fromTop-L_VOFFSET, $toLeft, $toBot-L_VOFFSET, $this->col_line );
    }


    // If a node element text is wider than the sum of it's
    //   child elements, then the child elements need to
    //   be resized to even out the space. This function
    //   recurses down the a child tree and sizes the
    //   children appropriately.
    function fixChildSize( $id, $current, $target )
    {
        $e_list = &$this->e_list;
        $children = $e_list->GetChildren( $id );

        $e_list->SetElementWidth( $id, $target );

        if ( count( $children ) > 0 ) 
        {
            $delta = $target - $current;
            $target_delta = $delta / count( $children ); 

            foreach( $children as $child )
            {
                $child_width = $e_list->GetElementWidth( $child );
                $this->fixChildSize( $child, $child_width, $child_width + $target_delta );
            }
        }
    }

    // Calculate the width of the element. If the element is
    //   a node, the calculation will be performed recursively
    //   for all child elements.
    function calcElementWidth( &$e )
    {
        $w = 0;
        $e_list = &$this->e_list;
        
        $children = $e_list->GetChildren( $e->id );

        if ( count( $children ) == 0 )
        {
            $w = ImgGetTxtWidth( $e->content, $this->font, $this->font_size ) + $this->font_size;
        } else {
            foreach( $children as $child )
            {
                $child_e = $e_list->GetID( $child );
                $w += $this->calcElementWidth( $child_e );
            }

            $tw = ImgGetTxtWidth( $e->content, $this->font, $this->font_size ) + $this->font_size;
            if ( $tw > $w )
            {
                $this->fixChildSize( $e->id, $w, $tw );
                $w = $tw;
            }
        }

        $e_list->SetElementWidth( $e->id, $w );

        return $w;
    }

    // Calculate the width of all elements in a certain level
    function calcLevelWidth( $l )
    {
        $w = 0;
        $e_list = &$this->e_list;

        $e = $e_list->GetFirst();

        while( NULL != $e )
        {
            if ( $e->level == $l )
                $w += $this->CalcElementWidth( $e );

            $e = $e_list->GetNext();
        }

        return $w;
    }

    // Parse the elements in the list top to bottom and
    //   draw the elements into the image.
    //   As we it iterate through the levels, the element
    //   indentation is calculated.
    function parseList()
    {
        $e_list = &$this->e_list;

        // Calc element list recursively.... 

        $e_arr = $e_list->GetElements();
        
        $h = $e_list->GetLevelHeight();

        for( $i=0; $i<$h; $i++ )
        {
            $x = 0;
            
            for( $j=0; $j<count( $e_arr ); $j++ )
            {
                if ( $e_arr[$j]->level == $i )
                {
                    $cw = $e_list->GetElementWidth( $e_arr[$j]->id );
                    $parent_indent = $e_list->GetIndent( $e_arr[$j]->parent );
                    
                    if ( $x <  $parent_indent )
                        $x = $parent_indent;
        
                    $e_list->SetIndent( $e_arr[$j]->id, $x );
        
                    $this->drawElement( $x, $i, $cw, $e_arr[$j]->content, $e_arr[$j]->type );
        
                    if ( $e_arr[$j]->parent != 0 )
                    {
                        // Draw a line to the parent element
                        // 
                        // If the parent element is on the same indentation
                        // level (i.e. the line would be straight), and the
                        // leaf contains more than one word, we draw a 
                        // triangle instead.
                        
                        $words = explode( ' ', $e_arr[$j]->content );

                        if (   $this->triangles == TRUE
                            && ETYPE_LEAF       == $e_arr[ $j ]->type 
                            && $x               == $parent_indent 
                            && count( $words )  > 1 )
                        {
                            $txt_width = ImgGetTxtWidth( $e_arr[ $j ]->content, $this->font, $this->font_size );
                            $this->triangletoParent(
                                $x, $i, $cw, $e_list->GetElementWidth( $e_arr[$j]->parent ), $txt_width
                            );
                        } else {
                            $this->linetoParent( 
                                $x, $i, $cw
                                , $e_list->GetIndent( $e_arr[$j]->parent )
                                , $e_list->GetElementWidth( $e_arr[$j]->parent ) 
                            );
                        }
                    }
        
                    $x += $cw;
                }
            }
        }
    }
    
    // Calculate top position from row (level)
    function row2Px( $row )
    {
        return ( B_TOPBOT + $this->e_height*$row + (V_SPACE + $this->font_size )*$row );
    }
};

function ImgGetTxtWidth( $text, $font, $font_size ) {
    $bbox  = imagettfbbox( $font_size, 0, $font, $text );
    $width = 
        ( ($bbox[0] > 0 && $bbox[2] > 0) || ($bbox[0] < 0 && $bbox[2] < 0) ) 
            ? abs( $bbox[2] - $bbox[0] ) 
            : ( abs( $bbox[2] ) + abs( $bbox[0] ) + 1 );

    return $width+50;
}

class TreeToImage {
    public function getImage($data) {
        $color     =  0;
        $triangles =  FALSE;
        $antialias =  0;
        $autosub   =  0;
        $font      =  'arial.ttf';
        $fontsize  =  12;
        $fontpath = '';
        try {
            $sp = new CStringParser( $data );
            $sp->Parse();
            $elist = $sp->GetElementList();
            $graph = new CTreegraph( $elist, $color, $antialias, $triangles, $fontpath . $font, $fontsize );
            $name = 'reqer_'.date('m-d-Y_hi');
            $src = 'tmp/'.$name.'.png';
            $graph->Save($src);
            return $src;
        } catch(Exception $e) {
            Yii::log($e->getMessage(), 'info', 'application');
        }
    }
}




