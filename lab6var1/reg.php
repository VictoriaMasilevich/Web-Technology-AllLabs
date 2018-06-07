 <?php
 
    require_once 'class.include.php';
 
    $Veiw = new Include_template;

 
    $Veiw->SetTemplate('shabl.html');

    $ContentTemplate = file_get_contents('menu1.html');
    $Veiw->AssignArr('Menu', $ContentTemplate);    
    $ContentTemplate = file_get_contents('1.html');
    $Veiw->AssignArr('Form', $ContentTemplate); 
	
    $Veiw->Display();
 
 
 ?>