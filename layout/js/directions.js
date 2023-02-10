

/**
 * putDirectionData is used to put direction info into form update inputs
 */
function putUpdatedDirectionData(btn) {
    // id
    var id = document.getElementById("updated-dir-id");
    // old ip
    var oldName = document.getElementById("updated-dir-name");
    // new name
    var newName = document.getElementById("new-direction-name");
    // new ip
    var newip = document.getElementById("new-direction-ip");

    // put values
    id.value = btn.dataset.directionId;
    oldName.value = btn.dataset.directionId;
    newName.value = btn.dataset.directionName;
    newip.value = btn.dataset.directionIp;

    console.log(btn.dataset)
}

/**
 * putDeletedDirectionData is used to put direction info into form delete inputs
 */
function putDeletedDirectionData(btn) {
    // id
    var id = document.getElementById("deleted-dir-id");
    // old ip
    var oldName = document.getElementById("deleted-dir-name");

    // put values
    id.value = btn.dataset.directionId;
    oldName.value = btn.dataset.directionId;
}

