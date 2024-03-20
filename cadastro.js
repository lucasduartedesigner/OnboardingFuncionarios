document.addEventListener('DOMContentLoaded', function() {
    // Seleciona o botão de cadastro pelo seu ID
    var cadastroButton = document.getElementById('cadastroButton');

    // Adiciona um ouvinte de evento de clique ao botão de cadastro
    cadastroButton.addEventListener('click', function(event) {
        // Previne a ação padrão do botão (que seria enviar o formulário)
        event.preventDefault();

        // Redireciona o usuário para a página de cadastro
        window.location.href = 'cadastro.html'; // Substitua 'cadastro.html' pelo caminho correto da sua página de cadastro
    });
});
