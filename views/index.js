function RemoveError()
{
    document.getElementById("usernameinput").className="text-center form-control";
    document.getElementById("passwordinput").className="text-center form-control";
   
    document.getElementById("usernameinput").removeEventListener("input",()=>{});
    document.getElementById("passwordinput").removeEventListener("input",()=>{});
    
}
document.addEventListener('DOMContentLoaded', function() {
    Array.from(document.getElementsByClassName("opacity-translation")).forEach(function(element) 
    {
        element.style.opacity = 1;
    }
    );
});
