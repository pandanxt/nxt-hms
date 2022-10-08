// Add unique Id for New DOCTOR
let uuid = (new Date()).getTime() + Math.trunc(365 * Math.random());
let today = new Date().toLocaleDateString();
let unique_id = today.length = 7 ? `${String(uuid).slice(-4)}-${today.replaceAll('/', '')}` : `${String(uuid).slice(-3)}-${today.replaceAll('/', '')}`;
console.log("Patient MRID: ", unique_id);

if (document.getElementById("uuId")) { document.getElementById("uuId").value = `DOC${unique_id}`; }

// Ajax Call for Adding New Doctor 
$(document).ready(function ($) {
    // on submit...
    $('#addDoctor').submit(function (e) {
        e.preventDefault();
        $("#err-msg").hide();
        //name required
        var uid = $("input#uuId").val();
        //name required
        var name = $("input#name").val();
        //mobile required
        var mobile = $("input#mobile").val();
        //dept required
        var dept = $("input#department").val();

        if (uid == "" || name == "" || mobile == "" || dept == "") {
            $("#err-msg").fadeIn().text("Required Fields.");
            $("input#name").focus();
            $("input#mobile").focus();
            $("input#department").focus();
            return false;
        }
        // ajax
        $.ajax({
            type: "POST",
            url: "backend_components/doctor_handler.php?q=ADD_DOCTOR",
            data: $(this).serialize(), // get all form field value in serialize form
            success: function () {
                let el = document.querySelector("#close-button");
                el.click();
                // updateDoctorList();
                $(function () {
                    var Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 1000
                    });
                    Toast.fire({
                        icon: 'success',
                        title: 'New Doctor Successfully Saved.'
                    });
                    autoRefresh();
                });
            }
        });
    });
    return false;
});

// Ajax Call for Editing Doctor
$(document).ready(function ($) {
    // on submit...
    $('#editDoctor').submit(function (e) {
        e.preventDefault();
        $("#err-msg").hide();
        //name required
        var name = $("input#docName").val();
        //mobile required
        var mobile = $("input#docMobile").val();
        //dept required
        var dept = $("input#docDepartment").val();

        if (name == "" || mobile == "" || dept == "") {
            $("#err-msg").fadeIn().text("Required Fields.");
            $("input#docName").focus();
            $("input#docMobile").focus();
            $("input#docDepartment").focus();
            return false;
        }
        // ajax
        $.ajax({
            type: "POST",
            url: "backend_components/doctor_handler.php?q=EDIT_DOCTOR",
            data: $(this).serialize(), // get all form field value in serialize form
            success: function () {
                let el = document.querySelector("#close-button");
                el.click();
                $(function () {
                    var Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 1000
                    });
                    Toast.fire({
                        icon: 'success',
                        title: 'Doctor Updated Successfully.'
                    });
                    autoRefresh();
                });
            }
        });
    });
    return false;
});

// Ajax Call for Adding New Visiting Doctor 
$(document).ready(function ($) {
    // on submit...
    $('#visitorDoctor').submit(function (e) {
        e.preventDefault();
        $("#err-msg").hide();
        //name required
        var dname = $("input#vtName").val();
        if (dname == "") {
            $("#err-msg").fadeIn().text("Doctor Name required.");
            $("input#vtName").focus();
            return false;
        }
        // ajax
        $.ajax({
            type: "POST",
            url: "backend_components/doctor_handler.php?q=ADD_VT_DOCTOR",
            data: $(this).serialize(), // get all form field value in serialize form
            success: function () {
                let el = document.querySelector("#close-button");
                el.click();
                // updateDoctorList();
                $(function () {
                    var Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 1000
                    });
                    Toast.fire({
                        icon: 'success',
                        title: 'New Visitor Doctor Successfully Saved.'
                    });
                    autoRefresh();
                });
            }
        });
    });
    return false;
});

// Ajax Call for Editing Visiting Doctor
$(document).ready(function ($) {
    // on submit...
    $('#editVisitor').submit(function (e) {
        e.preventDefault();
        $("#err-msg").hide();
        //name required
        var name = $("input#vtEtName").val();

        if (name == "") {
            $("#err-msg").fadeIn().text("Required Fields.");
            $("input#vtEtName").focus();
            return false;
        }
        // ajax
        $.ajax({
            type: "POST",
            url: "backend_components/doctor_handler.php?q=EDIT_VT_DOCTOR",
            data: $(this).serialize(), // get all form field value in serialize form
            success: function () {
                let el = document.querySelector("#close-button");
                el.click();
                $(function () {
                    var Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 1000
                    });
                    Toast.fire({
                        icon: 'success',
                        title: 'Doctor Updated Successfully.'
                    });
                    autoRefresh();
                });
            }
        });
    });
    return false;
});

function getDoctor(str) {
    console.log("clicked Id: ", str.getAttribute("data-uuid"));
    let uuid = str.getAttribute("data-uuid");
    if (uuid == "") { return; }
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("viewDoctor").innerHTML = this.responseText;
            console.log("Response From Doctor By Id: ", this.responseText);
        }
    }
    xmlhttp.open("GET", `backend_components/doctor_handler.php?q=GET-DOCTOR-BY-ID&id=${uuid}`, true);
    xmlhttp.send();
}

function editDoctor(str) {
    console.log("clicked Id: ", str.getAttribute("data-uuid"));
    let uuid = str.getAttribute("data-uuid");
    if (uuid == "") { return; }
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("editForm").innerHTML = this.responseText;
            console.log("Response From Doctor By Id: ", this.responseText);
        }
    }
    xmlhttp.open("GET", `backend_components/doctor_handler.php?q=EDIT-DOCTOR-BY-ID&id=${uuid}`, true);
    xmlhttp.send();
}

function getVtDoctor(str) {
    console.log("clicked Id: ", str.getAttribute("data-uuid"));
    let uuid = str.getAttribute("data-uuid");
    if (uuid == "") { return; }
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("viewDoctor").innerHTML = this.responseText;
            console.log("Response From Doctor By Id: ", this.responseText);
        }
    }
    xmlhttp.open("GET", `backend_components/doctor_handler.php?q=GET_VT_DOCTOR_BY_ID&id=${uuid}`, true);
    xmlhttp.send();
}

function editVisitor(str) {
    console.log("clicked Id: ", str.getAttribute("data-uuid"));
    let uuid = str.getAttribute("data-uuid");
    if (uuid == "") { return; }
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("editVtForm").innerHTML = this.responseText;
            console.log("Response From Doctor By Id: ", this.responseText);
        }
    }
    xmlhttp.open("GET", `backend_components/doctor_handler.php?q=EDIT_VT_DOCTOR_BY_ID&id=${uuid}`, true);
    xmlhttp.send();
}

function deleteDoctor(str) {
    let confirm = window.confirm("Please confirm deletion!");
    if (confirm) {
        console.log("clicked Id: ", str.getAttribute("data-uuid"));
        let uuid = str.getAttribute("data-uuid");
        if (uuid == "") { return; }
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                $(function () {
                    var Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 1000
                    });
                    Toast.fire({
                        icon: 'error',
                        title: 'Doctor Successfully Deleted.'
                    });
                    autoRefresh();
                });
            }
        }
        xmlhttp.open("GET", `backend_components/doctor_handler.php?q=DELETE_DOCTOR&id=${uuid}`, true);
        xmlhttp.send();
    } else {
        //some code
    }
}

function handleStatus(status) {
    if (status.value !== null && status.value != '') {
        let val;
        if (status.value == 1) { val = 0; } else { val = 1; }
        // ajax
        $.ajax({
            type: "POST",
            url: `backend_components/doctor_handler.php?q=STATUS_DOCTOR&id=${status.dataset.uuid}&val=${val}`,
            success: function () {
                $(function () {
                    var Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 1000
                    });
                    Toast.fire({
                        icon: 'success',
                        title: 'MedEast Doctor Status Updated.'
                    });
                });
            }
        });
        return false;
    } else {
        $(function () {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1000
            });
            Toast.fire({
                icon: 'error',
                title: 'Something Went Wrong.'
            });
            autoRefresh();
        });
        return false;
    }
}

function autoRefresh() {
    setTimeout(() => {
        window.location = window.location.href;
    }, 1000);
}