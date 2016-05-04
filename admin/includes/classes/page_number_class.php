<?php 

    /*
     *  Author:     Jarrod Oberto
     *  Date:       21-04-08
     *  Class name: page_number_class.php
     *  Purpose:    Pagination
     *  Requires:	Pagnation Style Sheet
     *  
     *  Modificatoin history
     *  Date      	Initials    Description
     *  08-09-08  	JCO			created addNextPrevious as a seperate function
     *							to split the code as it should be.
     *	09-09-08	JCO			Big modifications - You now have the ability for
     *							for 'smart' numbering. ie Display the first and
     *							last page plus the n amount of pages either side
     *							of the selected page.
     *
     */

class pageNumbers
{
    // *** Total number of items to load
    private $totalNumberOfItems;

    // *** The page we want to load
    private $newPageNumber=1;
   
    // *** The number of items to display
    private $numberOfItemsPerPage;

    // *** The total number of pages
    private $pageCount;

    // *** The range to limit query
    private $upperRange;
    private $lowerRange;


## --------------------------------------------------------

    function __construct($numberOfItemsPerPage, $totalNumberOfItems, $newPageNumber)
    {
        if(is_numeric($totalNumberOfItems))
        {
            $this->totalNumberOfItems = $totalNumberOfItems;
        }

        if(is_numeric($newPageNumber))
        {        
            $this->newPageNumber  = $newPageNumber;
        }

        if(is_numeric($numberOfItemsPerPage))
        {        
            $this->numberOfItemsPerPage  = $numberOfItemsPerPage;
        }
     
        $this->calculatePageCount();
        $this->calculateRange();
    }

## --------------------------------------------------------

    private function calculatePageCount()
    {
        $this->pageCount = ceil($this->totalNumberOfItems / $this->numberOfItemsPerPage);
    }

## --------------------------------------------------------

    private function calculateRange()
    {
        $this->lowerRange = ($this->newPageNumber * $this->numberOfItemsPerPage) - $this->numberOfItemsPerPage;
        $this->upperRange = ($this->numberOfItemsPerPage);
    }

## --------------------------------------------------------
  
    public function displayPageNumber($type=2, $manufacture='')
    {

		// *** PATH
		//$path = './';
		$class = '';

        // *** We only really need to display the page numbers if there is more than one page
        if ($this->pageCount > 1)
        {
            
            $numbers = '';
			
			switch ($type)
			{
				case '1':
					$numbers .= $this->pageDisplayType1($path, $class, $manufacture);
					break;
				case '2':
					$numbers .= $this->pageDisplayType2($path, $class, $manufacture);
					break;				
				case '4':
					$numbers .= $this->pageDisplayType4($path, $class);
					break;				
					
				default:
					# code...
					break;
			}
			
			if($type != 4)
			$numbers = $this->addNextPrevious($path, $numbers, $manufacture);
			else
			$numbers = $this->addNextPrevious4($path, $numbers);

            $numbers = '<ol class="pagination">' . $numbers  . '</ol>';

            return $numbers;
        }
    }
    
## --------------------------------------------------------

    public function getUpperRange()
    {
        return $this->upperRange;
    }

## --------------------------------------------------------

    public function getLowerRange()
    {
        return $this->lowerRange;
    }

## --------------------------------------------------------

	private function pageDisplayType1($path, $class, $manufacture='')
	/* 
	 *	This displays all page numbers with no breaks.
	 *	Suited for less than 10 pages, Not very good when dealing 
	 *	with lots of pages
	 */
	{
	
			$saveClass = $class;
	
            // *** Create page numbers and links
            for ($i=1; $i<= $this->pageCount; $i++)
            {
                if ($i == $this->newPageNumber)
                {
                    //$numbers .= '<span ' . $class .' >' . $i . '</span>' . ' - ';
					$class = "current";

                }
                else
                { 
                    //$numbers .= '<a href="' . $path . '?m='.$manufacture. '&p=' . $i . '">' . $i . '</a> - ';
                    $class = $saveClass;

                }

				$link = '<li><a class="' . $class . '" href="' . $path . '?applno='.$manufacture. '&p=' . $i . '">' . $i . '</a></li>';     
                $numbers .= $link;
            }

            // *** Remove the last '-' from the clause
            //$numbers = rtrim($numbers, ' - ');
            
            return $numbers;	
	}
	
## --------------------------------------------------------

	private function pageDisplayType2($path, $class, $manufacture='')
	/* 
	 *	This displays the first and last page plus the
	 *	n amount of pages either side of the selected page.
	 *	
	 */
	{
		
		#    		<- lead pages - current page - trail pages->
		# pages: 	   	    1 - 2 - 3 - 4 - 5 - 6 -7 - 8
		
		$padEachSide = 5;
		
		// *** Current selected page number
		$currentPage = $this->newPageNumber;
		// *** Start range
		$leadPage =  $currentPage - $padEachSide;
		// *** End range		
		$trailPage =  $currentPage + $padEachSide;

		// *** $padEachSide * 2 = Two sides, lets time ut by each side
		// *** +3 = Lets include current page, first page, last page
		// *** +2 = 
		$threashHold = ($padEachSide * 2) + 3;
				
		// *** Not worth doing if the page count is too small
		if ($this->pageCount <= ($threashHold)) {
			return $this->pageDisplayType1($path, $class, $manufacture);
			exit;
		}
		
			// *** Save the original class to revert back to after out 'current' class
			$classTemp = $class;
	
            // *** Create page numbers and links
            for ($i=1; $i<= $this->pageCount; $i++)
            {
            	
            	// *** This must be before $link. It sets the current selcted item
            	
            	if ($i == $currentPage) {
            		$class = "current";
            	} else {
            		$class = $classTemp;            	
            	}
            
            	$link = '<li><a class="' . $class . '" href="' . $path . '?applno='.$manufacture. '&p=' . $i . '">' . $i . '</a></li>';
            
				switch ($i)
				{
					// *** Include the first page
					case 1:
						$numbers .= $link;
						$lastPage = $i;
						break;
						

					case (($i >= $leadPage) && ($i < $currentPage)):
						$symbol = $this->checkLastProcessedPage($lastPage, $i);
						$numbers .= $symbol . $link;
						$lastPage = $i;
						break;		
						
					case $currentPage:
						$symbol = $this->checkLastProcessedPage($lastPage, $i);					
						$numbers .= $symbol . $link;
						$lastPage = $i;
						break;								
							
					case (($i > $currentPage) && ($i <= ($trailPage))):
					    $symbol = $this->checkLastProcessedPage($lastPage, $i);
						$numbers .= $symbol . $link;
						$lastPage = $i;
						break;	
						
					// *** Include the last page							
					case $this->pageCount:
						$symbol = $this->checkLastProcessedPage($lastPage, $i);
						$numbers .= $symbol . $link;
						break;

				}            

            }
		
            // *** Remove the last '-' from the clause
            //$numbers = rtrim($numbers, ' - ');
            
            return $numbers;	
          
	}
	
## --------------------------------------------------------

	private function pageDisplayType3($path, $class, $manufacture='')
	/* 
	 *	Same as (similar, now a bit older) pageDisplayType2 but not 
	 *	using list format
	 *	
	 *	
	 */
	{
		
		#    		<- lead pages - current page - trail pages->
		# pages: 	   	    1 - 2 - 3 - 4 - 5 - 6 -7 - 8
		
		$padEachSide = 5;
		
		// *** Current selected page number
		$currentPage = $this->newPageNumber;
		// *** Start range
		$leadPage =  $currentPage - $padEachSide;
		// *** End range		
		$trailPage =  $currentPage + $padEachSide;

		// *** $padEachSide * 2 = Two sides, lets time ut by each side
		// *** +3 = Lets include current page, first page, last page
		// *** +2 = 
		$threashHold = ($padEachSide * 2) + 3;
				
		// *** Not worth doing if the page count is too small
		if ($this->pageCount <= ($threashHold)) {
			return $this->pageDisplayType1($path, $class);
			exit;
		}
		
	
            // *** Create page numbers and links
            for ($i=1; $i<= $this->pageCount; $i++)
            {
            
            
				switch ($i)
				{
					// *** Include the first page
					case 1:
						$numbers .= '<a href="' . $path . '?applno='.$manufacture. '&p=' . $i . '">' . $i . '</a>';
						$lastPage = $i;
						break;
						

					case (($i >= $leadPage) && ($i < $currentPage)):
						$symbol = $this->checkLastProcessedPage($lastPage, $i);
						$numbers .= $symbol . '<a href="' . $path . '?applno='.$manufacture.'&p=' . $i . '">' . $i . '</a>';
						$lastPage = $i;
						break;		
						
					case $currentPage:
						$symbol = $this->checkLastProcessedPage($lastPage, $i);					
						$numbers .= $symbol . '<a class="selected" href="' . $path . '?applno='.$manufacture. '&p=' . $i . '">' . $i . '</a>';
						$lastPage = $i;
						break;								
							
					case (($i > $currentPage) && ($i <= ($trailPage))):
					    $symbol = $this->checkLastProcessedPage($lastPage, $i);
						$numbers .= $symbol . '<a href="' . $path . '?applno='.$manufacture.'&p=' . $i . '">' . $i . '</a>';
						$lastPage = $i;
						break;	
						
					// *** Include the last page							
					case $this->pageCount:
						$symbol = $this->checkLastProcessedPage($lastPage, $i);
						$numbers .= $symbol . '<a href="' . $path . '?applno='.$manufacture. '&p=' . $i . '">' . $i . '</a>';
						break;

				}            

            }
		
            // *** Remove the last '-' from the clause
            $numbers = rtrim($numbers, ' - ');
            
            return $numbers;	
          
	}	
	
## --------------------------------------------------------    	


	private function pageDisplayType4($path, $class)
	/* 
	 *	This displays all page numbers with no breaks.
	 *	Suited for less than 10 pages, Not very good when dealing 
	 *	with lots of pages
	 */
	{
	
			$saveClass = $class;
	
            // *** Create page numbers and links
            for ($i=1; $i<= $this->pageCount; $i++)
            {
            
                if ($i == $this->newPageNumber)
                {
                    //$numbers .= '<span ' . $class .' >' . $i . '</span>' . ' - ';
					$class = "current";

                }
                else
                { 
                    //$numbers .= '<a href="' . $path . '?c=' . $this->totalNumberOfItems . '&p=' . $i . '">' . $i . '</a> - ';
                    $class = $saveClass;
                }

				$link = '<li><a class="' . $class . '" href="' . $path . '?id=' . $_GET['id'] . '&cat=' . $_GET['cat'] . '&p=' . $i . '">' . $i . '</a></li>';     
			       
                    $numbers .= $link;
            }

            // *** Remove the last '-' from the clause
            //$numbers = rtrim($numbers, ' - ');
            
            return $numbers;	
	}
	
## --------------------------------------------------------
	

	private function addNextPrevious($path, $numbers, $manufacture='')
	{
	
    /* 
	 *	Add some bells & whistles - by this I mean adding "<< Previous" and "Next >>" controls
	 *
	 */

    	// *** Next page
        $pageNext = $this->newPageNumber + 1;
        $textNext = 'Next &raquo;';

    	// *** Previous page
        $PagePrev = $this->newPageNumber - 1;
        $textPrev = '&laquo; Prev';    
	 	
	 	
		// *** If on the first page only add the 'next >>'
        if ($this->newPageNumber == 1)
        {
	 		$link = '<li><a class="' . $class . '" href="' . $path . '?applno='.$manufacture. '&p=' . $pageNext . '">' . $textNext . '</a></li>';            
            $numbers = $numbers . $link;  
        }
        else
		// *** If on the last page then only add the '<< previous'
        if ($this->newPageNumber == $this->pageCount)
        {            
            $link = '<li><a class="' . $class . '" href="' . $path . '?applno='.$manufacture. '&p=' . $PagePrev . '">' . $textPrev . '</a></li>';       
            $numbers = $link . $numbers;  
        }
		// *** Else if in between, add both 'next >>' and '<< previous'
        else
        {   
            $numbers = '<li><a class="' . $class . '" href="' . $path . '?applno='.$manufacture. '&p=' . $PagePrev .'">' . $textPrev . '</a></li>'
            			. $numbers .
                       '<li><a class="' . $class . '" href="' . $path . '?applno='.$manufacture.'&p=' . $pageNext .'">' . $textNext . '</a></li>';
                       
        } 
        
        return $numbers;
	
	}

## --------------------------------------------------------    	
	

	private function addNextPrevious4($path, $numbers)
	{
	
    /* 
	 *	Add some bells & whistles - by this I mean adding "<< Previous" and "Next >>" controls
	 *
	 */

    	// *** Next page
        $pageNext = $this->newPageNumber + 1;
        $textNext = 'Next &raquo;';

    	// *** Previous page
        $PagePrev = $this->newPageNumber - 1;
        $textPrev = '&laquo; Prev';    
	 	
	 	
		// *** If on the first page only add the 'next >>'
        if ($this->newPageNumber == 1)
        {
	 		$link = '<li><a class="' . $class . '" href="' . $path . '?id=' . $_GET['id'] . '&cat=' . $_GET['cat'] .  '&p=' . $pageNext . '">' . $textNext . '</a></li>';            
            $numbers = $numbers . $link;  
        }
        else
		// *** If on the last page then only add the '<< previous'
        if ($this->newPageNumber == $this->pageCount)
        {            
            $link = '<li><a class="' . $class . '" href="' . $path . '?id=' . $_GET['id'] . '&cat=' . $_GET['cat'] . '&p=' . $PagePrev . '">' . $textPrev . '</a></li>';       
            $numbers = $link . $numbers;  
        }
		// *** Else if in between, add both 'next >>' and '<< previous'
        else
        {   
            $numbers = '<li><a class="' . $class . '" href="' . $path . '?id=' . $_GET['id'] . '&cat=' . $_GET['cat'] . '&p=' . $PagePrev .'">' . $textPrev . '</a></li>'
            			. $numbers .
                       '<li><a class="' . $class . '" href="' . $path . '?id=' . $_GET['id'] . '&cat=' . $_GET['cat'] . '&p=' . $pageNext .'">' . $textNext . '</a></li>';
                       
        } 
        
        return $numbers;
	
	}

## --------------------------------------------------------

	private function checkLastProcessedPage($previousI, $currentI)
	{
		if (($previousI + 1) == $currentI) {
			return '';
		} else {
			return ' ... '; 
		}
	}
	
## --------------------------------------------------------
}





?>
