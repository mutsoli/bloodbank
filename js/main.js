function noBackGround(form){
    form.style.backgroundColor=none;
}

var userNameHelper=document.getElementById("userHelp");
var phoneHelper=document.getElementById("phoneHelp");
var ageHelper=document.getElementById("ageHelp");
var bloodHelper=document.getElementById("bloodHelp");
var mailHelper=document.getElementById("emailHelp");
var locationHelper=document.getElementById("locHelp");
var passHelper=document.getElementById("passHelp");

var isValid=false;

function validateName(nameInput){
    var name=nameInput.value;
    if(name.includes("@") || name.includes("#") || name.includes("%") || name.length<4 || typeof name !="string"){
        isValid=false;
        userNameHelper.style.display="block";
        return;
    }
    isValid=true;
    userNameHelper.style.display="none";
    
}

function validateAge(ageInput){
    var age=ageInput.value;
    if(parseInt(age)<12 || parseInt(age)>65){
        isValid=false;
        ageHelper.style.display="block";
        return;
    }
    isValid=true;
    ageHelper.style.display="none";
    
}

function validatePhone(phoneInput){
    var phone=phoneInput.value;
    if(phone.length<10){
        isValid=false;
        phoneHelper.style.display="block";
        return;
    }
    isValid=true;
    phoneHelper.style.display="none";
    
}

function validateGroup(groupInput){
    var group=groupInput.value;
    if(group.includes("Select")){
        isValid=false;
        bloodHelper.style.display="block";
        return;
    }
    isValid=true;
    bloodHelper.style.display="none";
    
}

function validateEmail(emailInput){
    var email=emailInput.value;
    if(!email.includes("@") || !email.includes(".") || email.length<6 || typeof email !="string"){
        isValid=false;
        mailHelper.style.display="block";
        return;
    }
    isValid=true;
    mailHelper.style.display="none";
    
}

function validatePassword(passInput){
    var pass=passInput.value;
    if( pass.length<6 || typeof pass !="string"){
        isValid=false;
        passHelper.style.display="block";
        return;
    }
    isValid=true;
    passHelper.style.display="none";
    
}

function validateCounty(countyInput){
    var county=countyInput.value;
    if(county.includes("Select")){
        isValid=false;
        locationHelper.style.display="block";
        return;
    }
    isValid=true;
    locationHelper.style.display="none";
    
}

function isSignUpValid(){
    return isValid;
}

