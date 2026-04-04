function toggleTheme(){
    document.body.classList.toggle("dark-mode");

    let btn = document.getElementById("themeBtn");

    if(document.body.classList.contains("dark-mode")){
        btn.innerText = "☀";
    }
    else{
        btn.innerText = "🌙";
    }
}