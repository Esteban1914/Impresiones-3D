const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
// const popover = new bootstrap.Popover('.popover-dismiss', {trigger: 'focus'})
  

document.addEventListener('DOMContentLoaded', function() {
    Array.from(document.getElementsByClassName("opacity-translation")).forEach(function(element) 
    {
        element.style.opacity = 1;
    }
    );
});

function RemoveError()
{
    document.getElementById("usernameinput").className="form-control";
    document.getElementById("passwordinput").className="form-control";
   
    document.getElementById("usernameinput").removeEventListener("input",()=>{});
    document.getElementById("passwordinput").removeEventListener("input",()=>{});
    
}

// function Arroba() {
//     var input=document.getElementById("Arroba_ID");
//     if (!input.value.includes("@")) {
//         input.value = "@" + input.value;
//     }
// }

function copiarAlPortapapeles() {
    navigator.clipboard.writeText(document.getElementById("texto-copiable").innerText);
}

var timer;
var disabled_username=true;
var disabled_password=true;
//var disabled_email=true;
function canEnableButton()
{
    return disabled_username||disabled_password;
}
function findUserNameExist()
{
    document.getElementById("inputusername").className="form-control ";
    document.getElementById("spiner_loaduser").className="d-block spinner-border";
    document.getElementById("btnRegister").disabled=false;
    console.log("A")
    clearTimeout(timer);
    if(document.getElementById("inputusername").value==="")
    {
        document.getElementById("spiner_loaduser").className="d-none spinner-border";
        return
    }
    timer=setTimeout(()=>{
        
        fetch('./includes/ajax.php', {
        method: 'POST',
        headers: {
        'Content-Type': 'application/json',
        },
        body: JSON.stringify({"action":"findUser", "username": document.getElementById("inputusername").value}),
        })
        .then(response => response.json())
        .then(data => {
            if(data.result==false)
            {
                document.getElementById("inputusername").className="form-control is-valid";
                document.getElementById("spiner_loaduser").className="d-none spinner-border";
                disabled_username=false;
                document.getElementById("btnRegister").disabled=canEnableButton();  
            }
            else
            {
                document.getElementById("inputusername").className="form-control is-invalid";
                document.getElementById("spiner_loaduser").className="d-none spinner-border";
                document.getElementById("btnRegister").disabled=true;
                disabled_username=true;
            }
            

        })
        .catch(error => console.log("error:",error));
    },1000);
}

function confirmPasswords()
{
    if(document.getElementById("inputpassword").value !="" && document.getElementById("inputpassword").value === document.getElementById("inputconfirmpassword").value)
    {
        document.getElementById("inputpassword").className="form-control is-valid";
        document.getElementById("inputconfirmpassword").className="form-control is-valid";
        disabled_password=false;
        document.getElementById("btnRegister").disabled=canEnableButton();
    }
    else
    {
        if (document.getElementById("inputpassword").value==="" && document.getElementById("inputconfirmpassword").value==="")
        {
            document.getElementById("inputpassword").className="form-control";
            document.getElementById("inputconfirmpassword").className="form-control";
        }
        else
        {
            document.getElementById("inputpassword").className="form-control is-invalid";
            document.getElementById("inputconfirmpassword").className="form-control is-invalid";
        }
        document.getElementById("btnRegister").disabled=true;
        disabled_password=true;
    }
    
}
function validarCorreo(correo) {
    
}
// function validateEmail()
// {
//     let regex = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
//     if(regex.test(document.getElementById("inputemail").value))
//     {
//         document.getElementById("inputemail").className="form-control is-valid";
//         disabled_email=false;
//         document.getElementById("btnRegister").disabled=canEnableButton();
//     }
//     else
//     {
//         document.getElementById("inputemail").className="form-control is-invalid";
//         disabled_email=true;
//         document.getElementById("btnRegister").disabled=true;
//     }
// }
   