var tbody=document.getElementById("tbody");
function fetchRequests(){
    console.log("function called");
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
             var mail=jsonObj[i].email;
var inner=document.createElement("tr");
var acceptButton="<button id='"+reQId+"' name='"+mail+"' onClick='acceptRequest(this.id, this.name);' class='m-2 btn btn-success'>Accept</button>";
var rejectButton="<button id='"+reQId+"' name='"+mail+"'  onClick='rejectRequest(this.id, this.name);' class='m-2 btn btn-primary'>Reject</button>";
var deleteButton="<button id='"+reQId+"' name='"+mail+"'  onClick='deleteRequest(this.id, this.name);' class='m-2 btn btn-danger'>Delete</button></td>";

var buttonsPart=acceptButton+rejectButton+deleteButton;
var innerH="<td>"+reQId+"</td><td>"+date+"</td><td>"+units+"</td><td>"+bGroup+"</td><td>"+status+"</td><td class='text-center'>";
innerH=innerH+buttonsPart;
inner.innerHTML=innerH;
tbody.appendChild(inner);

            }
            }catch( e){
console.log(e.message)
            }

            
        }
    })
}

function fetchUsers(){
    //console.log("function called");
    $.ajax({
        url:"get_users.php",
        method:"POST",
        success: function(data){
            console.log(data);
            if(data=="You need to log in First"){
                window.location.replace("sign_in.php");
                return;
            }
            if(data=="No Users Available"){
                alert(data);
                window.location.reload();
                return;
            }
            try{
            var jsonObj=JSON.parse(data);
            for(var i=0;i<jsonObj.length;i++){
             var bGroup=jsonObj[i].group;
             var userId=jsonObj[i].userId;
             var location=jsonObj[i].location;
             var age=jsonObj[i].age;
             var name=jsonObj[i].name;
             var mail=jsonObj[i].email;
             var phone=jsonObj[i].phone;
var inner=document.createElement("tr");
var deleteButton="<button id='"+userId+"' name='"+mail+"' onClick='deleteUser(this.id, this.name);' class='m-2 btn btn-danger'>Delete</button>";
var emailButton="<button id='"+userId+"' name='"+mail+"'  onClick='emailUser(this.id, this.name);' class='m-2 btn btn-primary'>Email</button></td>";

var buttonsPart=deleteButton+emailButton;
var innerH="<td>"+userId+"</td><td>"+name+"</td><td>"+mail+"</td><td>"+phone+"</td><td>"+bGroup+"</td><td>"+age+"</td><td>"+location+"</td><td class='text-center'>";
innerH=innerH+buttonsPart;
inner.innerHTML=innerH;
tbody.appendChild(inner);

            }
            }catch( e){
console.log(e.message)
            }

            
        }
    })
}

function manageUsers(){
    window.location.replace("manage_users.html");
}
function acceptRequest(id,email){
    $.ajax({
        url:"requests.php",
        method:"POST",
        data:{"id":id,"email":email,"mode":"accept"},
        success:function(data){
            if(data=="You need to log in First"){
                alert(data+" You may need to clear browsing data first");
                window.location.replace("sign_in.php");
                return;
            }
alert(data);
window.location.reload();
        }
    });
}

function rejectRequest(id,email){
    $.ajax({
        url:"requests.php",
        method:"POST",
        data:{"id":id,"email":email,"mode":"reject"},
        success:function(data){
            if(data=="You need to log in First"){
                alert(data+" You may need to clear browsing data first");
                window.location.replace("sign_in.php");
                return;
            }
alert(data);
window.location.reload();
        }
    });
}

function deleteRequest(id,email){
    $.ajax({
        url:"requests.php",
        method:"POST",
        data:{"id":id,"email":email,"mode":"delete"},
        success:function(data){
            if(data=="You need to log in First"){
                alert(data+" You may need to clear browsing data first");
                window.location.replace("sign_in.php");
                return;
            }
alert(data);
window.location.reload();
        }
    });
}
function manageRequests(){
    window.location.replace("manage_requests.html");
}

function emailUser(id,email){
    $message=prompt("Input The Message to Send to "+email);
    $.ajax({
        url:"requests.php",
        method:"POST",
        data:{"id":id,"email":email,"mode":"emailUser","message":$message},
        success:function(data){
            if(data=="You need to log in First"){
                alert(data+" You may need to clear browsing data first");
                window.location.replace("sign_in.php");
                return;
            }
alert(data);
window.location.reload();
        }
    });
}
function deleteUser(id,email){
    $.ajax({
        url:"requests.php",
        method:"POST",
        data:{"id":id,"email":email,"mode":"deleteUser"},
        success:function(data){
            if(data=="You need to log in First"){
                alert(data+" You may need to clear browsing data first");
                window.location.replace("sign_in.php");
                return;
            }
alert(data);
window.location.reload();
        }
    });
}

function donateBlood(){
    window.location.replace("blood_donation.html");
}

var donationForm=document.getElementById("donForm");
var donationText=document.getElementById("donEmail");
var inputEmail=document.getElementById("inputEmail");

function checkDonationHistory(){
    $email=prompt("Input Donating User's Email Address");

    $.ajax({
        url:"verify.php",
        method:"POST",
        data:{"email":$email},
        success:function(data){
            console.log(data);
            if(data.trim()=="Success"){
donationText.innerHTML=$email;
inputEmail.value=$email;
donationForm.style.display="block";
            }else{
                alert(data.trim());
            }
        }
    })
}