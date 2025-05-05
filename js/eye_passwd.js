    let passwordInput = document.querySelector('.password'); 
    document.querySelector(".eye_pass").addEventListener("click",()=>{
        if(passwordInput.type=="password"){
            passwordInput.type = "text";
        }else{
            passwordInput.type = "password";
        }
    });
    var element = document.getElementById("myElement");
    if (element.classList.contains("re-password")) {
        let passwordInput1 = document.querySelector('.re-password');
        document.querySelector(".eye_re-pass").addEventListener("click",()=>{
        if(passwordInput1.type=="password"){
            passwordInput1.type = "text";
        }else{
            passwordInput1.type = "password";
        }
    });
    }
    
    
   
    

