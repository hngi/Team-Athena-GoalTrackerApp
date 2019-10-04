//clearing out default text of message box on focus
let msgContent = document.querySelector("#msg");
msgContent.addEventListener("focus", function(e){
    e.target.textContent="";
});
//name validation
let nameInput = document.querySelector("#name");
let nameMsg = document.querySelector("#name~p");
nameInput.addEventListener("keyup", function(e){
    let namePattern = /\b[^\d\t\s]{4,}( [^\d\t\s]+)?\.?$/i;
    let namePatternResult = namePattern.test(nameInput.value);
    if (e.target.value.length <= 3){
        nameMsg.textContent = "Your input must have at least four characters";
        nameMsg.classList.add("text-danger");
        nameMsg.style.display = "block";
    }
    else if (namePatternResult == false){
        nameMsg.textContent = "Your input must not contain any digit or special character";
        nameMsg.classList.add("text-danger");
        nameMsg.style.display = "block";
    }
    else{
        nameMsg.style.display = "block";
        nameMsg.textContent = "Correct Input Format";
        nameMsg.classList.remove("text-danger");
        nameMsg.classList.add("text-white");
    }
});
nameInput.addEventListener("blur", function(e){
    if (e.target.value == ""){
        nameMsg.style.display = "none";
    }
});
//E-mail validation
let emailInput = document.querySelector("#email");
let emailMsg = document.querySelector("#email~p");
emailInput.addEventListener("keyup", function(e){
    let emailPattern = /\b\w+@{1}\w+\.{1}([^.\d\t\s]{2,3})/i;
    let emailPatternResult = emailPattern.test(emailInput.value);
    if (emailPatternResult == false){
        emailMsg.textContent = "Your input is not in the correct format for a standard email address";
        emailMsg.classList.add("text-danger");
        emailMsg.style.display = "block";
    }
    else{
        emailMsg.style.display = "block";
        emailMsg.textContent = "Correct Input Format";
        emailMsg.classList.remove("text-danger");
        emailMsg.classList.add("text-white");
    }
}); 
emailInput.addEventListener("blur", function(e){
    if (e.target.value == ""){
        emailMsg.style.display = "none";
    }
}); 

//Message validation
let msgError = document.querySelector("#msg~p");
msgContent.addEventListener("keyup", function(e){
    let msgPattern = /(\w+( \w+)*n*){20,}/i;
    let msgPatternResult = msgPattern.test(msgContent.value);
    if (e.target.value.length < 20){
        msgError.textContent = "Your input must have a minimum of 20 characters";
        msgError.classList.add("text-danger");
        msgError.style.display = "block";
    }
    else if (msgPatternResult == false){
        msgError.textContent = "Your input is not in the correct format";
        msgError.classList.add("text-danger");
        msgError.style.display = "block";
    }
    else{
        msgError.style.display = "block";
        msgError.textContent = "Correct Input Format";
        msgError.classList.remove("text-danger");
        msgError.classList.add("text-white");
    }
}); 
msgContent.addEventListener("blur", function(e){
    if (e.target.value == ""){
        msgError.style.display = "none";
    }
});
