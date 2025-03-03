let body = document.querySelector("body");
function openModal() {
    const modal = document.querySelector("#modal");
    modal.style.display = "block";
    body.classList.add("modal-info");
}

function closeModal() {
    const close = document.getElementsByClassName("closeModal");
    const modal = document.querySelector("#modal");
    close[0].addEventListener("click", () => {
        modal.style.display = "none";
    })
    close[1].addEventListener("click", () => {
        modal.style.display = "none";
    })
    body.classList.remove("modal-info");
}

let bool = false;
function openTab(event, tabName) {
    const tabContents = document.getElementsByClassName("tab-content");
    for (let i = 0; i < tabContents.length; i++) {
        tabContents[i].classList.remove("active");
    }
    if (bool) {
        document.getElementById(tabName).classList.add("active");
    } else {
        document.getElementById(tabName).classList.remove("active");
    }
    event.currentTarget.classList.add("active");
    bool = !bool;
}


document.querySelectorAll(".copy-text").forEach(function(icon, index) {
    icon.addEventListener("click", function() {
      var copiedText = document.querySelectorAll(".textToCopy")[index].innerText;
      copyTextToClipboard(copiedText);
    });
});
  
function copyTextToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
    });
}

