function ShowConfirmation(id)
{
    var c = confirm("Are you sure you wish to delete this?")
    
    if(c) window.location = "itemoverview.php?delete=" + id;
    
}


