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
    $(document).ready(function(){
        var  userfolder =prompt("enter folder name");
        if(userfolder){
            $.ajax({
                url: 'createfolder.php?argument=createfolder&foldername='+userfolder,
                success: function(res){
                    if(res == "success") {
                        window.location.href = "usermainpage.php";
                    } else {
                        toastr.error("invalid folder name, or try again later","Error");
                    }
                }
            });} });
}

function loadprevFolder() {
    window.location.href = "usermainpage.php/?path=prev"; //nomizw oti den kaleite pote akoma kai na patisw to button
}


