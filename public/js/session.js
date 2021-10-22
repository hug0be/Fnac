
function addToSession() {
    let key = document.getElementById("session_key").value
    let value = document.getElementById("session_value").value
    axios({
        method: 'post',
        url: "/addToSession",
        data: new URLSearchParams("key="+key+"&value="+value)
    }).then(function (response) {
        console.log(response.data)
    })
}

function deleteFromSession() {
    let key = document.getElementById("session_key").value
    axios({
        method: 'post',
        url: "/deleteFromSession",
        data: new URLSearchParams("key="+key)
    }).then(function (response) {
        location.reload();
        console.log(response.data)
    })
}