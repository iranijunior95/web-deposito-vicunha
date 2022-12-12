document.getElementById('btnEntrar').addEventListener('click', logar)

function logar() {

    let dados = {
        usuario: document.getElementById('inputUsuario').value,
        senha: document.getElementById('inputSenha').value
    }

    $.ajax({
        url : "./ajaxController/requisicoesAjax",
        type : 'POST',
        dataType: 'json',
        data : {tabela:'login', metodo:'login', dados:dados},
        beforeSend: function(){
            $('#formLogin *').prop('disabled',true);
        },
        success: function(data) {
            if(data['status']) {
                window.location.href = `./home`
            }else {
                validarCamposInput('usuario', data['usuario'])
                validarCamposInput('senha', data['senha'])
            }

            $('#formLogin *').prop('disabled',false);
        }
    })
}

function validarCamposInput(input, mensagem) {
    switch (input) {
        case 'usuario': 

            if(mensagem) {
                document.getElementById('groupInputUsuario').innerHTML = `<input type="text" class="form-control" id="inputUsuario" placeholder="Usuário" value="${document.getElementById('inputUsuario').value}" style="border-color:#dd4b39;">
                                                                          <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                                                          <small class="text-red">${mensagem}</small>`
            }else {
                document.getElementById('groupInputUsuario').innerHTML = `<input type="text" class="form-control" id="inputUsuario" placeholder="Usuário" value='${document.getElementById('inputUsuario').value}'>
                                                                          <span class="glyphicon glyphicon-user form-control-feedback"></span>`
            }

            break;

        case 'senha': 

            if(mensagem) {
                document.getElementById('groupInputSenha').innerHTML = `<input type="password" class="form-control" id="inputSenha" placeholder="Senha" value="${document.getElementById('inputSenha').value}" style="border-color:#dd4b39;">
                                                                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                                                        <small class="text-red">${mensagem}</small>`
            }else {
                document.getElementById('groupInputSenha').innerHTML = `<input type="password" class="form-control" id="inputSenha" placeholder="Senha" value="${document.getElementById('inputSenha').value}">
                                                                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>`
            }

            break;
    }
}