// Fetch notices from localStorage
let notices = JSON.parse(localStorage.getItem("notices")) || [];
let list = document.getElementById("noticeList");

if(notices.length === 0){
  list.innerHTML = "<p>No notices yet</p>";
} else {
  notices.forEach((n,i)=>{
    list.innerHTML += <div class="notice-item" onclick="openNotice(${i})">${i+1}. ${n.title}</div>;
  });
}

// Open selected notice in a new tab
function openNotice(index){
  localStorage.setItem("selectedNotice", index);
  window.open("notice-view.html","_blank");
}