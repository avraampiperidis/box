/**
 * Created by abraham on 21/10/2015.
 */


var showtablestatus = 0;

function gotomainpage() {
    window.location.href = "index.php";
}

function logOut() {
    $.ajax({
        url: 'logout.php?argument=logOut',
        success: function(data) {
            window.location.href = data;
        }
    })
}

function showTable() {
    if(showtablestatus == 0) {
        var table = document.getElementById("table");
        table.style.display = "table";
        showtablestatus = 1;
    } else if(showtablestatus == 1) {
        var table = document.getElementById("table");
        table.style.display = "none";
        showtablestatus = 0;
    }
}

function createFolder() {
        var  userfolder = prompt("enter folder name");
            $.ajax({
                url: 'createfolder.php?argument=createfolder&foldername='+userfolder,
                success: function(res){ //edw sto createfolder den benei pote gia kapoio logo kai apla kanei refresh opote ama prwta exeis kanei back prin to create ksanakanei ena back
                    if(res == "success") {
                        window.location.href = "usermainpage.php";
                    } else {
                        toastr.error("invalid folder name, or try again later","Error");
                    }
                }
            });
}



function shareItem(file) {

    var email = prompt("enter users email to share the file");
        $.ajax({
            url: 'share.php?argument=share&file='+file+'&email='+email,
            success: function (result) {
                var reply = result.replace(/\s+/, "");
                if (reply == "success") {
                    //gia kapio logo i vivliothiki toastr den douleuei edo kai enomeronw me alert!
                    alert("file shared successfully!");
                    //toastr.success("file shared with user:" + email, "success");
                } else if (reply == "usernotexists") {
                    alert("the user is not exists!");
                    //toastr.error("user is not exists!", "Error");
                } else {
                    alert("failed to share file!");
                    //toastr.error("failed to share file!" + result, "Error");
                }
            }
        });



}



function deleteItem(filename){
    $(document).ready(function(){
        if(filename){
            $.ajax({
                url: 'deleteItem.php?argument=deleteitem&filename='+filename,
                success: function(res){
                    if(res == "success") {
                        window.location.href = "usermainpage.php";
                    } else {
                        toastr.error("invalid folder name, or try again later","Error");
                    }
                }
            });}else{
            toastr.error("invalid folder name or try again later","Error");
        } });
}


function loadprevFolder() {
    window.location.href = "usermainpage.php?path=prev";
}


function showShares() {
    window.location.href = "shares/usersharepage.php";
}