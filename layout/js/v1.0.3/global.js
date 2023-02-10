var hexChar = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "A", "B", "C", "D", "E", "F",];
var body = document.body;
var inputs = document.getElementsByTagName("input");
var selects = document.getElementsByTagName("select");
var textInputs = document.querySelectorAll("input[type=text]");
var customFormInputs = document.querySelectorAll(".custom-form input");
var showPassword = document.getElementById("show-pass");
var showPassword2 = document.getElementById("show-pass-2");
var direction = document.getElementById("direction");
var sources = document.getElementById("sources");
var altSources = document.getElementById("alternative-sources");
var pingBtn = document.getElementById("ping");
var piecesTbl = document.getElementById("piecesTbl");
var backupBtn = document.getElementById("backup");
var cardStats = document.querySelectorAll(".card-stat");
var cardLinks = document.querySelectorAll("a.stretched-link");
var clientIDSearch = document.querySelector("#client-id");
var clientNameSearch = document.querySelector("#client-name");
var clientNameResult = document.getElementById("clients-names");
var choosePhoto = document.getElementById("photo");
var previewPhoto = document.getElementById("showPreviewPhoto");
var suggCompBox = document.getElementById("sugg-comp-box");
var technicalID = document.getElementById("technical-id");
var technicalIDVal = document.getElementById("technical-id-value");
var license_select = document.getElementById("license");
var license_btn = document.getElementById("renew-license-btn");
var cardsNums = document.querySelectorAll(".nums .num");
var ths = document.getElementsByTagName("th");
var previousBtn = document.getElementById('previousBtn');
var nextBtn = document.getElementById('nextBtn');
var tree = document.querySelectorAll(".tree span");
var reportSections = document.querySelectorAll(".reports .section-header");
var arrowUpBtn = document.querySelector(".arrow-up");
var delete_comb_btn = document.querySelectorAll('#delete-comb');
var confirm_delete_combination = document.querySelector("#confirm-delete-combination");
var delete_mal_btn = document.querySelectorAll('#delete-mal');
var confirm_delete_malfunction = document.querySelector("#confirm-delete-malfunction");

// self invoke function .
(function () {

    // window on load
    window.onload = function () {
        if (technicalIDVal != null) {
            technicalIDVal.value = technicalID.value;

            technicalID.addEventListener("change", (evt) => {
                evt.preventDefault();
                technicalIDVal.value = technicalID.value;
            });
        }

        // check if cards of nums not empty
        if (cardsNums != null) {
            cardsNums.forEach((element) => startCount(element));
        }

        // get datatables buttons
        let dataTablesBtns = document.querySelectorAll("#datatables-buttons");

        // check if not null
        if (dataTablesBtns != null) {
            dataTablesBtns.forEach(element => {
                if (localStorage['systemLang'] == 'ar') {
                    element.style.direction = 'ltr';
                }
            });
            // get datatables buttons
            const btns = document.querySelectorAll('.dt-buttons button');

            // loop on it
            for (let i = 0; i < btns.length; i++) {
                // current element
                const btn = btns[i];
                // check current element tag name 
                if (btn.tagName.toLowerCase() == 'button') {
                    // remove btn-secondary class
                    btn.classList.replace('btn-secondary', 'btn-outline-primary')
                    btn.classList.add('fs-12', 'py-1')
                } else {
                    // get current child
                    const el = btn.children[0];
                    // remove btn-secondary class
                    el.classList.replace('btn-secondary', 'btn-outline-primary')
                    el.classList.add('fs-12', 'py-1')

                }
            }
        }

    };


    if (reportSections.length > 0) {
        reportSections.forEach(el => {
            el.addEventListener("click", (evt) => {
                evt.preventDefault();
                // check icon
                let icon = el.children[2].children[0];
                if (icon.classList.contains("bi-dash")) {
                    icon.classList.replace("bi-dash", "bi-plus")
                } else {
                    icon.classList.replace("bi-plus", "bi-dash")
                }
                el.nextElementSibling.classList.toggle("d-none")
            })
        });
    }

    // add astrisk
    addAstrisk(selects);
    addAstrisk(inputs);


    for (let i = 0; i < inputs.length; i++) {
        const input = inputs[i];
        if (input.hasAttribute('required') && !input.hasAttribute("data-no-astrisk")) {
            if (input.getAttribute('type') == 'date') {
                input.addEventListener('change', function (evt) { validateInput(input) })
            } else {
                input.addEventListener('keyup', function (evt) { validateInput(input) })
            }
            input.addEventListener('focus', function (evt) { validateInput(input) })
            input.addEventListener('blur', function (evt) { validateInput(input) })
        }
    }

    for (let i = 0; i < selects.length; i++) {
        const select = selects[i];
        if (select.hasAttribute('required') && !select.hasAttribute("data-no-astrisk")) {
            select.addEventListener('change', function (evt) { validateInput(select) })
            select.addEventListener('focus', function (evt) { validateInput(select) })
            select.addEventListener('blur', function (evt) { validateInput(select) })
        }
    }

    // check if delete combination button is null 
    if (delete_comb_btn != null) {
        // loop on it
        delete_comb_btn.forEach(element => {
            element.addEventListener("click", (evt) => {
                confirm_delete_combination.setAttribute('href', `?do=deleteComb&comb_id=${element.dataset.combId}`);
            })
        });
    }

    // check if delete malfunction button is null 
    if (delete_mal_btn != null) {
        // loop on it
        delete_mal_btn.forEach(element => {
            element.addEventListener("click", (evt) => {
                confirm_delete_malfunction.setAttribute('href', `?do=deleteComb&comb_id=${element.dataset.malId}`);
            })
        });
    }

})();



/**
 * startCount function
 * start count from 0 to the target goal
 */
function startCount(el) {
    let goal = el.dataset.goal;
    let count = setInterval(() => {
        // check if goal not equal zero
        if (goal != 0) {
            el.textContent++;
        }
        // condition to check the stop point
        if (el.textContent == goal) {
            clearInterval(count);
        }
    }, 250 / goal);
}


/**
 * hide placeholder from inputs when focus
 * show placeholder when blur
 */
if (inputs != null) {
    // when focus or blur on input form
    for (const input of inputs) {
        // when focus on input delete placeholder
        input.addEventListener("focus", function (event) {
            input.setAttribute("data-text", input.getAttribute("placeholder"));
            input.setAttribute("placeholder", "");
        });

        // when blur on input delete placeholder
        input.addEventListener("blur", function (event) {
            input.setAttribute("placeholder", input.getAttribute("data-text"));
            input.setAttribute("data-text", "");
        });
    }
}

/**
 * showPass function
 * used to show/hide the password
 */
function showPass(btn) {
    if (btn.classList.contains("bi-eye-slash")) {
        btn.classList.replace("bi-eye-slash", "bi-eye");
        btn.previousElementSibling.setAttribute("type", "text");
    } else {
        btn.classList.replace("bi-eye", "bi-eye-slash");
        btn.previousElementSibling.setAttribute("type", "password");
    }
}

/**
 * addAstrisk function
 * this function is used to add astrisk mark on required inputs
 */
function addAstrisk(inputs) {
    // loop on inputs
    for (const input of inputs) {
        // add astrisk on required field
        if (input.hasAttribute("required") && !input.hasAttribute("data-no-astrisk")) {
            // create span
            let astrisk = document.createElement("span");
            // add some classes
            astrisk.classList.add("text-danger", "astrisk");
            // check system language
            if (localStorage['systemLang'] == 'ar') {
                // add some classes
                astrisk.classList.add("astrisk-left");
            } else {
                // add some classes
                astrisk.classList.add("astrisk-right");
            }
            astrisk.textContent = "*";
            // append astrisk
            input.parentElement.appendChild(astrisk);
        }
    }
}

/**
 * ping function
 * this function accepts parameter
 * btn => the button that have the ip that i want to ping
 */
function ping(btn) {
    // table row of the clicked button
    let tr = btn.parentElement.parentElement;
    let avgTd = 18;
    // piece ip
    let ip = btn.value.trim();
    // check ip
    if (ip != 1) {
        // print waiting message in the avg and lost ping td
        tr.children[avgTd].textContent = "waiting...";
        tr.children[avgTd + 1].textContent = "waiting...";
        // get ping ..
        $.get(`../requests/index.php?do=ping&ip=${ip}`, (data) => {
            // convert the json data into string
            let pingResult = $.parseJSON(data).split(",");
            // remove last element from the array
            pingResult.pop();
            // average ping and packet loss variables
            let avgPing, packetLoss;
            // switch case to display the result
            switch (pingResult.length) {
                case 4:
                    // get average ping 
                    avgPing = pingResult[0];
                    // get the packet loss
                    packetLoss = pingResult[pingResult.length - 1].trim().split("=")[1].trim();
                    break;
                case 6:
                    // get average ping 
                    avgPing = pingResult[2].trim().split("=")[1].trim();
                    // get the packet loss
                    packetLoss = pingResult[pingResult.length - 1].trim().split("=")[1].trim();
                    break;
            }
            // display average ping result
            tr.children[avgTd].textContent = avgPing;
            // display the packet loss
            tr.children[avgTd + 1].textContent = packetLoss;
            // print result
            console.log(pingResult);
        });
    } else {
        // print waiting message in the avg and lost ping td
        tr.children[avgTd].textContent = "NO IP";
        tr.children[avgTd + 1].textContent = "NO IP";
    }
}

// when click any key in search input
function tableFiltration(input, tableID = null) {
    // get search value
    let searchText = input.value.toLowerCase();
    // check if table id is passed or not
    // if table id == null => search on pieces or clients table
    if (tableID == null) {
        // loop in table
        for (let i = 0; i < piecesTbl.children.length; i++) {
            tdIP = piecesTbl.children[i].children[2];
            tdMac = piecesTbl.children[i].children[3];
            tdName = piecesTbl.children[i].children[4];
            tdDir = piecesTbl.children[i].children[5];
            tdUserName = piecesTbl.children[i].children[6];
            // check the td of ip or td of name
            if (tdIP || tdName) {
                if (tdIP.textContent.toLowerCase().indexOf(searchText) > -1 || tdMac.textContent.toLowerCase().indexOf(searchText) > -1 || tdDir.textContent.toLowerCase().indexOf(searchText) > -1 || tdName.textContent.toLowerCase().indexOf(searchText) > -1 || tdUserName.textContent.toLowerCase().indexOf(searchText) > -1) {
                    piecesTbl.children[i].style.display = "";
                } else {
                    piecesTbl.children[i].style.display = "none";
                }
            }
        }
    }
    // if table id is passed => search on the specidic table
    else if (tableID != nul) {

        console.log(tableID)

    }
}



/**
 * search function
 * this function is used to search about the client name
 */
function search(evt) {
    // get name to search
    let clientName = evt.value;
    let companyID = evt.dataset.companyId;
    // check if client name box is empty or not
    if (clientName != "" && clientName.length != 0) {
        // send request
        $.get(`../requests/index.php?do=search&client-name=${clientName}&company-id=${companyID}`, (data) => {
            // convert the json data into string
            let src = $.parseJSON(data);
            // clear all previous clients names
            clientNameResult.innerHTML = "";
            // check the result length
            if (src.length > 0) {
                // loop on data result to display the src
                for (let i = 0; i < src.length; i++) {
                    // create a new li element
                    let li = document.createElement("li");
                    // add client id as an attribute
                    li.setAttribute("data-id", src[i]["piece_id"]);
                    // add client name as a text content
                    li.textContent = src[i]["piece_name"];
                    // add event
                    li.addEventListener("click", function (evt) {
                        clientNameSearch.value = li.textContent;
                        clientIDSearch.value = li.getAttribute("data-id");
                        // clear all previous clients names
                        clientNameResult.innerHTML = "";
                        // show the result
                        clientNameResult.style.display = "none";
                    });
                    // add an event when click on the one of the clients
                    clientNameResult.appendChild(li);
                }
            } else {
                console.log(0)
            }
        });
        // show the result
        clientNameResult.style.display = "block";
    } else {
        // clear all previous clients names
        clientNameResult.innerHTML = "";
        // hide the result
        clientNameResult.style.display = "none";
        // clear client id
        clientIDSearch.value = "";
    }
}

function get_sources(dir_select, box, company_id, location) {
    // get direction id
    let dir_id = dir_select.value;
    // get direction ip
    let dir_ip = dir_select.options[dir_select.selectedIndex].getAttribute("data-dir-ip");
    // get direction name
    let dir_name = dir_select.options[dir_select.selectedIndex].textContent;
    // json file name
    let json_file_name = "";
    // get all pieces data ..
    $.get(`../requests/index.php?do=get-source&dir-id=${dir_id}&company=${company_id}`, (data) => {
        // console.log(data);
        // assign json file name to the variable
        json_file_name = $.parseJSON(data);

        // get data from json file
        $.ajax({
            url: `${location}/${json_file_name}`,
            dataType: 'json',
            cache: false,
            success: function (data, status) {
                for (let i = 0; i < box.length; i++) {
                    put_data_into_select(data, status, box[i], dir_ip, dir_name, i);
                }
            },
            error: function (xhr, textStatus, err) {
                // for error message
            }
        })
    });


}

function put_data_into_select(data, status, box, dir_ip, dir_name, is_alternative) {
    // check the status
    if (status === "success") {
        var select_box = document.getElementById(box);
        // remove all sources children
        select_box.innerHTML = "";
        // first option
        let option = document.createElement("option");
        option.setAttribute("disabled", "disabled");
        option.setAttribute("selected", "selected");
        // check if the selectbox is alternative or not
        if (is_alternative == 1) {
            option.textContent = "اختر المصدر البديل";
        } else {
            option.textContent = "اختر المصدر";
        }
        // append first option
        select_box.appendChild(option);
        // check if source data has pieces or not
        if (data.length == 0) {
            let option = document.createElement("option");
            option.setAttribute("value", 0);
            option.textContent = `${dir_ip} - ${dir_name}`;
            select_box.appendChild(option);
        } else {
            // loop on data result to display the data
            for (let i = 0; i < data.length; i++) {
                let option = document.createElement("option");
                option.setAttribute("value", data[i]["piece_id"]);
                option.textContent = `${data[i]["piece_ip"]} - ${data[i]["piece_name"]}`;
                select_box.appendChild(option);
            }
        }
    }
}

/**
 *
 */
function getBackup(id) {
    // // get request to get backup of data
    // $.get(`../requests/index.php?do=backup&id=${id}`, (data) => {
    //     if (data == 1) {
    //         // get date and time
    //         let date = getDateNow();
    //         let time = getTimeNow();
    //         // prepare the message
    //         let message = `Backup successed on ${date} at ${time} ..`;
    //         message += "\nENG HASSIB GREATING YOU AND SAYS `HAVE A NICE DAY` ..\n";
    //         // show message
    //         alert(message);
    //     } else {
    //         console.log("cannot take a backup");
    //     }
    // });
}

/**
 * getDateNow function v1
 * This function is used to get the date for now
 */
function getDateNow(lang) {
    // dayes array in arabic
    const days_ar = ["الاحد", "الاثنين", "الثلاثاء", "لالربعاء", "الخميس", "الجمعة", "السبت"];
    // dayes array in english
    const days_en = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    // months array in arabic
    const months_ar = ["يناير", "فبراير", "مارس", "ابريل", "مايو", "يونيو", "يوليو", "اغسطس", "سبتمبر", "اكتوبر", "نوفمبر", "ديسمبر"];
    // months array in english
    const months_en = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    // date object to get full date and time details
    let dateObj = new Date();
    // check language
    if (lang == "ar") {
        date = `${days_ar[dateObj.getDay()]}, ${months_ar[dateObj.getMonth()]} ${dateObj.getDate()}, ${dateObj.getFullYear()}`;
    } else {
        date = `${days_en[dateObj.getDay()]}, ${months_en[dateObj.getMonth()]} ${dateObj.getDate()}, ${dateObj.getFullYear()}`;
    }
    // return the date
    return date;
}


/**
 * getTimeNow function v1
 * This function is used to get the date for now
 */
function getTimeNow() {
    // date object to get full date and time details
    let dateObj = new Date();
    // prepare the time
    let time = "";
    // check the time mode
    if (dateObj.getHours() < 12) {
        time = `${dateObj.getHours()}:${dateObj.getMinutes()} Am`;
    } else {
        time = `${dateObj.getHours() - 12}:${dateObj.getMinutes()} pm`;
    }
    // return the date
    return time;
}

/**
 * hideList function
 */
function hideList(btn) {
    btn.nextElementSibling.classList.toggle("d-none");
    let icon = btn.children[2].children[0];
    icon.classList.contains("bi-dash-lg") ? icon.classList.replace("bi-dash-lg", "bi-plus-lg") : icon.classList.replace("bi-plus-lg", "bi-dash-lg");
}


/**
 * getUserPermission function
 */
function getUserPermission(selected) {
    // get selected option value
    let selValue = selected.value;
    // get parent
    let sibling = selected.previousElementSibling;
    // change sibling value
    sibling.value = selValue;
}

/**
 * 
 */
function showPreview(evt) {
    previewPhoto.innerHTML = "";
    // loop on files of the form
    for (let i = 0; i < evt.files.length; i++) {
        // uploaded type
        let type = evt.files[i]['type'].includes("video") ? "video" : "img";
        // create the image src
        var src = URL.createObjectURL(evt.files[i]);
        // create a colomn to append the image
        let col = document.createElement('div');
        col.classList.add("col-12");
        // element that will append to the preview box
        let element;
        // switch ... case ...
        switch (type) {
            case "video":
                // create video
                element = document.createElement("video");
                element.setAttribute("class", "w-100 h-100");
                element.setAttribute("autoplay", "autoplay");
                element.setAttribute("controls", "controls");
                element.setAttribute("muted", "muted");
                // element.setAttribute("loop", "loop");
                // create source tag
                videoSrc = document.createElement("source");
                videoSrc.setAttribute("src", src);
                videoSrc.setAttribute("type", `video/mp4`);
                element.appendChild(videoSrc);
                // create source tag
                videoSrc = document.createElement("source");
                videoSrc.setAttribute("src", src);
                videoSrc.setAttribute("type", `video/mov`);
                element.appendChild(videoSrc);
                // create source tag
                videoSrc = document.createElement("source");
                videoSrc.setAttribute("src", src);
                videoSrc.setAttribute("type", `video/webm`);
                element.appendChild(videoSrc);
                // append video source
                break;

            case "img":
                // create image
                element = document.createElement("img");
                element.setAttribute("src", src);
                element.setAttribute("class", "w-100 h-100");
                break;
        }
        // append image into column
        col.appendChild(element);
        // append column into the preview box
        previewPhoto.appendChild(col)
    }
}

/**
 * show avatar
 */
function showSuggCompDetails(id) {
    // display the details box
    suggCompBox.style.display = "block";
    // get request to get backup of data
    $.get(`../requests/index.php?do=getSuggComp&id=${id}`, (data) => {
        let suggComp = $.parseJSON(data);

        // console.log(suggComp)

        document.getElementById("sugg-comp-id").value = suggComp['id'];
        if (suggComp['type'] == 0) {
            document.getElementById("suggDetails").setAttribute("checked", "checked");
        } else {
            document.getElementById("compDetails").setAttribute("checked", "checked");
        }
    });
}


/**
 * showUserModal function
 */
function showUserModal(btn) {
    // check the attribute
    if (btn.hasAttribute('data-userid')) {
        // get user id and name
        let userid = btn.getAttribute('data-userid');
        let username = btn.getAttribute('data-username');
        // get deleteUser page url
        let url = `users.php?do=deleteUser&userid=${userid}`;
        // add username and url
        document.getElementById('deleted-username').textContent = username;
        document.getElementById('delete-user').setAttribute('href', url);

    } else if (btn.hasAttribute('data-comp-sugg-id')) {
        // get comp or sugg id to delete it
        let comSuggID = btn.getAttribute('data-comp-sugg-id');
        // get deleteCompSugg page url
        let url = `comp-sugg.php?do=deleteCompSugg&compSuggID=${comSuggID}`;
        // add url
        document.getElementById('delete-comp-sugg').setAttribute('href', url);

    } else if (btn.hasAttribute('data-points')) {
        let pointsID = btn.getAttribute('data-id');
        // get number of points to delete
        let points = btn.getAttribute('data-points');
        // get delete points page url
        let url = `users.php?do=deletePoints&id=${pointsID}`;
        // add points to the modal
        document.getElementById('user-points').textContent = points;
        document.getElementById('delete-points').setAttribute('href', url);
    }
}


/**
 * selectAllPermissions function
 */
function selectAllPermissions(btn) {
    // get all inputs in the form
    let inputs = document.querySelectorAll('input[type=checkbox]');
    // check if input button is checked or not
    if (btn.checked) {
        for (let i = 1; i < inputs.length; i++) {
            inputs[i].checked = true;
        }
    } else {
        for (let i = 1; i < inputs.length; i++) {
            inputs[i].checked = false;
        }
    }
}


/**
 * submit form of the button
 * 
 */
function submitForm(btn) {
    let myForm = btn.form;
    myForm.submit();
}

/**
 * check IP address validation
 */
function validateIPaddress(input) {
    if (/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/.test(input.value)) {
        input.classList.remove("is-invalid");
        input.classList.add("is-valid");
        input.dataset.valid = "true";
    } else {
        input.classList.remove("is-valid");
        input.classList.add("is-invalid");
        input.dataset.valid = "false";
    }
}

/**
 * check MAC address validation
 */
function validateMacAddress(input) {
    if (/^[0-9a-f]{1,2}([.:-])[0-9a-f]{1,2}(?:\1[0-9a-f]{1,2}){4}$/i.test(input.value)) {
        input.classList.remove("is-invalid");
        input.classList.add("is-valid");
        input.dataset.valid = "true";
    } else {
        input.classList.remove("is-valid");
        input.classList.add("is-invalid");
        input.dataset.valid = "false";
    }
}

/**
 * validateForm function
 * is used to check the required fields in form
 */
function validateForm(form = null) {
    // error array
    let errorArray = Array();

    if (form != null) {
        // get all required inputs in the form
        var inputs = document.querySelectorAll(`#${form.getAttribute('id')} input`);
        // get all required select in the form
        var selects = document.querySelectorAll(`#${form.getAttribute('id')} select`);
    } else {
        // get all required inputs in the form
        var inputs = document.querySelectorAll("input");
        // get all required select in the form
        var selects = document.querySelectorAll("select");
    }

    // loop on inputs
    inputs.forEach(input => {
        // check the required
        if (input.hasAttribute('required') && !input.hasAttribute("data-no-astrisk")) {
            // check if type of input is text
            if (input.getAttribute('type') == 'text' || input.getAttribute('type') == 'email' || input.getAttribute('type') == 'password' || input.getAttribute('type') == 'date') {
                // check if empty
                if (input.value == '') {
                    errorArray.push(input)
                }
            }
        }

        if (input.getAttribute('type') == "redio") {
            console.log(input.checked);
        }
    })

    // loop on selects
    selects.forEach(select => {
        // check the required
        if (select.hasAttribute('required') && !select.hasAttribute("data-no-astrisk")) {
            // check if user not select anything
            if (select.selectedIndex == 0) {
                errorArray.push(select)
            }
        }
    })

    // check array of the error
    if (errorArray.length > 0) {
        // loop on inputs to validate it
        errorArray.forEach(el => {
            validateInput(el);
        })
        // scroll on the top of the page
        document.body.scrollTo(0, 0);
    } else {
        // no error => check if the form is null
        // if not null submit it
        if (form != null) {
            form.submit();
        }
    }
}


/**
 * validateInput function
 * is used to check the specific required input in form
 */
function validateInput(input) {
    // get tag name
    let tagName = input.tagName.toLowerCase();
    // check the type of the passed parameters
    if (tagName == 'input') {

        // if input is empty
        if (input.value.length == 0) {
            // check if have an invalid class
            if (!input.classList.contains('is-invalid')) {
                input.classList.add('is-invalid')
            } else {
                input.classList.replace('is-valid', 'is-invalid')
            }
        } else {
            // check if have an valid class
            if (!input.classList.contains('is-valid')) {
                input.classList.add('is-valid')
            } else {
                input.classList.replace('is-invalid', 'is-valid')
            }
        }

    } else if (tagName == 'select') {
        // if input is empty
        if (input.selectedIndex == 0) {
            // check if have an invalid class
            if (!input.classList.contains('is-invalid')) {
                input.classList.add('is-invalid')
            } else {
                input.classList.replace('is-valid', 'is-invalid')
            }
        } else {
            // check if have an valid class
            if (!input.classList.contains('is-valid')) {
                input.classList.add('is-valid')
            } else {
                input.classList.replace('is-invalid', 'is-valid')
            }
        }
    }
}