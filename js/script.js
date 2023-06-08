const form = document.querySelector("form"), statusTxt = form.querySelector(".area-botao span");

form.onsubmit = (e)=>{
    e.preventDefault();
    statusTxt.style.color = "#0D6EFD";
    statusTxt.style.display = "block";
    statusTxt.innerText = "Enviando a sua mensagem...";
    form.classList.add("disabled");

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "conf/mensagem.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === 4 && xhr.status === 200){
            let resposta = xhr.response;
            if(resposta.indexOf("Todos os campos são obrigatórios!") !== -1 || resposta.indexOf("Informe um E-mail válido!") !== -1 || resposta.indexOf("Ops, algo deu errado!") !== -1){
                statusTxt.style.color = "red";
            }else{
                form.reset();
                setTimeout(()=>{
                    statusTxt.style.display = "none";
                }, 3000);
            }
            statusTxt.innerText = resposta;
            form.classList.remove("disabled");
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}