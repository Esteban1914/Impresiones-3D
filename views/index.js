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


function copiarAlPortapapeles() {
    navigator.clipboard.writeText(document.getElementById("texto-copiable").innerText);
}

var timer,timer_1;
var disabled_username=true;
var disabled_password=true;
var disabled_password_last=true;
//var disabled_email=true;
// function canEnableButton()
// {
//     return disabled_username||disabled_password;
//}
function canEnableButtonPass()
{
    return disabled_password_last||disabled_password;
}

// function findUserNameExist()
// {
//     document.getElementById("inputusername").className="form-control ";
//     document.getElementById("spiner_loaduser").className="d-block spinner-border";
//     document.getElementById("btnRegister").disabled=true;
//     clearTimeout(timer);
//     if(document.getElementById("inputusername").value==="")
//     {
//         document.getElementById("spiner_loaduser").className="d-none spinner-border";
//         return
//     }
//     timer=setTimeout(()=>{
        
//         fetch('./includes/ajax.php', {
//         method: 'POST',
//         headers: {
//         'Content-Type': 'application/json',
//         },
//         body: JSON.stringify({"action":"findUser", "username": document.getElementById("inputusername").value}),
//         })
//         .then(response => response.json())
//         .then(data => {
//             if(data.result==false)
//             {
//                 document.getElementById("inputusername").className="form-control is-valid";
//                 document.getElementById("spiner_loaduser").className="d-none spinner-border";
//                 disabled_username=false;
//                 document.getElementById("btnRegister").disabled=canEnableButton();  
//             }
//             else
//             {
//                 document.getElementById("inputusername").className="form-control is-invalid";
//                 document.getElementById("spiner_loaduser").className="d-none spinner-border";
//                 document.getElementById("btnRegister").disabled=true;
//                 disabled_username=true;
//             }
            

//         })
//         .catch(error => console.log("error:",error));
//     },1000);
// }

// function confirmPasswords()
// {
//     if(document.getElementById("inputpassword").value !="" && document.getElementById("inputpassword").value === document.getElementById("inputconfirmpassword").value)
//     {
//         document.getElementById("inputpassword").className="form-control is-valid";
//         document.getElementById("inputconfirmpassword").className="form-control is-valid";
//         disabled_password=false;
//         document.getElementById("btnRegister").disabled=canEnableButton();
//     }
//     else
//     {
//         if (document.getElementById("inputpassword").value==="" && document.getElementById("inputconfirmpassword").value==="")
//         {
//             document.getElementById("inputpassword").className="form-control";
//             document.getElementById("inputconfirmpassword").className="form-control";
//         }
//         else
//         {
//             document.getElementById("inputpassword").className="form-control is-invalid";
//             document.getElementById("inputconfirmpassword").className="form-control is-invalid";
//         }
//         document.getElementById("btnRegister").disabled=true;
//         disabled_password=true;
//     }
    
// }

function confirmPasswordsEdit()
{
    if(document.getElementById("inputpassword").value !="" && document.getElementById("inputpassword").value === document.getElementById("inputconfirmpassword").value)
    {
        document.getElementById("inputpassword").className="form-control is-valid";
        document.getElementById("inputconfirmpassword").className="form-control is-valid";
        disabled_password=false;
        document.getElementById("btnRegister").disabled=canEnableButtonPass();
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
function findUserNameExistEdit()
{
    document.getElementById("inputusername").className="form-control ";
    document.getElementById("spiner_loaduser_1").className="d-block spinner-border";
    document.getElementById("btnRegister_1").disabled=true;
    clearTimeout(timer);
    if(document.getElementById("inputusername").value==="")
    {
        document.getElementById("spiner_loaduser_1").className="d-none spinner-border";
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
                document.getElementById("spiner_loaduser_1").className="d-none spinner-border";
                document.getElementById("btnRegister_1").disabled=false;  
            }
            else
            {
                document.getElementById("inputusername").className="form-control is-invalid";
                document.getElementById("spiner_loaduser_1").className="d-none spinner-border";
                document.getElementById("btnRegister_1").disabled=true;
            }
            

        })
        .catch(error => console.log("error:",error));
    },1000);
}

function findPassWrodExistEdit()
{
    document.getElementById("inputlastpassword").className="form-control ";
    document.getElementById("spiner_loaduser").className="d-block spinner-border";
    document.getElementById("btnRegister").disabled=true;
    clearTimeout(timer_1);
    if(document.getElementById("inputlastpassword").value==="")
    {
        document.getElementById("spiner_loaduser").className="d-none spinner-border";
        return
    }
    timer_1=setTimeout(()=>{
        
        fetch('./includes/ajax.php', {
        method: 'POST',
        headers: {
        'Content-Type': 'application/json',
        },
        body: JSON.stringify({"action":"findPassword", "password": document.getElementById("inputlastpassword").value}),
        })
        .then(response => response.json())
        .then(data => {
            if(data.result==true)
            {
                document.getElementById("inputlastpassword").className="form-control is-valid";
                document.getElementById("spiner_loaduser").className="d-none spinner-border";
                disabled_password_last=false;
                document.getElementById("btnRegister").disabled=canEnableButtonPass();  
            }
            else
            {
                document.getElementById("inputlastpassword").className="form-control is-invalid";
                document.getElementById("spiner_loaduser").className="d-none spinner-border";
                document.getElementById("btnRegister").disabled=true;
                disabled_password_last=true;
            }
            

        })
        .catch(error => console.log("error:",error));
    },1000);
}

