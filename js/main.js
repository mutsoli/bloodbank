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
var formStatus=document.getElementById("form-status");
var searchDiv=document.getElementById("searchResult");
var resultText=document.getElementById("resultText");
var groupInput=document.getElementById("group");
var progressView=document.getElementById("progressBar");


var isValid=false;

function validateName(nameInput){
    var name=nameInput.value;

    if(name.includes("@") || name.includes("#") || name.includes("!") || name.includes("$") || name.includes("*") ||name.includes("^") ||name.includes("%") || name.length<4 || typeof name !="string"){
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
    if(!isValid){
formStatus.style.display="block"
    }
    return isValid;
}

function isValidSearchForm(){
    if(!isValid){
        formStatus.style.display="block"
    }
    return isValid;
}

function isValidRequestForm(){
    if(!isValid){
        formStatus.style.display="block"
    }
    return isValid;
}

function searchForBlood(){
  progressView.style.display="block";  
var optionName=groupInput.value;
$.ajax({
    url:"search.php",
    method:"POST",
    data:{"group":optionName},
    success:function(data){
        progressView.style.display="none";
        resultText.innerHTML=data;
        searchDiv.style.display="block";
    }
})

}

var tbody=document.getElementById("tbody");
function fetchRequests(){
    $.ajax({
        url:"get_requests.php",
        method:"POST",
        success: function(data){
            console.log(data);
            if(data=="You need to log in First"){
                window.location.replace("sign_in.php");
                return;
            }
            if(data=="No Requests Available"){
                alert(data);
                window.location.reload();
                return;
            }
            try{
            var jsonObj=JSON.parse(data);
            for(var i=0;i<jsonObj.length;i++){
             var bGroup=jsonObj[i].group;
             var reQId=jsonObj[i].reqId;
             var units=jsonObj[i].units;
             var date=jsonObj[i].date;
             var status=jsonObj[i].status;
var inner=document.createElement("tr");
var innerH="<td>"+reQId+"</td><td>"+date+"</td><td>"+units+"</td><td>"+bGroup+"</td><td>"+status+"</td>";
inner.innerHTML=innerH;
tbody.appendChild(inner);

            }
            }catch( e){
console.log(e.message)
            }

            
        }
    })
}
