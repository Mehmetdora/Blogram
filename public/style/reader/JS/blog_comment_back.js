var popupC = document.getElementById("myPopupC");
var popupR = document.getElementById("myPopupR");
var comment_btn = document.getElementById("comment_button");
var spanC = document.getElementsByClassName("closeC")[0];
var spanR = document.getElementsByClassName("closeR")[0];
var spanE = document.getElementsByClassName("closeE")[0];
var okButtonC = document.getElementById("okButtonC");
var okButtonR = document.getElementById("okButtonR");
var okButtonE = document.getElementById("okButtonE");
//var replyBtns = document.getElementsByClassName("comment-container");
var cancelButtonC = document.getElementById("cancelButtonC");
var cancelButtonR = document.getElementById("cancelButtonR");
var cancelButtonE = document.getElementById("cancelButtonE");
var editBtn = document.getElementsByClassName("edit")[0];
var formR = document.getElementById("reply-form");
var formE = document.getElementById("edit-form");
var formDelete = document.getElementById("delete-div");



const edit_buttons = document.querySelectorAll('.edit');
const delete_buttons = document.querySelectorAll('.delete');
const comment_desc = document.querySelectorAll('.comment-desc');
var popupEdit = document.getElementById("myPopupEditComment");


const replies = document.querySelectorAll('.add_reply');
const reply_ok = document.querySelectorAll('.reply-ok');

var commentID = null;
function getID(id){
    commentID = id;
}

delete_buttons.forEach(btn=>{
    btn.addEventListener('click',() =>{

        var deleteURL = btn.getAttribute('id');
        var blog_id = btn.getAttribute('data-blog-id');
        var form = new FormData();
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        form.append('_token', csrfToken);
        form.append('comment_id', commentID);
        form.append('blog_id', blog_id);

        fetch(deleteURL, { // action attribute'undan URL'yi alıyoruz
            method: 'POST',
            body: form
        })
            .then(response =>{
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                console.log(response.json());
                location.reload();
                return response.json();
            })
            .then(data => {
                console.log('Success:', data);
                console.log('Successvsvsvs b sb:');
                alert(data);
                // Başarılı işlemden sonra popup'ı kapatmak veya başka işlemler yapmak
            })
            .catch((error) => {
                console.error( error);
            });

    }, { once: true }) ;
});



edit_buttons.forEach(btn => {
    btn.addEventListener('click',()=>{

        popupEdit.style.display = "block";
        document.getElementById('edit-data-id').value = commentID;

        reply_ok.forEach(ok_btn =>{
            ok_btn.addEventListener('click',() =>{

                var formData = new FormData();
                formData.append('comment',document.getElementById('edit-box').value);
                formData.append('comment_id',commentID);
                formData.append('blog_id',document.getElementById("edit-blog-id").value);

                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                formData.append('_token', csrfToken);

                fetch(formE.action, { // action attribute'undan URL'yi alıyoruz
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Success:', data);
                        alert("Başarılı");
                        // Başarılı işlemden sonra popup'ı kapatmak veya başka işlemler yapmak
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                    });

            }, { once: true }) ;
        });

    }) ;
});

replies.forEach(button => {
    button.addEventListener('click', () => {
        // Her bir yorum butonuna tıklandığında
        popupR.style.display = "block";

        // Sadece tıklanan reply butonuna ait olan comment id'yi alıyoruz
        const commentId = button.getAttribute('data-comment-id');
        document.getElementById("reply-data-id").value = commentId;

        // reply_ok butonuna sadece bir kez tıklama olayı ekleyin
        reply_ok.forEach(button_ok => {
            button_ok.addEventListener('click', () => {
                var formData = new FormData();
                formData.append('reply', document.getElementById("reply-box").value);
                formData.append('comment_id', commentId);
                formData.append('blog_id', document.getElementById("reply-blog-id").value); // reply-blog-id'yi blog_id olarak değiştirin

                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                formData.append('_token', csrfToken);

                // Fetch API ile POST isteği gönder
                fetch(formR.action, { // action attribute'undan URL'yi alıyoruz
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Success:', data);
                        alert("Başarılı");
                        // Başarılı işlemden sonra popup'ı kapatmak veya başka işlemler yapmak
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                    });
            }, { once: true }); // Olay dinleyicisini sadece bir kez ekleyin
        });
    });
});


comment_btn.onclick = function (){
    var commentInput = popupC.querySelector('#comment-box');
    document.getElementById('comment-form').style.display = "block";

    popupC.style.display = "block";
}//  Yeni yorum oluşturma

editBtn.onclick = function (){
    popupEdit.style.display = "block";
}// edit butonuna tıklanınca popup açar



// X butonua tıklanınca popup kapama
spanC.onclick = function() {
    popupC.style.display = "none";
}
spanR.onclick = function() {
    popupR.style.display = "none";
}
spanE.onclick = function (){
    popupEdit.style.display = "none";
}

// ok butonuna tıklanınca popup kapat
okButtonC.onclick = function() {
    popupC.style.display = "none";
}
okButtonR.onclick = function() {
    popupR.style.display = "none";
}
okButtonE.onclick = function() {
    popupEdit.style.display = "none";
}

// cancel butonu popup kapat
cancelButtonC.onclick = function() {
    popupC.style.display = "none";
}
cancelButtonR.onclick = function() {
    popupR.style.display = "none";
}
cancelButtonE.onclick = function() {
    popupEdit.style.display = "none";
}

// popup dışında başka bir yere tıklanınca kapat
window.onclick = function(event) {
    if (event.target != popupC || event.target != popupR || event.target != popupEdit) {
        popupC.style.display = "none";
        popupR.style.display = "none";
        popupEdit.style.display = "none";
    }
}


//DROPDOWN BACK



window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}

document.querySelectorAll('.dropbtn').forEach(button => {
    button.addEventListener('click', function(event) {

        const dropdown = document.querySelector('.dropdown-content');

            const rect = event.target.getBoundingClientRect();
        dropdown.style.left = `${rect.left-250}px`;
        dropdown.style.top = `${rect.bottom}px`;
        dropdown.style.display = 'block';
        });

});

window.addEventListener('click', function(event) {
    const dropdown = document.querySelectorAll('.dropdown-content');
    dropdown.forEach(drop =>{
        if (!event.target.matches('.dropbtn')) {
            drop.style.display = 'none';
        }
    });

});



// BEĞENME İŞLEMLERİ




