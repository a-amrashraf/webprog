
function validatePassword(){

    var passInput = document.getElementById("passInput").value;
    var numbers = document.getElementById("numbers");
    var lowercase = document.getElementById("lowercase");
    var uppercase = document.getElementById("uppercase");
    var specialchars = document.getElementById("specialchars");
    var charLen8 = document.getElementById("charLen8");

    var specialcharsList = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
    var lowercaseList = /[a-z]/;
    var uppercaseList = /[A-Z]/;
    var numbersList = /[0-9]/;

    if(passInput.match(numbersList)){
        numbers.classList.remove("invalid");
        numbers.classList.add("valid");
    }
    else{
        numbers.classList.remove("valid");
        numbers.classList.add("invalid");
    }
    if(passInput.match(lowercaseList)){
        lowercase.classList.remove("invalid");
        lowercase.classList.add("valid");
    }
    else{
        lowercase.classList.remove("valid");
        lowercase.classList.add("invalid");
    }
    if(passInput.match(uppercaseList)){
        uppercase.classList.remove("invalid");
        uppercase.classList.add("valid");
    }
    else{
        uppercase.classList.remove("valid");
        uppercase.classList.add("invalid");
    }
    if(passInput.match(specialcharsList)){
        specialchars.classList.remove("invalid");
        specialchars.classList.add("valid");
    }
    else{
        specialchars.classList.remove("valid");
        specialchars.classList.add("invalid");
    }
    if (passInput.length >= 8){
        charLen8.classList.remove("invalid");
        charLen8.classList.add("valid");
    }
    else {
        charLen8.classList.remove("valid");
        charLen8.classList.add("invalid");
    }
                                    
}

function toggleIcon(){
    var passInput = document.getElementById("passInput");
    var icon = document.getElementById("icon");
    icon.classList.toggle("fa-eye-slash");
    icon.classList.toggle("fa-eye");
    var className = icon.className;
    console.log(className);
    if(className.match("fa-eye"))
    {
        passInput.type = "password"; 
    }
    if(className.match("fa-eye-slash"))
    {
        passInput.type = "text";
    }
}

function submitPassword(){
    var numbers = document.getElementById("numbers");
    var lowercase = document.getElementById("lowercase");
    var uppercase = document.getElementById("uppercase");
    var specialchars = document.getElementById("specialchars");
    var charLen8 = document.getElementById("charLen8");

    var array = [numbers,lowercase,uppercase,specialchars,charLen8];
    var classLists = [];
    var flag = 1;
    for(var i = 0;i<5;i++)
    {
        classLists[i] = array[i].className;
        if(classLists[i] == "invalid")
        {
            window.alert("Password is invalid!");
            flag = 0;
            break;
        }
    } 
    
    if(flag == 1)
    {
        window.alert("Password is valid!");
    }
}