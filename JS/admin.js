function ShowConfirmation(string,id)
{
    var c = confirm("Are you sure you wish to delete this?");
    
    if(c) window.location = string + ".php?delete=" + id;
}

function ChangeImage(newimg)
{
    document.getElementById('image-thumbnail').src = "Images/" + newimg;
}